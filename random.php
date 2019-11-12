<?php
	function subtitlePicker() {
		$subtitleResponse = json_decode('[
					"donate $2 so i can get a can of heinz beanz",
					"can i get, uhhhhh, b0neless pizzzz",
					"speedcore > any other genre",
					"traps are not gay",
					"donate if you remember jylescoadward.com",
					"wow, so ok, someone found my reddit history.",
					"Deleting hl2.exe"
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
		$songNames = json_decode('[
			`<a href="https://soundcloud.com/lofi-fpv/quok-atariwave-instrumental?in=jylescoad-ward/sets/good-music">Atariwave [Instrumental] by Quok</a>`,
			`<a href="https://www.youtube.com/watch?v=74cfflczqRw">Sinisterrrrrrrr</a> by <a href="https://lapfoxtrax.com/">Renard</a>`
		]');
		$songURLs = json_decode('[
			"https://cdn.jyles.club/pageaudio/quok-atariwave-instrumental.mp3",
			"https://cdn.jyles.club/pageaudio/renard-sinisterrrrrrrr.mp3"
		]');

		$randomInt = mt_rand(0,1);
		$songResponse = json_decode($rawJSON,true);

		$songName = $songNames[$randomInt];
		$songURL = $songURLs[$randomInt];

		$final = marqueeGen($songName)."<br>".iframeGen($songURL);
		return $final;
	}