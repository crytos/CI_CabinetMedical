<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Medical_folder extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {

        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
    }

    public function check_session() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
    }

    public function preview($patient_id) {

        $this->check_session();

        $this->load->model('Patients_model');
        $this->load->model('User_model');
        $this->load->model('Consultation_model');

        $session_data = $this->session->userdata('logged_in');
        $data = array(
            'username' => $session_data['username'],
            'is_admin' => $session_data['is_admin'],
            'content' => 'medical_folder',
            'patient' => $this->Patients_model->getPatientByID($patient_id),
            'medical_folder_details' => $this->Patients_model->getMedicalFolderDetails($patient_id),
            'consultations_query' => $this->Consultation_model->getConsultationsByPatientID($patient_id)
        );
        $this->load->view('home_view', $data);
    }

    public function new_folder($patient_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $data = array(
                'username' => $session_data['username'],
                'is_admin' => $session_data['is_admin'],
                'patient_id' => $patient_id,
                'content' => 'new_medical_folder'
            );

            $this->load->library('form_validation');

            $this->form_validation->set_rules('height', 'Taille', 'required');
            $this->form_validation->set_rules('weight', 'Poids', 'trim|required');
            $this->form_validation->set_rules('imc', 'IMC', 'trim|required');
            $this->form_validation->set_rules('blood_group', 'Groupe Sanguin', 'trim|required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="margin-top:5px">', '</div>');

            if ($this->form_validation->run() !== false) {

                $data = array(
                    'height' => $this->input->post('height'),
                    'weight' => $this->input->post('weight'),
                    'imc' => $this->input->post('imc'),
                    'blood_group' => $this->input->post('blood_group'),
                    'date_created' => date("Y-m-d H:i:s"),
                    'id_patient' => $patient_id
                );

                $this->db->insert('medical_folder', $data);

                redirect('medical_folder/preview/' . $patient_id, 'refresh');
            } else {
                $this->load->view('home_view', $data);
            }
        } else {
            redirect('login', 'refresh');
        }
    }

}
