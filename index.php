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

 /* Log users */
    $writeDirectory = "/var/www/dxcdn/log";
    $logFileName = "jylesclub.txt";
    $logWriteDestination = $writeDirectory."/".$logFileName;
    $log = fopen($logWriteDestination, a);
    $writeToLogType;
    $writeToLogIP = "IP Address: ".$_SERVER['REMOTE_ADDR']."\n";
    $writeToLogUserAgent = "User Agent: ".$_SERVER['HTTP_USER_AGENT']."\n";
    $writeToLogHostname = "Hostname: ".$_SERVER['REMOTE_HOST']."\n";
    $writeToLogCountry = "Country: ".ip_info($_SERVER['REMOTE_ADDR'], "country")."\n";
    $writeToLogTime = "Time Accessed: ".date('l j \of F Y h;i:s A')."\n";
    
    function gtfo() {
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    $destJSON = json_decode(file_get_contents("./dest.json"));

    function destJSONRedirect($args) {
        header("Location: ".$destJSON->$args);
    } 

        if (isset($_GET["discord"])){
            header("Location: ".$destJSON->discord[0]);
            $writeToLogType = "N/A"; 
            $destination = "Discord";
        } elseif (isset($_GET["seedbot"])){
            header("Location: ".$destJSON->seedbot[0]);
            $writeToLogType = "N/A";
            $destination = "SeedBot";
        } elseif (isset($_GET["donate"])){
            header("Location: ".$destJSON->donate[0]);
            $writeToLogType = "N/A";
            $destination = "Paypal Donate";
        } elseif (isset($_GET["steam"])){
            header("Location: ".$destJSON->steam[0]);
            $writeToLogType = "N/A";
            $destination = "Steam";
        } elseif (isset($_GET["github"])){
            header("Location: ".$destJSON->github[0]);
            $writeToLogType = "N/A";
            $destination = "Github";
        } elseif (isset($_GET["youtube"])){
            header("Location: ".$destJSON->youtube[0]);
            $writeToLogType = "N/A";
            $destination = "Youtube";
        } elseif (isset($_GET["twitter"])){
            header("Location: ".$destJSON->twitter[0]);
            $writeToLogType = "N/A";
            $destination = "Twitter";
        } elseif (isset($_GET["twitch"])){
            header("Location: ".$destJSON->twitch[0]);
            $writeToLogType = "N/A";
            $destination = "Twitch";
        } elseif (isset($_GET["osu"])){
            if ($_GET["osu"] == "skin"){
                header("Location: ".$destJSON->osu[1]);
                $destination = "osu! Skin";
            } else {
                header("Location: ".$destJSON->osu[0]);
                $destination = "osu! Profile";
            }
        } elseif (isset($_GET["soundcloud"])){
            if ($_GET["soundcloud"] == "sets"){
                header("Location: ".$destJSON->soundcloud[1]);
                $destination = "Soundcloud Sets";
            } elseif ($_GET["soundcloud"] == "good-music") {
                header("Location: ".$destJSON->soundcloud[2]);
                $destination = "Soundcloud 'Good Music' Playlist";
            } else {
                header("Location: ".$destJSON->soundcloud[0]);
                $destination = "Soundcloud Page";
            }
        } else {}



    $writeToLogDestination = "Destination: ".$destination."\n";
    $writeToLog = $writeToLogDestination.$writeToLogIP.$writeToLogUserAgent.$writeToLogReferer.$writeToLogRemotePort.$writeToLogHostname.$writeToLogTime.$writeToLogCountry."\n\n";

    if (strpos($writeToLogUserAgent, 'CloudFlare-AlwaysOnline') !== true) {
        fwrite($log, $writeToLog);
        fclose($log);
    }
    else {
        echo "Hello CloudFlare!";
    }


    Include __DIR__."/random.php";
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Jyles Coad-Ward [dariox.club@gmail.com]">
    <meta name="description" content="A personal website made by Jyles Coad-Ward, an Australian software developer.">

    <title>
      jyles.club
    </title>

    <link href="style.css" rel="stylesheet" type="text/css">

    <style>
body{
  background: #161616;
  color:white;
  height: 100%;
  .gradientBackground{
    background: center center no-repeat, linear-gradient(to bottom, #636363, #333333);
    height: 100%;
  }
}
.border{
  position: absolute;
  width: calc(100% - 20px); 
  height: calc(100% - 20px);
  top:5px;
  left:5px;
  right:5px;
  margin-left:auto;
  margin-right:auto;
  border: rgba(255,255,255,0.8) 5px solid;
}
.contentt{
  position:absolute;
  top:0;
  left:0;
  right:0;
  margin-left:auto;
  margin-right:auto;
  text-align:center;
}
.donate{
    position: absolute;
    bottom: 20px;
    left: 25px;
}
    </style>

  </head>

  <body class="backgroundanim" id="body">
    <div class="border"></div>
    <center>
      <!-- Page Content -->
      <div class="container contentt">
        <div class="row">
          <div class="col-lg-12 text-center"><br><br><br><br>
            <h1 class="mt-5 titlecustom slide-in-top" id="title">
              jyles.club
            </h1>
            <p class="lead fade-in-fwd subtitle">
              <?php echo subtitlePicker(); ?>
            </p><br><br>
            <table class="table-links fade-in-fwd">
              <tr>
                <td>
                  <a href="http://jyles.club/?github" rel="external follow">Github</a>
                </td>
                <td>
                  <a href="http://jyles.club/?steam" rel="external nofollow">Steam</a>
                </td>
                <td>
                  <a href="http://jyles.club/?discord" rel="external follow">Discord</a>
                </td>
                <td>
                  <a href="http://jyles.club/?seedbot" rel="external follow">SeedBot</a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="http://jyles.club/?twitch" rel="external follow">Twitch</a>
                </td>
                <td>
                  <a href="http://jyles.club/?osu=skin" rel="external follow" style="color: #ffc1ef;" download>osu! skin</a>
                </td>
                <td> 
                  <a href="http://jyles.club/?osu" rel="external follow" style="color: #ffc1ef;">osu! profile</a>
                </td>
                <td>
                  <a href="http://jyles.club/?youtube" rel="external follow">Youtube</a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </center>

    <?php echo randomSongPicker(); ?>

  </body>


<div class="donate">
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick" />
    <input type="hidden" name="hosted_button_id" value="X8MN67VEWTLN8" />
    <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1" />
  </form>
</div>
</html>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-77162061-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('Something is wrong', 'UA-77162061-4');
</script>