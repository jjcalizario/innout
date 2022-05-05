<?php
session_start();
requireValidSession();
loadModel('WorkingHours');

$user = $_SESSION['user'];
$records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));


try{
$date = new DateTime();
$currentTime = $date->format('H:i:s');
echo ($currentTime);
$records->innout($currentTime);
addSuccessMsg("Ponto Adicionado com sucesso!");
}catch(AppException $e){
    addErrorMsg($e->getMessage());
}
header('Location: day_records.php');