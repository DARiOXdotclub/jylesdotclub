
localStorage.jyles_music_volume = localStorage.jyles_music_volume || '0.6';

$('input[type=range]').on('input', function () {
	$(this).trigger('change');
});

$("input#volume-control").val(parseFloat(localStorage.jyles_music_volume)*100);

var SoundElement = null;

function SelectAudio(Autoplay) {
	if (Autoplay == undefined || typeof Autoplay != "boolean") {
		Autoplay = false;
	}
	if (SoundElement != null) {
		SoundElement.pause();
		SoundElement = null;
	}

	var songDecision = window.getRandomItem(require("./songs.json"));
	console.log("Selected Song;",songDecision);	
	
	SoundElement = new Audio("https://cdn.jyles.club/pageaudio/"+songDecision.file);
	
	console.log("Loading Audio...");

	// Do the actual processing when the audio can play.
	SoundElement.addEventListener('canplay', (event) => {
		if (event.target.src != "https://cdn.jyles.club/pageaudio/"+songDecision.file) return;
		SoundElement.volume = parseFloat(localStorage.jyles_music_volume);
		var AudioStatus = false;
		$("div.AudioManagement span[action=CurrentSong").html(`<a href="${songDecision.link}">${songDecision.name}</a>`);
		
		console.log("Loaded Audio; '"+songDecision.name+"'",songDecision);

		function SetAudioState(TargetState) {
			// If target state is undefined assume that the user wants to toggle the Audio.
			if (TargetState == undefined || typeof TargetState != "boolean") {
				TargetState = !AudioStatus;
			}
			if (TargetState)
			{
				$("[action=PlayPauseAudio]").html(`<i class="fas fa-pause"></i>`);
				SoundElement.play();
				console.log("Resumed Audio");
				AudioStatus = TargetState;
			} else {
				$("[action=PlayPauseAudio]").html(`<i class="fas fa-play"></i>`);
				SoundElement.pause();
				console.log("Paused Audio");
				AudioStatus = TargetState;
			}
		}

		// Invert Autoplay so if it's false we set the audio to Playing.
		SetAudioState(Autoplay);

		$("button[action=PlayPauseAudio").on('click',()=>{
			SetAudioState();
		});

		$("input#volume-control").on('change',(e)=>{
			SoundElement.volume = e.currentTarget.value / 100;
			localStorage.jyles_music_volume = SoundElement.volume;
		})
	});
}

$("button[action=NewAudio]").on('click',() => {
	SelectAudio(true);
});

if (localStorage["jyles_music"] == "true") {
	SelectAudio();
}