<?php
/**
 * Created by PhpStorm.
 * User: Jyles Coad-Ward
 * Date: 24/05/2019
 * Time: 5:53 PM
 */

Include __DIR__."/ip.php";

 /* Log users */
    $writeDirectory = "/var/www/dxcdn/log";
    $logFileName = "jylesclub.csv";
    $logWriteDestination = $writeDirectory."/".$logFileName;
    $log = fopen($logWriteDestination, a);
    $writeToLogType;
    $writeToLogIP = $_SERVER['REMOTE_ADDR']."\n";
    $writeToLogUserAgent = $_SERVER['HTTP_USER_AGENT']."\n";
    $writeToLogHostname = $_SERVER['REMOTE_HOST']."\n";
    $writeToLogCountry = ip_info($_SERVER['REMOTE_ADDR'], "country")."\n";
    $writeToLogTime = date('l j \of F Y h;i:s A')."\n";
    $writeToLogReferer = $_SERVER['HTTP_REFERER'];
    
    function gtfo() {
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    $destJSON = json_decode(file_get_contents("./dest.json"));

    function destJSONRedirect($args) {
        header("Location: ".$destJSON->$args);
    } 

        if (isset($_GET["discord"])){
            header("Location: ".$destJSON->discord[0]);
            $writeToLogType = "Redirect"; 
            $destination = "Discord";
        } elseif (isset($_GET["seedbot"])){
            header("Location: ".$destJSON->seedbot[0]);
            $writeToLogType = "Redirect";
            $destination = "SeedBot";
        } elseif (isset($_GET["donate"])){
            header("Location: ".$destJSON->donate[0]);
            $writeToLogType = "Redirect";
            $destination = "Paypal Donate";
        } elseif (isset($_GET["steam"])){
            header("Location: ".$destJSON->steam[0]);
            $writeToLogType = "Redirect";
            $destination = "Steam";
        } elseif (isset($_GET["github"])){
            header("Location: ".$destJSON->github[0]);
            $writeToLogType = "Redirect";
            $destination = "Github";
        } elseif (isset($_GET["youtube"])){
            header("Location: ".$destJSON->youtube[0]);
            $writeToLogType = "Redirect";
            $destination = "Youtube";
        } elseif (isset($_GET["twitter"])){
            header("Location: ".$destJSON->twitter[0]);
            $writeToLogType = "Redirect";
            $destination = "Twitter";
        } elseif (isset($_GET["twitch"])){
            header("Location: ".$destJSON->twitch[0]);
            $writeToLogType = "Redirect";
            $destination = "Twitch";
        } elseif (isset($_GET['privacy'])){
            header("Location: ".$destJSON->privacy[0]);
            $writeToLogType="Redirect";
            $destination = "DARiOX Privacy Page";
        } elseif (isset($_GET["osu"])){
            if ($_GET["osu"] == "skin"){
                header("Location: ".$destJSON->osu[1]);
                $destination = "osu! Skin";
                $writeToLogType = "File Download";
            } else {
                header("Location: ".$destJSON->osu[0]);
                $destination = "osu! Profile";
            $writeToLogType = "Redirect";
            }
        } elseif (isset($_GET["soundcloud"])){
            if ($_GET["soundcloud"] == "sets"){
                header("Location: ".$destJSON->soundcloud[1]);
                $destination = "Soundcloud Sets";
                $writeToLogType = "Redirect";
            } elseif ($_GET["soundcloud"] == "good-music") {
                header("Location: ".$destJSON->soundcloud[2]);
                $destination = "Soundcloud 'Good Music' Playlist";
                $writeToLogType = "Redirect";
            } else {
                header("Location: ".$destJSON->soundcloud[0]);
                $destination = "Soundcloud Page";
                $writeToLogType = "Redirect";
            }
        } else {
          $destination = "Home";
          if ($writeToLogReferer === "https://jyles.club" || $writeToLogReferer === "http://jyles.club") {
            $writeToLogType = "Refresh";
          } else {
            $writeToLogType = "Visit Home";
          }
        }



    $writeToLogDestination = $destination;

$writeToLog = $writeToLogTime.",".$writeToLogIP.",".$writeToLogUserAgent.",".$writeToLogCountry.",".$writeToLogDestination.",".$writeToLogType.",".$writeToLogReferer.",".$writeToLogHostname."\n";
echo $writeToLog;


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
                  <a href="http://jyles.club/?discord" rel="external follow">Discord</a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="http://jyles.club/?twitch" rel="external follow">Twitch</a>
                </td>
                <td>
                  <a href="http://jyles.club/?osu=skin" rel="external follow" style="color: #ffc1ef;" download>osu! skin</a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="http://share.jyles.club">File Share</a>
                </td>
                <td>
                  <a href="mailto:jylescoadward@national.shitposting.agency">Contact Email</a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="http://jyles.club/?seedbot" rel="external follow">SeedBot</a>
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

      <div class="contact">By using this website you agree to the <a href="https://jyles.club?privacy">DARiOX Privacy Policy</a></div>

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
