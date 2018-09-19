<?php
require ('phpMQTT.php');


$name = $_POST['name'];
$temp = $_POST['value'];


if (isset($_POST['name']) && isset($_POST['value'])){
$name = $_POST['name'];
$temp = $_POST['value'];

$mqtt = new phpMQTT ("146.87.2.99", 1883, "test"); //Change client name to something unique
if ($mqtt->connect()) {
	$mqtt->publish("/g4/$name","$temp");
	$mqtt->close();
	}
}

require_once("view/setpoint.phtml");
