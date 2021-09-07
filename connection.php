<?php


$config = require 'config.php';


$mysqli = new mysqli(
    $config['mysql_host'],
    $config['mysql_user'],
    $config['mysql_password'],
    $config['mysql_db']
);
$mysqli -> set_charset("utf8");
 unset($config);
var_dump($mysqli);die;
 if($mysqli->connect_error){
     die($mysqli->connect_error);
 }