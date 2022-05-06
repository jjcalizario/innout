<?php
//CONTROLLER TEMPORÁRIO
session_start();
requireValidSession();
loadModel('WorkingHours');

$user = $_SESSION['user'];
$wh = WorkingHours::loadFromUserAndDate($user->id, date ('Y-m-d'));

$workedIntervalString = $wh->getWorkedInterval()->format('%H:%I:%S');
print_r($workedIntervalString);

echo ('<br>');
print_r($wh->getExitTime());

