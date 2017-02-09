<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        /* Make sure that a user is connected, otherwise he can't acces web page */
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $data = array(
                'username' => $session_data['username'],
                'is_admin' => $session_data['is_admin'],
                'content' => 'appointment' // The name of the view to show when this method is called      
            );

            $this->load->view('home_view', $data);
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
}

?>