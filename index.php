<?php

$base = file_get_contents(__DIR__."/base.html");

echo $base;

$export_dir = __DIR__."/backend/";

Include $export_dir."backend.php";

echo randomSongPicker();
