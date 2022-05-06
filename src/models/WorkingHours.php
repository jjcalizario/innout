<?php

use LDAP\Result;

class WorkingHours extends Model
{
    protected static $tableName = "working_hours";
    protected static $columns = [
        'id',
        'user_id',
        'work_date',
        'time1',
        'time2',
        'time3',
        'time4',
        'worked_time'
    ];

    public static function loadFromUserAndDate($userId, $workDate)
    {
        $registry = self::getOne(['user_id' => $userId, 'work_date' => $workDate]);

        if (!$registry) {
            $registry = new WorkingHours([
                'user_id' => $userId,
                'work_date' => $workDate,
                'worked_time' => '0'
            ]);
        }
        return $registry;
    }

    public function getNextTime()
    {
        if (!$this->time1) return 'time1';
        if (!$this->time2) return 'time2';
        if (!$this->time3) return 'time3';
        if (!$this->time4) return 'time4';
        return null;
    }

    public function getActiveClock(){
        $nextTime = $this->getNextTime();
        if($nextTime === 'time1' || $nextTime === 'time3'){
            return 'exitTime';
        }elseif ($nextTime === 'time2' || $nextTime === 'time4'){
            return 'workedInterval';
        }else{
            return null;
        }
    }
    public function innout($time)
    {
        $timeColumn = $this->getNextTime();
        if (!$timeColumn) {
            throw new AppException("Você já efetuou os quatro batimentos do dia!");
        }

        $this->$timeColumn = $time;
        $this->worked_time = strval(getSecondsFromDateInterval($this->getWorkedInterval()));
        
        if ($this->id) {
            $this->update();
        } else {
            $this->insert();
        }
    }

   

    function getWorkedInterval()
    {
        [$t1, $t2, $t3, $t4] = $this->getTimes();

        $part1 = new DateInterval('PT0S');
        $part2 = new DateInterval('PT0S');

        if ($t1) $part1 = $t1->diff(new DateTime());
        if ($t2) $part1 = $t1->diff($t2);
        if ($t3) $part2 = $t3->diff(new DateTime());
        if ($t4) $part2 = $t3->diff($t4);

        return sumIntervals($part1, $part2);
    }

    function getExitTime()
    {
        [$t1,,, $t4] = $this->getTimes();
        $workDay = DateInterval::createFromDateString('8 hours');

        if(!$t1){
            return(new DateTimeImmutable())->add($workDay);
        }elseif ($t4){
            return $t4;
        }else{
            $total = sumIntervals($workDay, $this->getLunchInterval());
            return $t1->add($total);
        }
    }


    function getLunchInterval()
    {
        [, $t2, $t3,] = $this->getTimes();
        $lunchInterval = new DateInterval('PT0S');
        if ($t2) $lunchInterval = $t2->diff(new DateTime());
        if ($t3) $lunchInterval = $t2->diff($t3);

        return $lunchInterval;
    }
    private function getTimes()
    {
        $times = [];

        $this->time1 ? array_push($times, getDateFromString($this->time1)) : array_push($times, null);
        $this->time2 ? array_push($times, getDateFromString($this->time2)) : array_push($times, null);
        $this->time3 ? array_push($times, getDateFromString($this->time3)) : array_push($times, null);
        $this->time4 ? array_push($times, getDateFromString($this->time4)) : array_push($times, null);

        return $times;
    }

    public static function getMonthlyReport($userId, $date){
        $registries = [];
        $startDate = getFirstDayofMonth($date)->format('Y-m-d');
        $endDate = getLastDayofMonth($date)->format('Y-m-d');

        $result = static::getResultSetFromSelect([
            'user_id' => $userId,
            'raw' => "work_date between '{$startDate}' AND '{$endDate}'"
        ]);

        if($result){
            while($row = $result->fetch_assoc()){
                $registries[$row['work_date']]= new WorkingHours($row);
            }
        }
        return $registries;
    }

}
