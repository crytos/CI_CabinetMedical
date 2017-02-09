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
<?php if ($medical_folder_details) : ?>
    <div class="container">

        <div class="text-center alert alert-info" role="alert">
            <?php $date_created = new DateTime($medical_folder_details[0]->date_created); ?>
            <span class="">Dossier N° <?= $patient[0]->identification_number ?>&nbsp; Créé le <?= $date_created->format('d/m/Y à H:i:s') ?></span>
                <!--<?= ($patient[0]->gender == 'M') ? 'Monsieur' : 'Madame' ?> <?= $patient[0]->name ?>-->
        </div>

        <div class="btn-group btn-group-justified" role="group" aria-label="..." style="margin-top:5px;margin-bottom:10px;">
            <div class="btn-group" role="group">
                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#fiche_admin" aria-expanded="true" aria-controls="fiche_admin">
                    <span class="text-center">Fiche Administrative</span>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#biometrie" aria-expanded="false" aria-controls="biometrie">
                    <span class="text-center">Biométrie</span>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#atcd" aria-expanded="false" aria-controls="atcd">
                    <span class="text-center">Antécédants</span>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#consultation" aria-expanded="false" aria-controls="consultation">
                    <span class="text-center">Consultations</span>
                </button>
            </div>
            <!--<div class="col-md-2 btn-group" role="group" style="border: solid">
                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#ordonnance" aria-expanded="true" aria-controls="ordonnance">
                    <span class="col-md-4 text-center">Ordonnances</span>
                </button>
            </div>-->
        </div>
        <div class="panel-body">
            <div class="row">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Nom</th>
                        <?php if ($patient[0]->gender == 'F' and $family_situation_options[$patient[0]->family_situation] == 1): ?>
                            <th>Nom de jeune fille</th>
                        <?php endif; ?>
                        <th>Prénom</th>
                        <th>Date de Naissance</th>
                    </tr>
                    <tr>
                        <td><?= $patient[0]->name ?></td>
                        <?php if ($patient[0]->gender == 'F' and $family_situation_options[$patient[0]->family_situation] == 1): ?>
                            <td><?= $patient[0]->maiden_name ?></td>
                        <?php endif; ?>
                        <td><?= $patient[0]->first_name ?></td>
                        <?php $birth_date = new DateTime($patient[0]->birth_date); ?>
                        <td><?= $birth_date->format('d/m/Y') ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="collapse" id="fiche_admin">
            <div class="panel-body">
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Adresse</th>
                            <th>Situation Familiale</th>
                            <th>Situation Professionnelle</th>
                            <th>N° Téléphone</th>
                        </tr>
                        <tr>
                            <td><?= $patient[0]->address ?></td>
                            <td><?= $family_situation_options[$patient[0]->family_situation] ?></td>
                            <td><?= $pro_situation_options[$patient[0]->professional_situation] ?></td>
                            <td><?= $patient[0]->phone_number ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="collapse" id="biometrie">
            <div class="panel-body">
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Taille</th>
                            <th>Poids</th>
                            <th>IMC</th>
                            <th>Groupe Sainguin</th>
                        </tr>
                        <tr>
                            <td><?= ($medical_folder_details[0]->height != null) ? (int) ($medical_folder_details[0]->height / 100) . 'm' . ($medical_folder_details[0]->height % 100) : 'N/A' ?></td>
                            <td><?= ($medical_folder_details[0]->weight != null) ? $medical_folder_details[0]->weight . ' Kg' : 'N/A' ?></td>
                            <td><?= ($medical_folder_details[0]->imc != null) ? $medical_folder_details[0]->imc : 'N/A' ?></td>
                            <td><?= ($medical_folder_details[0]->blood_group != null) ? substr($medical_folder_details[0]->blood_group, 0, -1) . ' RH ' . substr($medical_folder_details[0]->blood_group, -1) : 'N/A' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="collapse" id="atcd">
            <div class="panel-body">
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <caption>Antécédants Personnels</caption>
                        <tr>
                            <th>Médicaux</th>
                            <th>Chirurgicaux</th>
                        </tr>
                    </table>
                    <table class="table table-striped table-bordered">
                        <caption>Antécédants Familiaux</caption>
                        <tr>
                            <th>Médicaux</th>
                            <th>Chirurgicaux</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="collapse" id="consultation">
            <div class="panel-body">
                <div class="row">
                    <?php if ($consultations_query->num_rows() > 0) : ?>
                        <table class="table table-striped table-hover table-bordered">
                            <tr>
                                <th>Date de Consultation</th>
                                <th>Motif</th>
                                <th>Observations</th>
                            </tr>
                            <?php foreach ($consultations_query->result() as $consultation) { ?>
                                <tr>
                                    <?php $consultation_date = new DateTime($consultation->consultation_date); ?>
                                    <td><?= $consultation_date->format('d/m/Y à H:i:s') ?> </td>
                                    <td><?= $consultation->consultation_reason ?></td>
                                    <td><?= str_replace(";", "<br>", $consultation->observations) ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            Première visite de <?= ($patient[0]->gender == 'M') ? 'Monsieur' : 'Madame' ?> <?= $patient[0]->name ?>!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--<div class="collapse" id="ordonnance">
            <div class="well">
                123456789
            </div>
        </div>-->
    </div>
<?php else : ?>
    <div class="container">
        <div class="row">
            <div class="alert alert-warning" role="alert">
                Aucun dossier médical trouvé pour <?= ($patient[0]->gender == 'M') ? 'Monsieur' : 'Madame' ?> <?= $patient[0]->name ?>!
                <a href ="<?php echo site_url('medical_folder/new_folder/' . $patient[0]->id); ?>" type="button" class="btn btn-info btn-sm pull-right">
                    Créer le dossier
                </a>
            </div>
        </div>

    </div>
<?php endif; ?>
