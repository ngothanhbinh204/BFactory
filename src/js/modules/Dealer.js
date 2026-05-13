$(function () {
	const mapIframe = $(".result-map iframe");
	$("body").on("click", ".dealer-item", function () {
		// trim whitespace
		var src = $(this).data("iframe");
		mapIframe.attr("src", src);
		$(this).addClass("active");
		$(".dealer-item").not(this).removeClass("active");
	});
	$(".dealer-item").eq(0).trigger("click");
});
