<?php
error_reporting(E_ERROR | E_PARSE);
loadModel('Login');
$exception = null;
if(count($_POST) > 0){
    $login = new Login($_POST);
    
    try{
        $user = $login->checkLogin();
        echo "Usuário {$user->name} logado :)";
        header("Location: day_records.php");

    }catch(AppException $e){
        $exception = $e;
    }
    

}





loadView('login', $_POST + ['exception' => $exception]);