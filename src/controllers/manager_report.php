<?php

error_reporting(E_ERROR | E_PARSE);
session_start();
requireValidSession(true);

$activeUsersCount = User::getActiveCount();
$absentUsers = WorkingHours::getAbsentUsers();
$yearAndMonth = (new DateTime())->format('Y-m');

$seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);
$hoursInMonth = explode(':',getTimeStringFromSeconds($seconds))[0];

loadTemplateView('manager_report', [
    'activeUsersCount' => $activeUsersCount,
    'absentUsers' => $absentUsers,
    'hoursInMonth' => $hoursInMonth,
]);