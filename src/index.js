const $ = require("jquery");

localStorage.jyles_music_volume = localStorage.jyles_music_volume || '0.6';

function getRandomItem(arr) {
	// get random index value
    const randomIndex = Math.floor(Math.random() * arr.length);

    // get random item
    const item = arr[randomIndex];

    return item;
}

if (localStorage["jyles_subtitle"] == "true") {
	var subtitleJSON = require("./subtitle.json");
	var selection = getRandomItem(subtitleJSON);

	$(".rand_subtitle").html(selection);
}

$("input#volume-control").val(parseFloat(localStorage.jyles_music_volume)*100);

if (localStorage["jyles_music"] == "true") {
	var songDecision = getRandomItem(require("./songs.json"));
	console.log("Selected Song;",songDecision);
	
	var SoundElement = new Audio("https://cdn.jyles.club/pageaudio/"+songDecision.file);
	
	SoundElement.volume = parseFloat(localStorage.jyles_music_volume);

	var AudioStatus = false;
	$("div.AudioManagement span[action=CurrentSong").html(`<a href="${songDecision.link}">${songDecision.name}</a>`);
	
	console.log("Chose Audio '"+songDecision.name+"'",songDecision);

	$("button[action=PlayPauseAudio").on('click',()=>{
		if (AudioStatus)
		{
			SoundElement.pause();
			console.log("Paused Audio");
			AudioStatus = !AudioStatus;
		} else {
			SoundElement.play();
			console.log("Resumed Audio");
			AudioStatus = !AudioStatus;
		}
	});
	
	$("input#volume-control").on('change',(e)=>{
		SoundElement.volume = e.currentTarget.value / 100;
		localStorage.jyles_music_volume = SoundElement.volume;
	})
}


// Things for the coolio hover text shit
$("a").hover(function() {
    $("#hovertext").stop(true).fadeTo("fast", 1);
    document.getElementById("hovertext").innerHTML = $(this).attr('title') || '<!-- -->';
}, function() {
    $("#hovertext").stop(true).fadeTo("slow", 0);
});


var settingsPopup = false;
$("#show_settings").on('click',()=>{
	if (settingsPopup) {
		settingsPopup = false;
		$("#show_settings").html(`<li class="fas fa-sliders-h"></li>`);
		$(".settings").fadeOut("fast");
	} else {
		settingsPopup = true;
		$("#show_settings").html(`<i class="fas fa-times"></i>`)
		$(".settings").fadeIn("fast");
	}
})

$("button[action=saveSettings]").on('click',()=>{
	console.log($("div.settings_dialogue"))
	$("div.settings_dialogue")[0].childNodes.forEach((node)=>{
		if (node.localName != "li") return;
		if (node.firstChild.localName != "input") return;
		if (node.firstChild.attributes.type.value != "checkbox") return;

		localStorage[`jyles_${node.firstChild.attributes.name.value}`] = node.firstChild.checked;
		console.log(`[jyles_${node.firstChild.attributes.name.value}] -> ${node.firstChild.checked}`);
	})

	alert("Saved Settings");
	location.reload(true);
})
