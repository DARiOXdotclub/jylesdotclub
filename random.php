<?php
	function subtitlePicker() {
		$subtitleResponse = json_decode([
			"donate $2 so i can get a can of heinz beanz",
			"can i get, uhhhhh, b0neless pizzzz",
			"speedcore > any other genre",
			"traps are not gay",
			"donate if you remember jylescoadward.com",
			"wow, so ok, someone found my reddit history."
		]);
		$randomInt = mt_rand(0,5);
		return $subtitleResponse[$randomInt];
	}

	function iframeGen($url) {
		$final = `<iframe frameborder="0" style="position:absolute;top:5px;left:5px;" src="`.$url.`" allow="autoplay" height="0" width="0"></iframe>`;
		return $final;
	}
	function marqueeGen($content) {
		$final = `
		<center class="song" >
		    <marquee class="music fade-in-fwd" width="250px" direction="left" scrollamount="3" behavior="scroll">
		    	Currently Playing:  `.$content.`
		    </marquee>
		</center>`;
		return $final;
	}


	function randomSongPicker() {
		$rawJSON = '[
	{
		"name": `<a href="https://soundcloud.com/lofi-fpv/quok-atariwave-instrumental?in=jylescoad-ward/sets/good-music">Atariwave [Instrumental] by Quok</a>`,
		"url": `https://cdn.jyles.club/pageaudio/quok-atariwave-instrumental.mp3`
	},
	{
		"name": `<a href="https://www.youtube.com/watch?v=74cfflczqRw">Sinisterrrrrrrr</a> by <a href="https://lapfoxtrax.com/">Renard</a>`,
		"url": `https://cdn.jyles.club/pageaudio/renard-sinisterrrrrrrr.mp3`
	}
]';
		$songResponse = json_decode($rawJSON);
		$randomInt = mt_rand(0,1);
		echo $songResponse->$randomInt;
		$songName = $songResponse->data[$randomInt]->name;
		$songURL = $songResponse->data[$randomInt]->url;
		$final = marqueeGen($songName)."<br>".iframeGen($songURL);
		return $final;
	}