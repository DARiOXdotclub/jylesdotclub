<?php
/**
 * Created by PhpStorm.
 * User: Jyles Coad-Ward
 * Date: 24/05/2019
 * Time: 5:53 PM
 */
function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
/* Get data from URL bar */
    $page=$_GET['page'];
    $type=$_GET['type'];

 /* Log users */
    $writeDirectory = "/var/www/dxcdn/log";
    $logFileName = "jylesclub.txt";
    $logWriteDestination = $writeDirectory."/".$logFileName;
    $log = fopen($logWriteDestination, a);
    $writeToLogDestination = "Destination: ".$page."\n";
    $writeToLogType;
    $writeToLogIP = "IP Address: ".$_SERVER['REMOTE_ADDR']."\n";
    $writeToLogUserAgent = "User Agent: ".$_SERVER['HTTP_USER_AGENT']."\n";
    $writeToLogReferer = "HTTP Referer: ".$_SERVER['HTTP_REFERER']."\n";
    $writeToLogRemotePort = "Remote Port: ".$_SERVER['REMOTE_PORT']."\n";
    $writeToLogHostname = "Hostname: ".$_SERVER['REMOTE_HOST']."\n";
    $writeToLogCountry = "Country: ".ip_info($_SERVER['REMOTE_ADDR'], "country")."\n";
    $writeToLogTime = "Time Accessed: ".date('l j \of F Y h;i:s A')."\n";
    


    if ($page == "home"){
        header("Location: http://jyles.club");
    }
    elseif ($page == "discord"){
        header("Location: https://discord.gg/x92bvet");
    }
    elseif ($page == "seedbot"){
        header("Location: http://jyles.club/seedbot");
    }
    elseif ($page == "seedbotinvite"){
        header("Location: http://jyles.club/seedbot/invite");
    }
    elseif ($page == "donate"){
        header("Location: https://paypal.me/darioxservices");
    }
    elseif ($page == "steam"){
        header("Location: https://steamcommunity.com/id/seed_main");
    }
    elseif ($page == "github"){
        header("Location: https://github.com/jylescoad-ward");
    }
    elseif ($page == "youtube"){
        header("Location: https://youtube.com/seedvevo");
    }
    elseif ($page == "twitter") {
        echo `<h1>My twitter is locked, please tweet to twitter to unlock my account (@jylescoadward)</h1>`;
    }
    elseif ($page == "twitch") {
        header("Location: http://twitch.tv/seedplaysgames");
    }
    elseif ($page == "osu") {
        if ($type == "profile") {
            header("Location: https://osu.ppy.sh/u/seedplaysgames");
			$writeToLogType = "Type: ".$type."\n";
        }
        elseif ($type == "skin") {
            header("Location: https://storage.googleapis.com/dariox/share/osu-skin/latest.osk");
			$writeToLogType = "Type: ".$type."\n";
        }
        else{
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
    elseif ($page == "dariox") {
        header("Location: http://dariox.club");
    }
    elseif ($page == "donate") {
        header("Location: https://paypal.me/darioxservices");
    }
    elseif ($page == "soundcloud") {
	header("Location: https://soundcloud.com/jyles-coad-ward/");
    }
    else {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
	
	$writeToLog = $writeToLogDestination.$writeToLogType.$writeToLogIP.$writeToLogUserAgent.$writeToLogReferer.$writeToLogRemotePort.$writeToLogHostname.$writeToLogTime.$writeToLogCountry."\n\n";

    if (strpos($writeToLogUserAgent, 'CloudFlare-AlwaysOnline') !== false) {
        fwrite($log, $writeToLog);
        fclose($log);
    }
    else {
        echo "Hello CloudFlare!";
    }

?>
