var settingsPopup = false;
$("#show_settings").on('click',()=>{
	if (settingsPopup) {
		settingsPopup = false;
		$("#show_settings").html(`<li class="fas fa-sliders-h"></li>`);
		$(".settings_dialogue").fadeOut("fast");
	} else {
		settingsPopup = true;
		$("#show_settings").html(`<i class="fas fa-times"></i>`)
		$(".settings_dialogue").fadeIn("fast");
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

	location.reload(true);
})