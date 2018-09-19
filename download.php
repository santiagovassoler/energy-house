<?php

require_once('model/SensorDAO.php');

$dao = new SensorDAO;
$view = new stdClass();

$id = $_GET['sensor'];

$data = array(
"id" => $id,
);
$result = $dao->fetchSensorByID($data);

require_once("view/download.phtml");
