<?php

session_start();
requireValidSession();


$date = (new DateTime())->getTimestamp();
setlocale(LC_ALL, 'pt_BR.utf-8');
$today = date('d M y', strtotime($date));

loadTemplateView('day_records',['today' =>$today]);