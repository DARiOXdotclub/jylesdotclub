<?php

    /*ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/

    Include __DIR__."/backend/backend.php";
    echo file_get_contents(__DIR__."/base.html");
    IF (!ISSET($_GET['base']) || !ISSET($_GET['min'])){
        // removed because the website's ssl is fucky [31.07.2020 - 03:07 UTC]
        //IF (!ISSET($_GET['nohit'])) {
        //  echo '<img src="https://www.free-website-hit-counter.com/c.php?d=9&amp;id=122063&amp;s=1" class="hit-counter">';
        //}

        IF ($_COOKIE['settings']['music'] == "true") {
            echo randomSongPicker();
        }
        IF ($_COOKIE['settings']['subtitle'] == "true") {
            //if(mobileCheck()) {
            //    jscon_log("Detected Mobile Device");
            //} else {
            echo subtitlePicker();
            //}
        }
    }
