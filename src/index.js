const $ = require("jquery");


$(".settings_dialogue").hide();
$(".settings_background").hide();

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
}

if (localStorage["jyles_music"] == "true") {
	var noticeMSG = `
<div class="allow_noise_msg"><strong>Jukebox Notice;</strong><br>
If you are not using Google Chrome allow audio to be played from this website, thanks <3</div>
	`;
	var songDecision = getRandomItem(require("./songs.json"));
	console.log("Selected Song;",songDecision);
}


    // Things for the coolio hover text shit
$("a").hover(function() {
    $("#hovertext").stop(true).fadeTo("fast", 1);
    document.getElementById("hovertext").innerHTML = $(this).attr('title');
}, function() {
    $("#hovertext").stop(true).fadeTo("slow", 0);
});


var settingsPopup = false;
$("#show_settings").on('click',()=>{
	if (settingsPopup) {
		settingsPopup = false;
		$("#show_settings").html(`<li class="fas fa-sliders-h"></li>`);
		$(".settings_dialogue").fadeOut("fast");
		$(".settings_background").fadeOut("fast");
	} else {
		settingsPopup = true;
		$("#show_settings").html(`<i class="fas fa-times"></i>`)
		$(".settings_dialogue").fadeIn("fast");
		$(".settings_background").fadeIn("fast");
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
