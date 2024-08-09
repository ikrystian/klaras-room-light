<?php
require "Yeelight.class.php";

date_default_timezone_set('Europe/Warsaw');
$currentDateTime = new DateTime();
$lublinLatitude = 51.2465;
$lublinLongitude = 22.5684;
$sunInfo = date_sun_info($currentDateTime->getTimestamp(), $lublinLatitude, $lublinLongitude);
$sunrise = (new DateTime())->setTimestamp($sunInfo['sunrise']);
$sunset = (new DateTime())->setTimestamp($sunInfo['sunset']);
$sunriseEnd = (new DateTime())->setTimestamp($sunInfo['sunrise'] + 120); // Sunrise lasts for 30 minutes
$sunsetStart = (new DateTime())->setTimestamp($sunInfo['sunset'] - 120); // Sunset starts 30 minutes before actual sunset
$yee = new Yeelight("192.168.1.14", 55443);

if ($currentDateTime >= $sunrise && $currentDateTime <= $sunriseEnd) {
    $yee->set_power('on')->set_bright(100)->commit();

} elseif ($currentDateTime >= $sunsetStart && $currentDateTime <= $sunset) {
    $yee->set_power('off')->commit();
}

$yee->disconnect();
