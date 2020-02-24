<?php
Include __DIR__."/ip.php";

 /* Log users */
    $writeDirectory = "/etc/darioxlog";
    $logFileName = "jylesclub.csv";
    $logWriteDestination = $writeDirectory."/".$logFileName;
    $log = fopen($logWriteDestination, "a");
    $writeToLogType;
    $writeToLogIP = $_SERVER['REMOTE_ADDR'];
    $writeToLogUserAgent = str_replace(",", " ", $_SERVER['HTTP_USER_AGENT']);
    $writeToLogHostname = $_SERVER['REMOTE_HOST'];
    $writeToLogCountry = ip_info($_SERVER['REMOTE_ADDR'], "country");
    $writeToLogTime = date('l j \of F Y h;i:s A');
    $writeToLogReferer = str_replace(","," ", $_SERVER['HTTP_REFERER']);
    
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
        } elseif (isset($_GET['projects'])){
            header("Location: ".$destJSON->projects[0]);
            $writeToLogType="Redirect";
            $destination="jyles.club Projects";
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

    fwrite($log, $writeToLog);
    fclose($log);

    Include __DIR__."/random.php";

    //Adds countdown for a special event.
    //echo file_get_contents("countdown.html");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>jyles.club - coming soon</title>
        <link href="cs_style.css" rel="stylesheet" type="text/css" />
		<style>
@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');

*{
    font-family: 'Roboto', sans;
}

body{
    background-color:black;
}
img{
    padding-top:30px;
    margin:auto;
    min-height:50px;
    height:300px;
}
td{
    color: white;
}
table *{
    text-align:center;
}
table{
    width:500px;
}
td{
    min-width:110px;
    border-left: 1px solid white;
    border-right: 1px solid white;
}
a{
    color:white;
}
a:hover{
    color:white;
    font-weight:bold;
}
td:hover{
    font-weight:bold;
}
strong{
    color:white;
}
div{
    color:white;
}
		</style>
    </head>
    <body>
        <center>
            <img src="coming_soon.gif">
        </center>
        <div class="links">
            <center>
                <table>
                    <tr>
                        <td><a href="https://jyles.club?github">github</a></td>
                        <td><a href="https://jyles.club?discord">discord</a></td>
                        <td><a href="https://jyles.club?twitch">twitch</a></td>
                        <td><a href="https://share.jyles.club">open directory</a></td>
                        <td><a href="https://jyles.club/projects">projects</a></td>
                        <td><a href="mailto:jyles@dariox.club">contact email</a></td>
                    </tr>
                </table>
                <br>
                <strong>Currently Playing:</strong> <?php echo randomSongPicker(); ?>
                <div>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick" />
                        <input type="hidden" name="hosted_button_id" value="X8MN67VEWTLN8" />
                        <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                        <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1" />
                    </form>
                </div>
                <div class="privacy fade-in-fwd">
                    By using this website you agree to the <a href="https://jyles.club?privacy">DARiOX Privacy Policy</a>
                </div>
            </center>
        </div>
    </body>
</html>