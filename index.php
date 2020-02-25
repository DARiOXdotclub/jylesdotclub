<?php
	Include __DIR__.'/backend/backend.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>jyles.club - coming soon</title>
		<style>
@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');

*{
    font-family: 'Roboto', sans;
}

body{
    background-color:black;
}
img.cms{
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
            <img src="jylesclub.gif" class="cms">
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
				<div align='center' height="21px"><a href='https://www.free-website-hit-counter.com'><img src='https://www.free-website-hit-counter.com/c.php?d=9&id=122063&s=1' title='free website hit counter'></a><br / ></div>
            </center>
        </div>
    </body>
</html>