<?php


function logwrite($destination,$type){
/* Log users */
   $writeDirectory = "/etc/darioxlog";
   $logFileName = "jylesclub.csv";
   $logWriteDestination = $writeDirectory."/".$logFileName;
   $log = fopen($logWriteDestination, "a");
   $writeToLogType = $type;
   $writeToLogDestination = $destination;
   $writeToLogIP = $_SERVER['REMOTE_ADDR'];
   $writeToLogUserAgent = str_replace(",", " ", $_SERVER['HTTP_USER_AGENT']);
   $writeToLogHostname = $_SERVER['REMOTE_HOST'];
   $writeToLogCountry = ip_info($_SERVER['REMOTE_ADDR'], "country");
   $writeToLogTime = date('l j \of F Y h;i:s A');
   $writeToLogReferer = str_replace(","," ", $_SERVER['HTTP_REFERER']);

$writeToLog = $writeToLogTime.",".$writeToLogIP.",".$writeToLogUserAgent.",".$writeToLogCountry.",".$writeToLogDestination.",".$writeToLogType.",".$writeToLogReferer.",".$writeToLogHostname."\n";

   fwrite($log, $writeToLog);
   fclose($log);

}
 ?>
