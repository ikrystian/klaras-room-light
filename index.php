<?php
require "Yeelight.class.php";

date_default_timezone_set('Europe/Warsaw');
$currentDateTime = new DateTime();
$lublinLatitude = 51.2465;
$lublinLongitude = 22.5684;
$sunInfo = date_sun_info($currentDateTime->getTimestamp(), $lublinLatitude, $lublinLongitude);
$sunrise = (new DateTime())->setTimestamp($sunInfo['sunrise']);
$sunset = (new DateTime())->setTimestamp($sunInfo['sunset']);
$sunriseEnd = (new DateTime())->setTimestamp($sunInfo['sunrise'] + 1800); // Sunrise lasts for 30 minutes
$sunsetStart = (new DateTime())->setTimestamp($sunInfo['sunset'] - 1800); // Sunset starts 30 minutes before actual sunset

    $yee = new Yeelight("192.168.1.14", 55443);
    $status = $yee->get_prop("power")->commit();
    print_r($status);

    $yee->disconnect();
//if ($currentDateTime >= $sunrise && $currentDateTime <= $sunriseEnd) {
//    $yee = new Yeelight("192.168.1.14", 55443);
//    $yee->set_power('off');
//    $yee->commit();
//    $yee->disconnect();
//} elseif ($currentDateTime >= $sunsetStart && $currentDateTime <= $sunset) {
//    $yee = new Yeelight("192.168.1.14", 55443);
//    $yee->set_power('on');
//    $yee->commit();
//    $yee->disconnect();
//} else {
//    echo "It is neither sunrise nor sunset in Lublin, Poland.";
//}
//
//$filename = 'log.txt';
//if (!file_exists($filename)) {
//    $file = fopen($filename, 'w');
//} else {
//    $file = fopen($filename, 'a');
//}
//
//if ($file) {
//    $current_time = date('d-m-Y H:i:s');
//    fwrite($file, $current_time . " - New log entry\n");
//    fclose($file);
//    echo "Log entry written successfully.";
//} else {
//    echo "Failed to open the file.";
//}