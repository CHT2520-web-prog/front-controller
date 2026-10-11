<?php
namespace App\Models;

class Film
{
    // Must have public properties for PDO to create objects based on the class
    public string $id;
    public string $title;
    public int $year;
    public int $duration;

    public function __construct()
    {
        //We must leave empty for PDO to create objects based on the class
    }

    function getAge():int{
        return date("Y") - $this->year;
    }
}
