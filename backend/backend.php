<?php

Include __DIR__."/ip.php";
Include __DIR__."/functions.php";

 /* Log users */
    $writeDirectory = "/etc/darioxlog";
    $logFileName = "jylesclub.csv";
    $logWriteDestination = $writeDirectory."/".$logFileName;
    $log = fopen($logWriteDestination, "a");
    $writeToLogType;
    $writeToLogIP = $_SERVER['REMOTE_ADDR'];
    $writeToLogUserAgent = str_replace(",", " ", $_SERVER['HTTP_USER_AGENT']);
    $writeToLogHostname = $_SERVER['REMOTE_HOST'];
    $writeToLogCountry = ip_info($_SERVER['REMOTE_ADDR'], "country");
    $writeToLogTime = date('l j \of F Y h;i:s A');
    $writeToLogReferer = str_replace(","," ", $_SERVER['HTTP_REFERER']);

    function gtfo() {
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    $destJSON = json_decode(file_get_contents(__DIR__."/dest.json"));

    function destJSONRedirect($args) {
        header("Location: ".$destJSON->$args);
    }

        if (isset($_GET["discord"])){
            header("Location: ".$destJSON->discord[0]);
            $writeToLogType = "Redirect";
            $destination = "Discord";
        } elseif (isset($_GET["seedbot"])){
            header("Location: ".$destJSON->seedbot[0]);
            $writeToLogType = "Redirect";
            $destination = "SeedBot";
        } elseif (isset($_GET["donate"])){
            header("Location: ".$destJSON->donate[0]);
            $writeToLogType = "Redirect";
            $destination = "Paypal Donate";
        } elseif (isset($_GET["steam"])){
            header("Location: ".$destJSON->steam[0]);
            $writeToLogType = "Redirect";
            $destination = "Steam";
        } elseif (isset($_GET["github"])){
            header("Location: ".$destJSON->github[0]);
            $writeToLogType = "Redirect";
            $destination = "Github";
        } elseif (isset($_GET["youtube"])){
            header("Location: ".$destJSON->youtube[0]);
            $writeToLogType = "Redirect";
            $destination = "Youtube";
        } elseif (isset($_GET["twitter"])){
            header("Location: ".$destJSON->twitter[0]);
            $writeToLogType = "Redirect";
            $destination = "Twitter";
        } elseif (isset($_GET["twitch"])){
            header("Location: ".$destJSON->twitch[0]);
            $writeToLogType = "Redirect";
            $destination = "Twitch";
        } elseif (isset($_GET['privacy'])){
            header("Location: ".$destJSON->privacy[0]);
            $writeToLogType="Redirect";
            $destination = "DARiOX Privacy Page";
        } elseif (isset($_GET['projects'])){
            header("Location: ".$destJSON->projects[0]);
            $writeToLogType="Redirect";
            $destination="jyles.club Projects";
        } elseif (isset($_GET["osu"])){
            if ($_GET["osu"] == "skin"){
                header("Location: ".$destJSON->osu[1]);
                $destination = "osu! Skin";
                $writeToLogType = "File Download";
            } else {
                header("Location: ".$destJSON->osu[0]);
                $destination = "osu! Profile";
            $writeToLogType = "Redirect";
            }
        } elseif (isset($_GET["soundcloud"])){
            if ($_GET["soundcloud"] == "sets"){
                header("Location: ".$destJSON->soundcloud[1]);
                $destination = "Soundcloud Sets";
                $writeToLogType = "Redirect";
            } elseif ($_GET["soundcloud"] == "good-music") {
                header("Location: ".$destJSON->soundcloud[2]);
                $destination = "Soundcloud 'Good Music' Playlist";
                $writeToLogType = "Redirect";
            } else {
                header("Location: ".$destJSON->soundcloud[0]);
                $destination = "Soundcloud Page";
                $writeToLogType = "Redirect";
            }
        } else {
          $destination = "Home";
          if ($writeToLogReferer === "https://jyles.club" || $writeToLogReferer === "http://jyles.club") {
            $writeToLogType = "Refresh";
          } else {
            $writeToLogType = "Visit Home";
          }
        }



    $writeToLogDestination = $destination;

$writeToLog = $writeToLogTime.",".$writeToLogIP.",".$writeToLogUserAgent.",".$writeToLogCountry.",".$writeToLogDestination.",".$writeToLogType.",".$writeToLogReferer.",".$writeToLogHostname."\n";

    fwrite($log, $writeToLog);
    fclose($log);

    Include __DIR__."/random.php";

    //Adds countdown for a special event.
    //echo file_get_contents("countdown.html");
