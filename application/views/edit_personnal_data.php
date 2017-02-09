<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <div class="row">
        <div class="alert alert-info text-center" role="alert">
            <h4>Formulaire de modification des informations personnelles du patient</h4>
        </div>
    </div>

    <?php
    $form_attr = array(
        'class' => 'form-horizontal',
    );
    ?>
    <?= form_open('patients/edit_personnal_data/' . $patient[0]->id, $form_attr); ?>
    <div class="form-group">
        <label for="gender" class="col-sm-2 control-label">Civilité</label>
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
        <div class="col-sm-4">
            <?= form_dropdown('gender', $options, $patient[0]->gender, $gender_attr); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Nom</label>
        <?php
        $name_attr = array(
            'id' => 'name',
            'placeholder' => 'Nom',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-10">
            <?= form_input('name', $patient[0]->name, $name_attr); ?>
        </div>
    </div>
    <div class="form-group" id="id_maiden_name">
        <label for="maiden_name" class="col-sm-2 control-label">Nom de Jeune Fille</label>
        <?php
        $maiden_name_attr = array(
            'id' => 'maiden_name',
            'placeholder' => 'Nom de Jeune Fille',
            'class' => 'form-control',
                //'disabled' => ($patient[0]->gender == 'M') ? 'disabled' : ''
        );
        ?>
        <?php
        if ($patient[0]->gender == 'M') {
            $maiden_name_attr['disabled'] = 'disabled';
        }
        ?>
        <div class="col-sm-10">
            <?= form_input('maiden_name', $patient[0]->maiden_name, $maiden_name_attr); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="first_name" class="col-sm-2 control-label">Prénom</label>
        <?php
        $first_name_attr = array(
            'id' => 'first_name',
            'placeholder' => 'Prénom',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-10">
            <?= form_input('first_name', $patient[0]->first_name, $first_name_attr); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="phone_number" class="col-sm-2 control-label">Num de Téléphone</label>
        <?php
        $phone_number_attr = array(
            'id' => 'phone_number',
            'placeholder' => 'Num de téléphone',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-10">
            <?= form_input('phone_number', $patient[0]->phone_number, $phone_number_attr); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="birth_date" class="col-sm-2 control-label">Date de Naissance</label>
        <?php
        $birth_date_attr = array(
            'id' => 'birth_date',
            'placeholder' => 'Date de Naissance',
            'class' => 'form-control',
                //'onclick' => 'select_date()'
        );
        ?>
        <div class="col-sm-10">
            <?php
            $formattedBirthDate = date("d/m/Y", strtotime($patient[0]->birth_date));
            ?>
            <?= form_input('birth_date', $formattedBirthDate, $birth_date_attr); ?>
        </div>
    </div>

    <div class="form-group">
        <label for="family_situation" class="col-sm-2 control-label">Situation Familiale</label>
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
            'placeholder' => 'Fami',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-4">
            <?= form_dropdown('family_situation', $family_situation_options, $patient[0]->family_situation, $family_situa_attr); ?>
        </div>
        <label for="professional_situation" class="col-sm-2 control-label">Situation Professionnelle</label>
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
        <div class="col-sm-4">
            <?= form_dropdown('professional_situation', $pro_situation_options, $patient[0]->professional_situation, $pro_situation_attr); ?>
        </div>
    </div>

    <div class="form-group">
        <label for="address" class="col-sm-2 control-label">Adresse</label>
        <?php
        $address_attr = array(
            'id' => 'address',
            'placeholder' => 'Adresse',
            'class' => 'form-control'
        );
        ?>
        <div class="col-sm-10">
            <?= form_textarea('address', $patient[0]->address, $address_attr); ?>
        </div>

    </div>
    <div class="form-group">
        <?php
        echo form_submit('submit', 'Sauvegarder', 'class="btn btn-default btn-success pull-right", style="margin-right:15px"');
        ?>
    </div>
    <?php echo validation_errors(); ?>

    <?php echo form_close(); ?> 


</div>
<script>
    function disable_maiden_name(selectedValue) {
        if (selectedValue == 'M') {
            $('#maiden_name').val("")
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