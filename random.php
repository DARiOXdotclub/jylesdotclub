<?php
	function subtitlePicker() {
		$subtitleResponse = json_decode(file_get_contents("subtitle.json"));
		return $subtitleResponse[mt_rand(0,count($subtitleResponse) - 1)];
	}
	function marqueeGen($content) {
		return `
		<center class="song" >
		    <marquee class="music fade-in-fwd" width="250px" direction="left" scrollamount="3" behavior="scroll">
		    	Currently Playing:  `.$content.`
		    </marquee>
		</center>`;
	}

	function randomSongPicker() {
		$songNames = file("namelinks.txt");
		$songURLs = json_decode('[
			"https://cdn.jyles.club/pageaudio/quok-atariwave.mp3",
			"https://cdn.jyles.club/pageaudio/renard-sinisterrrrrrrr.mp3",
			"https://cdn.jyles.club/pageaudio/deadmau5-allihad.mp3",
			"https://cdn.jyles.club/pageaudio/baq5-outoftouch.mp3",
			"https://cdn.jyles.club/pageaudio/busdriver-imaginaryplaces.mp3",
			"https://cdn.jyles.club/pageaudio/imonster-daydreaminblue.mp3",
			"https://cdn.jyles.club/pageaudio/rude-eternalyouth.mp3",
			"https://cdn.jyles.club/pageaudio/goreshit-houmous.supreme.mp3",
			"https://cdn.jyles.club/pageaudio/HALLEYHARDSOUNDUNIT-roman_candle.mp3",
			"https://cdn.jyles.club/pageaudio/RQ-XX.mp3",
			"https://cdn.jyles.club/pageaudio/tqbf-wanderlust.mp3",
			"https://cdn.jyles.club/pageaudio/RQ-20n.mp3",
			"https://cdn.jyles.club/pageaudio/renard-burning_rome.mp3",
			"https://cdn.jyles.club/pageaudio/renard-halfway.mp3",
			"https://cdn.jyles.club/pageaudio/renard-megawat.mp3",
			"https://cdn.jyles.club/pageaudio/kitsune2-everybody_rush.mp3",
			"https://cdn.jyles.club/pageaudio/tqbf-400_cherries_per_minute.mp3",
			"https://cdn.jyles.club/pageaudio/tqbf-fresh_out.mp3",
			"https://cdn.jyles.club/pageaudio/tqbf-numbnuts.mp3"
		]');

		$ceiling = count($songURLs) - 1;

		$randomInt = mt_rand(0,$ceiling);

		$marquee = '<center class="song">
		    <marquee class="music fade-in-fwd" width="250px" direction="left" scrollamount="3" behavior="scroll">
		    	Currently Playing: '.$songNames[$randomInt].'
		    </marquee>
		</center>';
		$iframe = '<iframe frameborder="0" style="position:absolute;top:5px;left:5px;" src="'.$songURLs[$randomInt].'" allow="autoplay" height="0" width="0" id="iframe"></iframe>';
		echo '<script>document.getElementById("iframe").volume = 0.2;</script>';
		$final = $marquee.$iframe;
		return $final;
	}