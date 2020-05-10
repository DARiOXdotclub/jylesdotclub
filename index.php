<?php

$base = file_get_contents(__DIR__."/base.html");

echo $base;

$export_dir = __DIR__."/backend/";

Include $export_dir."backend.php";

if (!ISSET($_GET['nohit'])) {
    echo '<img src="https://www.free-website-hit-counter.com/c.php?d=9&amp;id=122063&amp;s=1" class="hit-counter">';
}

echo randomSongPicker();
