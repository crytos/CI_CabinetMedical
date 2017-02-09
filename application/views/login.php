<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Connexion A La Plateforme Du Cabinet</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php
            $form_attr = array(
                'class' => 'form-signin well well-sm',
                'style' => 'margin-top:200px'
            );
            echo form_open('login', $form_attr);
            ?>
            <h2 class="text-muted text-center">Cabinet BELKAID</h2>
            <hr style="">
            <div class="form-group">
                <?php
                $identifiant_attr = array(
                    'id' => 'username',
                    'placeholder' => 'Identifiant',
                    'class' => 'form-control'
                );
                echo form_input('username', '', $identifiant_attr);
                ?>
            </div>
            <div class="form-group">
                <?php
                $password_attr = array(
                    'id' => 'password',
                    'placeholder' => 'Mot de passe',
                    'min_length' => 6,
                    'class' => 'form-control'
                );
                echo form_password('password', '', $password_attr);
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_submit('submit', 'Se Connecter', 'class="btn btn-lg btn-primary btn-block"');
                ?>
            </div>
            <?php echo validation_errors(); ?>

            <?php echo form_close(); ?> 

            <div style="margin-left: auto;margin-right:auto;width:110px;">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Besoin d'aide ?</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Contacts</h4>
                        </div>
                        <div class="modal-body">
                            <address>
                                <strong>Anès MAHI</strong><br>
                                <a href="mailto:#">anes.mahi@gmail.com</a><br>
                                <span class="glyphicon glyphicon-phone"/>(123) 456-7890
                            </address>
                        </div>
                        <!--<div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary">Sauvegarder</button>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>

        <script type='text/javascript' src="<?php echo base_url(); ?>public/jquery-2.1.4.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    </body>
</html>
