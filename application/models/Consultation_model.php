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
class Consultation_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getConsultations() {
        $query = $this->db->get('consultations');
        return $query->result();
    }

    function getConsultationsByPatientID($patient_id) {
        return $this->db->get_where('consultations', array('id_patient' => $patient_id));
    }

}
