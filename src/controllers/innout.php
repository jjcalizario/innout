<?php
session_start();
requireValidSession();


$user = $_SESSION['user'];
$records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));


try{
$date = new DateTime();
$currentTime = $date->format('H:i:s');

if($_POST['forcedTime']){
    $currentTime=$_POST['forcedTime'];

}

$records->innout($currentTime);
addSuccessMsg("Ponto adicionado com sucesso!");
}catch(AppException $e){
    addErrorMsg($e->getMessage());
}
header('Location: day_records.php');