<?php

require_once ('../model/SensorDAO.php');
require_once('../model/Sensor.php');

class SensorTest {
  public $sensorDAO;

  public function __construct(){
    $this->sensorDAO = new SensorDAO;
    $this->testAddNewSensor();
    $this->testAddReading();
    $this->testGenerateCsv();
    $this->testFetchAllSensors();
    $this->testFetchSensorByID();
  }

  public function testAddNewSensor()
  {
    echo "-----  test add new sensor ------<br>";
    $data = array(
            "name" => 'setpoint89',
            "location" => 'room_821',
        );
    if($this->sensorDAO->addNewSensor($data)){
      echo "Passed <br>";
    }else{
      echo "Failed <br>";
    }
  }

  public function testAddReading()
  {
    echo "-----  test add new reading ------<br>";
    $data = array(
    "sensor_id" =>'3' ,
        "value" => '35',
    );
    if($this->sensorDAO->addReading($data)){
      echo "Passed<br>";
    }else{
      echo "Failed<br>";
    }
  }

  public function testGenerateCsv()
  {
    echo "-----  test generat csv file ------<br>";
    $data = array(
    "date_from" => '2017-01-21 01:00:00' ,
      "date_to" => '2017-01-21 01:04:00',
     "sensor_id"=> '4',
    );

    if($this->sensorDAO->generateCsv($data)){
      echo "Passed<br>";
    }else{
      echo "Failed<br>";
    }
  }

  public function testFetchAllSensors(){
    echo "-----  test fetch all sensors ------<br>";
    if($this->sensorDAO->fetchAllSensors()){
      echo "Passed<br>";
    }else{
      echo "Failed<br>";
    }
  }

  public function testFetchSensorByID(){
    echo "-----  test fetch sensor by id ------<br>";
    $data = array(
    "id" => '1',
    );
    if($this->sensorDAO->fetchSensorByID($data)){
      echo "Passed<br>";
    }else{
      echo "Failed<br>";
    }
  }

}
?>
<?php new SensorTest; ?>
<?php
require_once ('../model/Database.php');
require_once('../model/Sensor.php');
?>
