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

   $writeToLog = "\n";
    $writeToLog.=$writeToLogTime.",";
    $writeToLog.=$writeToLogIP.",";
    $writeToLog.=$writeToLogUserAgent.",";
    $writeToLog.=$writeToLogCountry.",";
    $writeToLog.=$writeToLogDestination.",";
    $writeToLog.=$writeToLogType.",";
    $writeToLog.=$writeToLogReferer.",";
    $writeToLog.=$writeToLogHostname.",";

    if ($_COOKIE['settings']['track'] === "true" || !isset($_COOKIE['settings']['track'])) {
        fwrite($log, $writeToLog);
        fclose($log);
    }

}
 ?>
