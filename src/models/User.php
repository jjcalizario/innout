<?php



class User extends Model{

    protected static $tableName ="users";
    protected static $colums = [
        'id',
        'name',
        'password',
        'email',
        'start_date',
        'end_date',
        'is_admin',
    ];

    public static function getActiveCount(){
        return static::getCount(['raw' => 'end_date IS NULL']);
    }

}