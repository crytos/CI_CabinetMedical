<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
    function __construct() {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }

    public function index() {

        if ($this->session->userdata('logged_in')) {
            redirect('home', 'refresh');
        } else {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Identifiant', 'trim|required');
            $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|min_length[4]|callback_check_database');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() !== false) {
                redirect('home', 'refresh');
            } else {
                $this->load->view('login');
            }
        }
    }

    function check_database($password) {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');

        //query the database
        $result = $this->User_model->verify_user($username, $password);

        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->id,
                    'username' => $row->login,
                    'is_admin' => $row->is_admin
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

}
