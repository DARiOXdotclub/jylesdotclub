<?php

Include __DIR__."/ip.php";

 /* Log users */
    $writeDirectory = "/etc/darioxlog";
    $logFileName = "jylesclub.csv";
    $logWriteDestination = $writeDirectory."/".$logFileName;
    $log = fopen($logWriteDestination, a);
    $writeToLogType;
    $writeToLogIP = $_SERVER['REMOTE_ADDR'];
    $writeToLogUserAgent = str_replace(",", " | ", $_SERVER['HTTP_USER_AGENT']);
    $writeToLogHostname = $_SERVER['REMOTE_HOST'];
    $writeToLogCountry = ip_info($_SERVER['REMOTE_ADDR'], "country");
    $writeToLogTime = date('l j \of F Y h;i:s A');
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
<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<title>jyles.club</title>
	</head>
	<body>
		<div class="border fade-in-fwd"></div>
		<div class="title .slide-in-top">
			jyles.club
		</div>
		<div class="subtitle slide-in-top">
			<?php echo subtitlePicker(); ?>
		</div>
		<table class="links fade-in-fwd">
			<tr>
				<td><a href="https://jyles.club?github">Github</a></a></td>
				<td><a href="https://jyles.club?discord">Discord</a></td>
			</tr>
			<tr>
				<td><a href="https://jyles.club?twitch">Twitch</a></td>
				<td><a href="https://jyles.club?osu=skin" style="color: #ffc1ef;" download>osu! skin</a></td>
			</tr>
			<tr>
				<td><a href="http://share.jyles.club">File Share</a></td>
				<td><a href="http://jyles.club?contactemail">Contact Email</a></td>
			</tr>
			<tr>
				<td><a href="https://jyles.club?seedbot">Discord Bot</a></td>
				<td><a href="https://jyles.club?youtube">Youtube</a></td>
			</tr>
		</table>
		<marquee class="musicticker fade-in-fwd" direction="left" scrollamount="3" behavior="scroll">
			<div>
				<strong>Currently Playing:</strong> <?php echo randomSongPicker(); ?>
			</div>
		</marquee>
		<div class="donate fade-in-fwd">
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
	</body>
</html>