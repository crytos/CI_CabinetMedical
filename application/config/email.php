<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 465;

$config['smtp_user'] = '<FILL_IN>';
$config['smtp_pass'] = '<FILL_IN>'; 

$config['sender_mail'] = '<FILL_IN>';
$config['sender_name'] = '<FILL_IN>';

$config['mailtype'] = 'html';
$config['charset'] = 'UTF-8';
$config['wordwrap'] = TRUE;

$config['newline'] = "\r\n";

