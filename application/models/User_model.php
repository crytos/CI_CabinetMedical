<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestModel
 *
 * @author Crytos_HQ
 */
class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function verify_user($login, $password) {

        $query = $this->db->get_where('users', array('login' => $login, 'password' => sha1($password)));
        return ($query->num_rows() == 1) ? $query->result() : false;
    }

}
