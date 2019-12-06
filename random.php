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
			"https://cdn.jyles.club/pageaudio/renard-megawatt.mp3",
			"https://cdn.jyles.club/pageaudio/kitsune2-everybody_rush.mp3",
			"https://cdn.jyles.club/pageaudio/tqbf-400_cherries_per_minute.mp3",
			"https://cdn.jyles.club/pageaudio/tqbf-fresh_out.mp3",
			"https://cdn.jyles.club/pageaudio/tqbf-numbnuts.mp3",
			"https://cdn.jyles.club/pageaudio/onefour-spot_the_diffrence.mp3",
			"https://cdn.jyles.club/pageaudio/renard-blind_cave_salamander.mp3",
			"https://cdn.jyles.club/pageaudio/renard-entire_world.mp3",
			"https://cdn.jyles.club/pageaudio/goreshit-ron.mp3",
			"https://cdn.jyles.club/pageaudio/renard-couldve_been_nice.mp3",
			"https://cdn.jyles.club/pageaudio/RQ-cum_monolith.mp3",
			"https://cdn.jyles.club/pageaudio/tqbf-bub_vs_bob.mp3",
			"https://cdn.jyles.club/pageaudio/darwin-take_you_back.mp3",
			"https://cdn.jyles.club/pageaudio/kitsune2-tung_icelandic_lesbian.mp3"
		]');

		$ceiling = count($songURLs) - 1;

		$randomInt = mt_rand(0,$ceiling);

		$marquee = $songNames[$randomInt];
		$iframe = '<iframe frameborder="0" style="position:absolute;top:5px;left:5px;" src="'.$songURLs[$randomInt].'" allow="autoplay" height="0" width="0" id="iframe"></iframe>';
		$final = $marquee.$iframe;
		return $final;
	}