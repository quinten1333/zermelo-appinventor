<?php
// Including the Zermelo API PHP using Composer
//require('vendor/autoload.php');

// Including the Zermelo API PHP using the build-in autoloader
require('custom_autoload.php');

register_zermelo_api();

// Create a new Zermelo instance
$zermelo = new ZermeloAPI($_GET['school']);

$user = $_GET['user'];
$code = $_GET['code'];

//  vrij; uitval,vak,docent,lokaal;

// Get a new access token using a username and code
$zermelo->grabAccessToken($user, $code);

echo "registered";
