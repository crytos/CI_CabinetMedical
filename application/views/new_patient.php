<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <?php
    $form_attr = array(
        'class' => 'form-horizontal',
    );
    ?>
    <?= form_open('patients/new_patient', $form_attr); ?>
    
    <div class="form-group">
        <label for="gender" class="col-sm-4 col-md-4 control-label">Civilité</label>
        <?php
        $options = array(
            0 => 'Veuillez choisir une option',
            'F' => 'Madame',
            'M' => 'Monsieur',
        );
        $gender_attr = array(
            'id' => 'gender',
            'class' => 'form-control',
            'onChange' => 'disable_maiden_name(this.value)'
        );
        ?>
        <div class="col-sm-6 col-md-4">
            <?= form_dropdown('gender', $options, '', $gender_attr); ?>
        </div>
    </div>
    
    <div class="form-group">
    
        <label for="name" class="col-sm-4 col-md-4 control-label">Nom</label>
        <?php
        $name_attr = array(
            'id' => 'name',
            'placeholder' => 'Nom',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-8 col-md-4">
            <?= form_input('name', '', $name_attr); ?>
        </div>
    </div>
    
    <div class="form-group" id="id_maiden_name">
        <label for="maiden_name" class="col-sm-4 col-md-4 control-label">Nom de Jeune Fille</label>
        <?php
        $maiden_name_attr = array(
            'id' => 'maiden_name',
            'placeholder' => 'Nom de Jeune Fille',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-8 col-md-4">
            <?= form_input('maiden_name', '', $maiden_name_attr); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label for="first_name" class="col-sm-4 col-md-4 control-label">Prénom</label>
        <?php
        $first_name_attr = array(
            'id' => 'first_name',
            'placeholder' => 'Prénom',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-8 col-md-4">
            <?= form_input('first_name', '', $first_name_attr); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label for="birth_date" class="col-sm-4 col-md-4 control-label">Date de Naissance</label>
        <?php
        $birth_date_attr = array(
            'id' => 'birth_date',
            'placeholder' => 'Date de Naissance au format JJ/MM/AAAA',
            'class' => 'form-control',
                //'onclick' => 'select_date()'
        );
        ?>
        <div class="col-sm-8 col-md-4">
            <?= form_input('birth_date', '', $birth_date_attr); ?>
        </div>
    </div>

    <div class="form-group">
        <label for="address" class="col-sm-4 col-md-4 control-label">Adresse</label>
        <?php
        $address_attr = array(
            'id' => 'address',
            'placeholder' => 'Adresse',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-8 col-md-4">
            <?= form_textarea('address', '', $address_attr); ?>
        </div>

    </div>
    
    <div class="form-group">
        <label for="phone_number" class="col-sm-4 col-md-4 control-label">Numéro de Téléphone</label>
        <?php
        $phone_number_attr = array(
            'id' => 'phone_number',
            'placeholder' => 'Numéro de Téléphone',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-8 col-md-4">
            <?= form_input('phone_number', '', $phone_number_attr); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label for="family_situation" class="col-sm-4 col-md-4 control-label">Situation Familiale</label>
        <?php
        $family_situation_options = array(
            0 => 'Veuillez choisir une option',
            1 => 'Célibataire',
            2 => 'Marié(e)',
            3 => 'Divorcé(e)',
            4 => 'Veuf(ve)',
        );

        $family_situa_attr = array(
            'id' => 'family_situation',
            'placeholder' => '',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-6 col-md-4">
            <?= form_dropdown('family_situation', $family_situation_options, '', $family_situa_attr); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="professional_situation" class="col-sm-4 col-md-4 control-label">Situation Professionnelle</label>
        <?php
        $pro_situation_options = array(
            0 => 'Veuillez choisir une option',
            1 => 'Salarié(e)',
            2 => 'Retraité(e)',
            3 => 'Etudiant(e)',
            4 => 'Sans activité',
            5 => 'Commerçant',
            6 => 'Professions libérales',
            7 => 'Agriculteur',
            8 => 'Fonctionnaire',
        );
        $pro_situation_attr = array(
            'id' => 'professional_situation',
            'placeholder' => 'Prof',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-6 col-md-4">
            <?= form_dropdown('professional_situation', $pro_situation_options, '', $pro_situation_attr); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6 col-md-8">
            <?php echo form_submit('submit', 'Enregistrer', 'class="btn btn-default btn-success pull-right"');?>
        </div>
    </div>
    <?php echo validation_errors(); ?>

    <?php echo form_close(); ?> 


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