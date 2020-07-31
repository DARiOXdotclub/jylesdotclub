<?php

    function checkValue($v) {
        if (empty($_COOKIE['settings'][$v])) {
            return false;
        } else {
            return true;
        }
    }

    $musicVal = "false";
    $subVal = "false";
    $trackVal = "false";

    if ($_POST['music'] === "on") {
        $musicVal = "true";
        echo "Music Setting changed to `false`<br>";
    }
    if ($_POST['subtitle'] === "on") {
        $subVal = "true";
        echo "Subtitle Setting changed to `false`<br>";
    }
    if ($_POST['track'] === "on") {
        $trackVal = "true";
        echo "Track Setting changed to `false`<br>";
    }

setcookie("settings[music]", $musicVal, time() + 604800, "/");
setcookie("settings[subtitle]", $subVal, time() + 604800, "/");
setcookie("settings[track]", $trackVal, time() + 604800, "/");

 ?>
<br>
<br>
<a onclick="javascript:history.back()">Go Back</a><br>
<strong><i>note:</i></strong><br>
settings expire in 1 week
