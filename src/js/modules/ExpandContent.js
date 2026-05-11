(function ($) {
	$.fn.expandContent = function () {
		const updateHeight = ($elem) => {
			let $expandContent = $elem.find(".expand-content");
			let innerHeight = $elem.find(".expand-content-inner").outerHeight();

			$expandContent.css({
				"--original-content-height": innerHeight + "px",
			});

			// Check if wrapper height equals inner height
			if ($expandContent.outerHeight() >= innerHeight) {
				$elem.find(".expand-trigger").hide();
			} else {
				$elem.find(".expand-trigger").show();
			}
		};

		return this.each(function () {
			let $elem = $(this);
			let $trigger = $elem.find(".expand-trigger");

			updateHeight($elem);
			$(window).on("resize", function () {
				updateHeight($elem);
			});
			$trigger.on("click", function (e) {
				e.preventDefault();
				$trigger.toggleClass("active");
				$elem.find(".expand-content").toggleClass("expanded");

				let text = $trigger.hasClass("active")
					? $trigger.attr("data-less-text")
					: $trigger.attr("data-more-text");
				$trigger.find("span").text(text);
			});
		});
	};
})(jQuery);

$(document).ready(function () {
	$(".expand-content-item").expandContent();
});
