<?php

require_once('model/SensorDAO.php');

$dao = new SensorDAO;
$view = new stdClass();

$view->dao = $dao->fetchAllSensors();
require_once("view/index.phtml");
