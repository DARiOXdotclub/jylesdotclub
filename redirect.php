<?php
/**
 * Created by PhpStorm.
 * User: Jyles Coad-Ward
 * Date: 24/05/2019
 * Time: 5:53 PM
 */

    $page=$_GET['page'];
    $type=$_GET['type'];
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
        header("Location: https://steamcommunity.com/id/seed-main");
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
        }
        elseif ($type == "skin") {
            header("Location: https://storage.googleapis.com/dariox/share/osu-skin/latest.osk");
        }
        else{
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
    elseif ($page == "dariox") {
        header("Location: http://dariox.club");
    }
    else {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

?>