<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Patients
 *
 * @author Crytos_HQ
 */
class Patients extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Next, we need to load all models to be used, in this case we have the:
         *  1 : Patients_model to retrieve data about patients according to the method that will be called.
         *  2 : User_model => to rertieve data about the connected user
         */
        $this->load->model('Patients_model', '', TRUE);
        //$this->load->model('User_model', '', TRUE);

        /* Need to load the email configuration file to use its variables */
        $this->load->config('email');
    }

    function index() {

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            $data = array(
                'username' => $session_data['username'],
                'is_admin' => $session_data['is_admin'],
                'content' => 'liste_patients',
                'patients' => $this->Patients_model->getPatients(),
            );

            $this->load->view('home_view', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function new_patient() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $data = array(
                'username' => $session_data['username'],
                'is_admin' => $session_data['is_admin'],
                'content' => 'new_patient'
            );

            $this->load->library('form_validation');

            $this->form_validation->set_rules('gender', 'Civilité', 'required|callback_check_gender_value');
            $this->form_validation->set_rules('name', 'Nom', 'trim|required');
            $this->form_validation->set_rules('maiden_name', 'Nom de jeune fille', 'trim');
            $this->form_validation->set_rules('first_name', 'Prénom', 'trim|required');
            $this->form_validation->set_rules('birth_date', 'Date de naissance', 'trim|required|callback_check_birth_date');
            $this->form_validation->set_rules('family_situation', 'Situation Familiale', 'required|callback_check_family_value');
            $this->form_validation->set_rules('professional_situation', 'Situation Professionnelle', 'required|callback_check_professional_value');
            $this->form_validation->set_rules('address', 'Adresse', 'trim|required');
            $this->form_validation->set_rules('phone_number', 'Num de Télephone', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() !== false) {

                $data = array(
                    'identification_number' => '28101995F', //@TODO
                    'name' => $this->input->post('name'),
                    'maiden_name' => ($this->input->post('maiden_name') != null) ? $this->input->post('maiden_name') : '',
                    'first_name' => $this->input->post('first_name'),
                    'gender' => $this->input->post('gender'),
                    'birth_date' => $this->input->post('birth_date'),
                    'family_situation' => $this->input->post('family_situation'),
                    'professional_situation' => $this->input->post('professional_situation'),
                    'address' => $this->input->post('address'),
                    'phone_number' => $this->input->post('phone_number')
                );

                $this->db->insert('patients', $data);

                redirect('patients', 'refresh');
            } else {
                $this->load->view('home_view', $data);
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    public function edit_personnal_data($patient_id) {

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data = array(
                'username' => $session_data['username'],
                'is_admin' => $session_data['is_admin'],
                'content' => 'edit_personnal_data',
                'patient' => $this->Patients_model->getPatientByID($patient_id)
            );

            $this->load->library('form_validation');

            $this->form_validation->set_rules('gender', 'Civilité', 'required|callback_check_gender_value');
            $this->form_validation->set_rules('name', 'Nom', 'trim|required');
            $this->form_validation->set_rules('maiden_name', 'Nom de jeune fille', 'trim');
            $this->form_validation->set_rules('first_name', 'Prénom', 'trim|required');
            $this->form_validation->set_rules('birth_date', 'Date de naissance', 'trim|required|callback_check_birth_date');
            $this->form_validation->set_rules('family_situation', 'Situation Familiale', 'required|callback_check_family_value');
            $this->form_validation->set_rules('professional_situation', 'Situation Professionnelle', 'required|callback_check_professional_value');
            $this->form_validation->set_rules('address', 'Adresse', 'trim|required');
            $this->form_validation->set_rules('phone_number', 'Num de Télephone', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() !== false) {

                $data = array(
                    'identification_number' => '28101995F', //@TODO generate value
                    'name' => $this->input->post('name'),
                    'maiden_name' => ($this->input->post('maiden_name') != null) ? $this->input->post('maiden_name') : '',
                    'first_name' => $this->input->post('first_name'),
                    'gender' => $this->input->post('gender'),
                    'birth_date' => $this->input->post('birth_date'),
                    'age' => $this->Age($this->input->post('birth_date')),
                    'family_situation' => $this->input->post('family_situation'),
                    'professional_situation' => $this->input->post('professional_situation'),
                    'address' => $this->input->post('address'),
                    'phone_number' => $this->input->post('phone_number')
                );

                $this->db->where('id', $patient_id);
                $this->db->update('patients', $data);

                redirect('patients', 'refresh');
            } else {
                $this->load->view('home_view', $data);
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    function check_gender_value($gender) {
        if ($gender !== 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_gender_value', 'Veuillez préciser une valeur pour le champs civilité');
            return false;
        }
    }

    function check_birth_date($birth_date) {
        /*
         * Change date format from d/m/Y to m/d/Y ==> PHP issue ! 
         * This function will be update once we automate the date selection from the registration form .
         */
        $birth_date_exploded = explode("/", $birth_date);
        $birth_date_formated = $birth_date_exploded[1] . "/" . $birth_date_exploded[0] . "/" . $birth_date_exploded[2];
        return date('Y-m-d', strtotime($birth_date_formated));
    }

    function Age($birth_date) {
        /*
         * birth date is formated as Y-m-d !
         * mktime params order for date is m-d-Y
         * y = birth_date[0] and so on.
         */
        $birth_date_exp = explode("-", $birth_date);
        $age = (date("md", date("U", mktime(0, 0, 0, $birth_date_exp[1], $birth_date_exp[2], $birth_date_exp[0]))) > date("md") ? ((date("Y") - $birth_date_exp[0]) - 1) : (date("Y") - $birth_date_exp[0]));
        return $age;
    }

    function check_family_value($family_situation) {
        if ($family_situation != 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_family_value', 'Situation Familiale : Champs obligatoire');
            return false;
        }
    }

    function check_professional_value($professional_situation) {
        if ($professional_situation != 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_professional_value', 'Situation Professionnelle : Champs obligatoire');
            return false;
        }
    }

    function download_list() {

        $this->load->helper('download');
        $data = $this->Patients_model->getPatients();
        echo '<h1> Dev en cours... ! </h1>';
        var_dump($data);
        die;
        $name = 'Liste_des_patients[' . date("d-m-Y") . '].txt';
        force_download($name, $data);
    }

    function send_email() {

        $this->load->library('email');

        $sender_mail = $this->config->item('sender_mail');
        $sender_name = $this->config->item('sender_name');

        $recipient = '<FILL_IN>';
        $subject = '<FILL_IN>';
        $body = '<FILL_IN>';

        $this->email->from($sender_mail, $sender_name);
        $this->email->to($recipient);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject($subject);
        $this->email->message($body);

        if ($this->email->send()) {
            //$data['message_display'] = 'Email Successfully Send !';
            echo "Email Successfully Sent ! !";
        } else {
            //$data['message_display'] = '<p class="error_msg">Invalid Gmail Account or Password !</p>';
            echo "Missing configuration parameters in Email configuration file";
        }
    }

    function print_dev_message() {
        return '<div class="container"><div class="alert alert-danger" role="alert">En cours de Dev !</div></div>';
    }

}
