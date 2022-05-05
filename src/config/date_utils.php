<?php

function getDateasDateTime($date){
    return is_string($date) ? new DateTime($date) : $date;
}

function isWeekend ($date){
    $inputDate = getDateAsDateTime($date);
    return $inputDate->format('N') >= 6;

}

function isBefore($date1, $date2){
    $inputDate1 = getDateasDateTime($date1);
    $inputDate2 = getDateasDateTime($date2);

    return $inputDate1 <= $inputDate2;
}

function getNextDay($date){
    $inputDate= getDateasDateTime($date);
        
    return $inputDate->modify('+1 day');
    
}

function sumIntervals($interval1, $interval2){
    $date = new DateTime('00:00:00');
    $date->add($interval1);
    $date->add($interval2);
    return (new DateTime('00:00:00'))->diff($date);
}

function subtractIntervals($interval1, $interval2){
    $date = new DateTime('00:00:00');
    $date->add($interval1);
    $date->sub($interval2);
    return (new DateTime('00:00:00'))->diff($date);
}

function getDateFromInterval($interval){
    return new DateTimeImmutable($interval->format('%H:%i:%s'));

}

function getDateFromString($strg){
    return DateTimeImmutable::createFromFormat('H:i:s', $strg);
}


