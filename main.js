$(document).ready(function () {
	$(".controlTable .card").click(function () {
		$(".card").removeClass("selected");
		$(this).addClass("selected");
	});

	$("#menu .action").click(function () {
		var card = $(".card.selected");

		document.location = "?action=" + $(this).attr("data-action") + "&row=" + card.attr("data-row") + "&col=" + card.attr("data-col");
	});
});