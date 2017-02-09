<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <div class="row">
        <?php
        $form_attr = array(
            'class' => 'form-inline',
        );
        ?>
        <?= form_open('medical_folder/new_folder/' . $patient_id, $form_attr); ?>

        <div class="form-group">
            <label for="height" class="sr-only control-label">Taille</label>
            <?php
            $height_name_attr = array(
                'id' => 'height',
                'placeholder' => 'Taille (cm)',
                'class' => 'form-control'
            );
            ?>
            <?= form_input('height', '', $height_name_attr); ?>
        </div>
        <div class="form-group">
            <label for="weight" class="sr-only control-label">Poids</label>
            <?php
            $weight_name_attr = array(
                'id' => 'weight',
                'placeholder' => 'Poids',
                'class' => 'form-control'
            );
            ?>
            <?= form_input('weight', '', $weight_name_attr); ?>
        </div>
        <div class="form-group">
            <label for="imc" class="sr-only control-label">IMC</label>
            <?php
            $imc_attr = array(
                'id' => 'imc',
                'placeholder' => 'IMC',
                'class' => 'form-control'
            );
            ?>
            <?= form_input('imc', '', $imc_attr); ?>

        </div>
        <div class="form-group">
            <label for="blood_group" class="sr-only control-label">Groupe Sanguin</label>
            <?php
            $blood_group_options = array(
                0 => 'Choisir une option',
                1 => 'O+',
                2 => 'O-',
                3 => 'A+',
                4 => 'A-',
                5 => 'B+',
                6 => 'B-',
                7 => 'AB+',
                8 => 'AB-',
            );

            $blood_group_attr = array(
                'id' => 'blood_group',
                'placeholder' => 'Groupe Sanguin',
                'class' => 'form-control'
            );
            ?>
            <?= form_dropdown('blood_group', $blood_group_options, '', $blood_group_attr); ?> 
        </div>

        <div class="form-group" style="mar">
            <?php echo form_submit('submit', 'Enregistrer', 'class="btn btn-default btn-success pull-left", style=""'); ?>
        </div>

        <?php echo validation_errors(); ?>

        <?php echo form_close(); ?> 

    </div>
</div>
<script>
    function disable_maiden_name(selectedValue) {
        if (selectedValue == 'M') {
            $('#maiden_name').attr("disabled", "disabled")
            //$('#id_maiden_name').hide();
        } else {
            $('#maiden_name').removeAttr("disabled")
            //$('#id_maiden_name').show();
        }
    }
    function select_date() {
        $('#birth_date').datepicker();
        //alert($("#birth_date"))
    }
</script>