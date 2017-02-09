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
class Patients_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPatients() {
        $query = $this->db->get('patients');
        //echo $this->db->last_query();
        return $query->result();
    }

    function getPatientByID($patient_id) {
        return $this->db->get_where('patients', array('id' => $patient_id))->result();
    }

    function getMedicalFolderDetails($patient_id) {
        $query = $this->db->get_where('medical_folder', array('id_patient' => $patient_id));
        return ($query->num_rows() == 1) ? $query->result() : false;
    }

    function getPatientHistory($patient_id) {
        /* COME BACK SOON :p*/
        return $this->db->get_where('patients', array('id' => $patient_id))->result();
    }

}
