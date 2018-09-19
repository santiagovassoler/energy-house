<?php

require_once('model/SensorDAO.php');

$dao = new SensorDAO;
$view = new stdClass();

$view->dao = $dao->fetchSetpoints();

require_once("view/setpoint.phtml");
