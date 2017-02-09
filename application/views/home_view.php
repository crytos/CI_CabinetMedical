<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Cabinet BELKAID</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= base_url(); ?>home"><span class="glyphicon glyphicon-home" aria-hidden="true"/></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Patients <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url(); ?>patients/new_patient">Nouveau Patient</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?= base_url(); ?>home">Liste des patients</a></li>
                                <!--<li><a href="< ?= base_url(); ?>patients/download_list">
                                        Liste des patients &nbsp;<span class="glyphicon glyphicon-download" aria-hidden="true"/>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <!--<li class="active"><a href="#">Liste des patients <span class="sr-only">(current)</span></a></li>-->
                        <li><a href="<?= base_url(); ?>appointment">Rendez-vous <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></a></li>
                        <li><a href="<?= base_url(); ?>patients/send_email"><span class="glyphicon glyphicon-download" aria-hidden="true"/></a></li>

                        <?php if (!$is_admin) : ?><li><a href="<?= base_url(); ?>">Document À Télécharger</a></li><?php endif; ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($username !== null) : ?><li><a href="" style="cursor: default">Bienvenue <?= $username; ?>!</a></li><?php endif; ?>
                        <li><a href="<?= base_url(); ?>home/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <?php if (isset($message_display)): ?>
            <div><?= $message_display ?></div>
        <?php endif; ?>
        <div>
            <?php $this->load->view($content); ?>
        </div>
        <!-- Footer -->
        <footer>
            <div class="container">
                <p class="text-center text-muted">Place footer content here.</p>
            </div>
        </footer>
        <script type='text/javascript' src="<?php echo base_url(); ?>public/jquery-2.1.4.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>public/jquery-ui-1.10.4.custom.min.js"></script>
    </body>
</html>