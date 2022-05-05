<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
requireValidSession();

loadModel('WorkingHours');

date_default_timezone_set('America/Sao_Paulo');
$date = new DateTime();
$today = $date->format('d/ M/ Y');


$user = $_SESSION['user'];
$records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

loadTemplateView('day_records',[
        'today' =>$today,
        'records'=> $records]);