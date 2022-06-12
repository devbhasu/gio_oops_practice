<?php 

require_once __DIR__. "/vendor/autoload.php";
use App\Test;

define('STORAGE_PATH', __DIR__. '\storage');
// echo $_SERVER['SERVER_NAME']. "/".  $_SERVER['REQUEST_URI'];
// var_dump($_SERVER);
$testobj = new Test();
$uploaded_path = $testobj->upload();
$transcations[] =  $testobj->getTranscation();
// var_dump($transcations);
include('app/view/index.php');