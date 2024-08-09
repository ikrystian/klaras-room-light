<?php
date_default_timezone_set('Europe/Warsaw');

$currentDateTime = new DateTime();
$lublinLatitude = 51.2465;
$lublinLongitude = 22.5684;

// Get sun information
$sunInfo = date_sun_info($currentDateTime->getTimestamp(), $lublinLatitude, $lublinLongitude);

$sunrise = (new DateTime())->setTimestamp($sunInfo['sunrise']);
$sunset = (new DateTime())->setTimestamp($sunInfo['sunset']);

// Initialize Yeelight once
$yee = new Yeelight("192.168.1.14", 55443);

// Determine if it's daytime or nighttime
if ($currentDateTime >= $sunrise && $currentDateTime <= $sunset) {
    $yee->set_power('on')->set_bright(100);
} else {
    $yee->set_power('off');
}

// Commit the changes and disconnect
$yee->commit();
$yee->disconnect();