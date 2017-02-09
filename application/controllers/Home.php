<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Patients_model', '', TRUE);
    }

    function index() {
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');

            $data = array(
                'username' => $session_data['username'],
                'is_admin' => $session_data['is_admin'],
                'content' => 'liste_patients',
                'patients' => $this->Patients_model->getPatients()
            );

            $this->load->view('home_view', $data);
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        //redirect('home', 'refresh');
        $this->load->view('login');
    }

}

?>