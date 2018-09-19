<?php

class Sensor{

  private $id;
  private $name;
  private $location;
  private $status;

  public function __construct($dbRow){
    $this->id = $dbRow['id'];
    $this->name = $dbRow['name'];
    $this->location = $dbRow['location'];
    $this->status = $dbRow['status'];
  }
  public function getId(){
    return $this->id;
  }
  public function getName(){
    return $this->name;
  }
  public function getLocation(){
    return $this->location;
  }
  public function getStatus(){
    return $this->status;
  }
  public function __toString()
   {
     return $this->name . ' ';
   }
}
