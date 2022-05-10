<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
requireValidSession();



$date = (new Datetime())->getTimestamp();
$today = strftime('%d de %B de %Y', $date);




loadTemplateView('day_records',[
        'today' =>$today]);