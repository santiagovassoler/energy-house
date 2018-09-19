<?php
require("phpMQTT.php");

$mqtt = new phpMQTT("//146.87.2.99", 1883, "phpMQTT Sub Example"); 
if(!$mqtt->connect()){
  exit(1);
}
$topics['/temp'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics,0);
while($mqtt->proc()){
  echo "string";
}
$mqtt->close();
function procmsg($topic,$msg){
  echo "Msg Recieved: ".date("r")."\nTopic:{$topic}\n$msg\n";
}

?>
