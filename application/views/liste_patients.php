<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$family_situation_options = array(
    0 => 'Veuillez choisir une option',
    1 => 'Célibataire',
    2 => 'Marié(e)',
    3 => 'Divorcé(e)',
    4 => 'Veuf(ve)',
);
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
?>
<div>
    <table class="table table-striped table-hover">
        <tr>
            <th>Civilité</th>
            <th>N° Patient</th>
            <th>Nom</th>
            <th>Nom De Jeune Fille</th>
            <th>Prénom</th>
            <th>Date de Naissance</th>
            <th>Situation Familiale</th>
            <th>Situation Professionnelle</th>
            <th>Numéro de Télephone</th>
            <th></th>
        </tr>
        <?php foreach ($patients as $patient) { ?>
            <tr>
                <td>
                    <span class="glyphicon glyphicon-user" style="color:<?= ($patient->gender == 'F') ? '#FA58AC' : '#0080FF' ?>" aria-hidden="true"></span>
                </td>
                <td><?= $patient->identification_number ?></td>
                <td><?= $patient->name ?></td>
                <td><?= $patient->maiden_name ?></td>
                <td><?= $patient->first_name ?></td>
                <?php $birth_date = new DateTime($patient->birth_date); ?>
                <td><?= $birth_date->format('d/m/Y') ?> ( ans)</td>
                <td><?= $family_situation_options[$patient->family_situation] ?></td>
                <td><?= $pro_situation_options[$patient->professional_situation] ?></td>
                <td><?= $patient->phone_number ?></td>
                <td>
                    <?php if ($is_admin) : ?> 
                        <a href="<?php echo site_url('medical_folder/preview/' . $patient->id); ?>"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"/></a>&nbsp;
                    <?php endif; ?>
                    <a href="<?php echo site_url('patients/edit_personnal_data/' . $patient->id); ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
