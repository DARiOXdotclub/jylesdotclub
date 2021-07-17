const $ = require("jquery");

const defaultLocalStorage = {
	jyles_music: false,
	jyles_subtitle: false,
	jyles_music_volume: 0.6
}

	// Merge `defaultLocalStorage` into `localStorage`
	// if value does not exist in `localStorage` already.
Object.entries(defaultLocalStorage).forEach((d) => {
	localStorage[d[0]] = localStorage[d[0]] || d[1];

	// Hide localStorae object if it is false.
	var targetObject = localStorage[d[0]];
	console.log(d[0] + " -> " + targetObject);
	if (targetObject == "false") {
		// Hide all objects `requires` attribute in localStorage set to false
		$(`[requires=${d[0]}]`).toArray().forEach((d) => {
			$(d).hide();
		});
	}
})

window.getRandomItem = (arr) => { return arr[Math.floor(Math.random() * arr.length)] };


	// Settings
require("./settings.js");

	// Music
require("./music.js");

	// Subtitle
if (localStorage["jyles_subtitle"] == "true") {
	var subtitleJSON = require("./subtitle.json");
	var selection = window.getRandomItem(subtitleJSON);

	$(".rand_subtitle").html(selection);
}


	// Text Hover
$("a,button").hover(function() {
    $("#hovertext").stop(true).fadeTo("fast", 1);
    document.getElementById("hovertext").innerHTML = $(this).attr('title') || '<!-- -->';
}, function() {
    $("#hovertext").stop(true).fadeTo("slow", 0);
});