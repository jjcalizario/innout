<?php
loadModel('WorkingHours');

Database::executeSql('DELETE FROM working_hours');
Database::executeSql('DELETE FROM users where id> 5');

function getDayTemplateByOdds($regularRate, $extraRate, $lazyRate){
    $regularDayTemplate = [
        "time1" => "08:00:00",
        "time2" => "12:00:00",
        "time3" => "13:00:00",
        "time4" => "17:00:00",
        "worker_time" => DAILY_TIME
    ];
    
    $extraHourDayTemplate = [
        "time1" => "08:00:00",
        "time2" => "12:00:00",
        "time3" => "13:00:00",
        "time4" => "18:00:00",
        "worker_time" => DAILY_TIME + 3600
    ];
    $lazyDayTemplate = [
        "time1" => "08:30:00",
        "time2" => "12:00:00",
        "time3" => "13:00:00",
        "time4" => "18:00:00",
        "worker_time" => DAILY_TIME - 1800
    ];

    $value = rand(0, 100);
    if($value <= $regularRate){
        return $regularDayTemplate;
    } elseif ($value <=$regularRate + $extraRate){
        return $extraHourDayTemplate;
    }
    else{
        return $lazyDayTemplate;
    }

    
}

function populateWorkingHours($userId, $initialDate, $regularRate, $extraRate, $lazyRate){
    $currentDate = $initialDate; 

}