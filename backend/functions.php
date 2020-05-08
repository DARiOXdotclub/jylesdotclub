<?php

    function jscon($cmd) {
        echo '<script>'.$cmd.'</script>';
    }
    function jscon_log($txt){
        echo '<script>console.log(`'.$txt.'`)</script>';
    }
	function browser() {
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
		   return 'ie';
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
		    return 'ie';
 		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE) // Chrome-Based
 		   return 'chrome';
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
		   return 'firefox';
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
		   return "opera_mini";
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
		   return "opera";
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'OPR') !== FALSE) // New Opera Tag thingie.
		   return "opera";
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
		   return "safari";
		 else
		   return 'unknown';
	}
    function destJSONRedirect($args) {
        header("Location: ".$destJSON->$args);
    }
