<?php
require_once ('Database.php');
require_once ('Sensor.php');

class SensorDAO

{
  protected $dbConnection, $dbInstance;

  public function __construct() {
    $this->dbInstance = Database::getInstance();
    $this->dbConnection = $this->dbInstance->getDbConnection();
  }

  public function addNewSensor($data){
    $name = $this->validateName($data['name']);
    $sql = 'INSERT INTO sensor (name, location) VALUES (:name, :location)';
    $result = $this->dbConnection->prepare($sql);
    $result->execute(array(
      ':name' => $name,
      ':location' => $data['location']
    ));
    return $this->dbConnection->lastInsertId();
  }

  public function validateName($name){
    $query = $this->dbConnection->prepare("SELECT COUNT(*) AS count FROM sensor WHERE name = :name");
    $query->bindParam(":name", $name, PDO::PARAM_STR);
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $name_count = $row["count"];
    }
    if ($name_count > 0) {
      echo "This sensor name is already in use";
    }else{
      return $name;
    }
  }

  public function addReading($data){
    $sql = 'INSERT INTO reading (sensor_id, value, date_time) VALUES (:sensor_id,:value, NOW())';
    $result = $this->dbConnection->prepare($sql);
    $result->execute(array(
      ':sensor_id' => $data['sensor_id'],
      ':value' => $data['value'],
    ));
    return $this->dbConnection->lastInsertId();
  }

  public function makeDir($param)
  {
    $directory = $_SERVER['DOCUMENT_ROOT'].'/'.$param.'/';
    if (!is_dir($directory)) {
      if(!mkdir($directory,0777, true)){
        die("failed to create folder");
      }
    }
    return $directory;
  }

  public function generateCsv($data))
  {
      $query =("SELECT value , date_format(date_time, '%d-%m-%Y')
      AS day, date_format(date_time, '%H:%i:%s')
      AS time FROM reading WHERE
      date_time BETWEEN :date_from AND :date_to AND
      sensor_id =:sensor_id"
    );
    $results = $this->dbConnection->prepare($query);
    $results->execute(array(
      ':date_from' => $data['date_from'],
      ':date_to' => $data['date_to'],
      ':sensor_id' => $data['sensor_id'],
    ));

    $results->rowCount();
    if($results->rowCount() > 0){
      $file_location = $this->makeDir($data['sensor_id']);
      $file_name = $data['date_from']."-TO-".$data['date_to'].".csv";
      $file_export = $file_location . $file_name;
      $data_to = fopen($file_export, 'w');
      $csv_fields = array();
      $csv_fields[] = 'value';
      $csv_fields[] = 'day';
      $csv_fields[] = 'time';
      fputcsv($data_to, $csv_fields);
      while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($data_to, $row);
      }
      fclose($data_to);
      return 'success';
    }else{
      echo "no data available";
    }
}

function fetchSensorByID($data)
    {
      $sql = 'SELECT id , name , location , status FROM sensor WHERE id = :id';
      $results = $this->dbConnection->prepare($sql);
      $results->execute(array(
          ':id' => $data['id'],
      ));
      $row = $results->fetch();
      if($row) {
          $sensor = new Sensor($row);
      } else {
          $sensor = NULL;
      }
      return $sensor;
    }

    function fetchAllSensors()
    {
        $sql = "SELECT id , name , location , status FROM sensor";
        $results = $this->dbConnection->prepare($sql);
        $results->execute();
        $sensorArray = array();
        while ($row = $results->fetch()) {
            $sensorArray[] = new Sensor($row);
        }
        return $sensorArray;
    }

    public function switchon($data)
    {
      $sql = 'UPDATE sensor SET status=1 WHERE id = :id';
      $results = $this->dbConnection->prepare($sql);
      $results->execute(array(
          ':id' => $data['id'],
      ));
    }
    public function switchoff($data)
    {
      $sql = 'UPDATE sensor SET status=0 WHERE id = :id';
      $results = $this->dbConnection->prepare($sql);
      $results->execute(array(
          ':id' => $data['id'],
      ));
    }
    public function fetchSetpoints()
    {
      $sql = "SELECT id, name, location, status from sensor where name LIKE '%setpoint%'";
      $results = $this->dbConnection->prepare($sql);
      $results->execute();
      $sensorArray = array();
      while ($row = $results->fetch()) {
          $sensorArray[] = new Sensor($row);
      }
      return $sensorArray;
    }


}
