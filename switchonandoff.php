<?php
require_once('model/SensorDAO.php');


$view = new stdClass();


if (isset($_POST['on'])){
  $data = array(
      "id" => $_POST['on'],
  );
$dao = new SensorDAO;
$view->dao = $dao->switchoff($data);
}
else if (isset($_POST['off'])){
  $dao = new SensorDAO;
  $data = array(
      "id" => $_POST['off'],
  );
$view->dao = $dao->switchon($data);
}
$location= '/setpoint.php';
header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
