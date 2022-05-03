<?php

function getDateasDateTime($date){
    return is_string($date) ? new DateTime($date) : $date;
}

function isWeekend ($date){
    $inputDate = getDateasDateTime($date);

    return $inputDate->format('N') >= 6;

}

function isBefore($date1, $date2){
    $inputDate1 = getDateasDateTime($date1);
    $inputDate2 = getDateasDateTime($date2);

    return $inputDate1 <= $inputDate2;
}

function getNextDay($date){
    $inputDate = getDateasDateTime(($date));
    $inputDate->modify('+1 day');

}


