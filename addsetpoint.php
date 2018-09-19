<?php

require_once('model/SensorDAO.php');


if (isset($_POST['name']) && isset($_POST['location'])) {
        $data = array(
            "name" => $_POST['name'],
            "location" => $_POST['location']
        );
$dao = new SensorDAO;
$dao->addNewSensor($data);
}else{
  echo "failed";
}
require_once("setpoint.php");
