<?php


	function subtitlePicker() {
		$subtitleResponse = json_decode(file_get_contents(__DIR__."/subtitle.json"));
		$subtitleFloor = 0;
		$subtitleRoof = count($subtitleResponse) - 1;
		$subtitleChoice = mt_rand($subtitleFloor,$subtitleRoof);

		jscon_log("--Subtitle Floor\n".$subtitleFloor);
		jscon_log("--Subtitle Roof\n".$subtitleRoof);
		jscon_log("--Subtitle ID\n".$subtitleChoice);
		jscon_log("--Subtitle\n".$subtitleResponse[$subtitleChoice]);

		return '<div class="rand_subtitle">'.$subtitleResponse[$subtitleChoice].'</div>';
	}
	function marqueeGen($content) {
		return '<marquee class="music" width="250px" direction="left" scrollamount="3" behavior="scroll">Currently Playing:  '.$content.'</marquee>';
	}

	function randomSongPicker() {
		//Varaible Setup
		$allowaudiomsg = '<div class="allow_noise_msg"><strong>Jukebox Notice;</strong><br>If you are not using Google Chrome allow audio to be played from this website, thanks <3</div>';
		$songNames = file("https://dxcdn.net/random_song_picker/namelinks.txt");
		$songURLs = json_decode(file_get_contents("https://dxcdn.net/random_song_picker/file.json"), true);
			$songFloor = 0;
			$songRoof = count($songURLs) - 1;
		$randomInt = mt_rand($songFloor,$songRoof);
		$songChoice = "https://storage.googleapis.com/cdn.jyles.club/pageaudio/".$songURLs[$randomInt];
		$audiotag = '<audio autoplay loop preload="auto" controls><source audoplay src="'.$songChoice.'" type="audio/mpeg">Your browser does not support the audio element.</audio>';
		$iframe = '<iframe frameborder="0" style="position:absolute;top:5px;left:5px;" src="'.$songChoice.'" allow="autoplay" height="0" width="0" id="iframe"></iframe>';

		jscon_log("--Song ID\n".$randomInt);
		jscon_log("--Song URL\n".$songChoice);
		jscon_log("--Song ID Floor\n".$songFloor);
		jscon_log("--Song ID Roof\n".$songRoof);
		jscon_log("--Marquee Link\n".$songNames[$randomInt]);
		jscon_log('--Browser Name\n'.browser());
		jscon_log('--Your IP Address\n'.$_SERVER['REMOTE_ADDR']);


		//Determines if the user's browser is running chrome,
		//if not then it loads the audio tag because iframe autoplay does not work with firefox.
		if (browser() !== "chrome"){
			$final = marqueeGen($songNames[$randomInt]).$audiotag.$allowaudiomsg;
		} else {
			$final = marqueeGen($songNames[$randomInt]).$iframe;
		}
		return $final;
	}
