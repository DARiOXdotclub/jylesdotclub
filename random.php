<?php
	function subtitlePicker() {
		$subtitleResponse = json_decode('[
					"donate $2 so i can get a can of heinz beanz",
					"can i get, uhhhhh, b0neless pizzzz",
					"speedcore > any other genre",
					"traps are not gay",
					"donate if you remember jylescoadward.com",
					"wow, so ok, someone found my reddit history.",
					"Deleting hl2.exe",
					"you should really follow my twitter",
					"epstein didn&#39;t kill himself?"
				]');
		$randomInt = mt_rand(0,6);
		return $subtitleResponse[$randomInt];
	}

	function iframeGen($url) {
		return `<iframe frameborder="0" style="position:absolute;top:5px;left:5px;" src="`.$url.`" allow="autoplay" height="0" width="0"></iframe>`;
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
			"https://cdn.jyles.club/pageaudio/goreshit-houmous.supreme.mp3"
		]');

		$randomInt = mt_rand(0,6);

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