<?php

$serverName = "db.devcm.info";
$connectionOptions = array(
    "Database" => "PKStudents_Wangchin",
    "Uid" => "sa",
    "PWD" => "NJNqINdc9Ik9RKkt",
    "CharacterSet" => "UTF-8"
);


$GLOBALS['conn'] = sqlsrv_connect($serverName, $connectionOptions) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");

