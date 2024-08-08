<?php
require "Yeelight.class.php";
$yee = new Yeelight("192.168.1.14", 55443);

$yee->set_power('on');

$yee->commit();

$yee->disconnect();
