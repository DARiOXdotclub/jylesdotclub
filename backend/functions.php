<?php

    function jscon($cmd) {
        echo '<script>'.$cmd.'</script>';
    }
    function jscon_log($txt){
        echo '<script>console.log(`'.$txt.'`)</script>';
    }
