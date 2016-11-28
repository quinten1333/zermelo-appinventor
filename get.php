<?php

// Including the Zermelo API PHP using Composer
//require('vendor/autoload.php');

// Including the Zermelo API PHP using the build-in autoloader
require('custom_autoload.php');

register_zermelo_api();

// Create a new Zermelo instance
$zermelo = new ZermeloAPI($_GET['school']);

$user = $_GET['user'];
//  vrij; uitval,vak,docent,lokaal;

// Get a new access token using a username and code
$zermelo->grabAccessToken($user, $code);

$days = ['Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag'];
$monday = strtotime(date('Y-m-d')) - 86400 * (date('N') - 1);

foreach($days as $day){
$start = $monday + 86400 * array_search($day,$days);
$grid = $zermelo->getStudentGrid($user,$start,$start + 86400);

$hour = 1;
foreach($grid as $class){
  while($hour != $class['startTimeSlot']){
    echo "1,vrij;";
    $hour = $hour + 1;
  }
  if($class['cancelled'] == 1){
    echo "1,";
  } else {
    echo "0,";
  }

  echo $class['subjects'][0] . "-";
  echo $class['teachers'][0] . "-";
  echo $class['locations'][0];

  $hour = $hour + 1;
  echo ";";
}

while($hour <= 6){
  echo "1,vrij;";
  $hour = $hour + 1;
}
}
