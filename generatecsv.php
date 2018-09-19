<?php

require_once('model/SensorDAO.php');
date_default_timezone_set('Europe/London');
$dao = new SensorDAO;
$view = new stdClass();

$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];
$sensor_id = $_POST['sensor_id'];

$date_from=DateTime::createFromFormat('d-m-Y H:i:s', $date_from);
$date_from = $date_from->format('Y-m-d H:i:s');

$date_to =DateTime::createFromFormat('d-m-Y H:i:s', $date_to);
$date_to = $date_to->format('Y-m-d H:i:s');

$data = array(
"date_from" => $date_from ,
  "date_to" => $date_to,
 "sensor_id"=> $sensor_id,
);

$view->dao = $dao->generateCsv($data);
require_once("view/download.phtml");
