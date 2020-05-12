<?php
$export_dir = __DIR__."/backend/";

Include $export_dir."backend.php";
IF (!ISSET($_GET['base'])){
    echo file_get_contents(__DIR__."/base.html");

    IF (!ISSET($_GET['min'])) {
        IF (!ISSET($_GET['nohit'])) {
            echo '<img src="https://www.free-website-hit-counter.com/c.php?d=9&amp;id=122063&amp;s=1" class="hit-counter">';
        }

        IF (!ISSET($_GET['nomusic'])) {
            echo randomSongPicker();
        }
        IF (!ISSET($_GET['nosubtitle'])) {
            echo subtitlePicker();
        }
    }

}
