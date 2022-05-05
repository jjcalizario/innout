<?php
//CONTROLLER TEMPORÁRIO
loadModel('WorkingHours');

$wh = WorkingHours::loadFromUserAndDate(1, date ('Y-m-d'));

$workedInterval= $wh->getWorkedInterval()->format('%H:%I:%S');
print_r($workedInterval);
echo ('<br>');

