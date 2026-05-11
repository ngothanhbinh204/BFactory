(function ($) {
	$.fn.clickOutside = function (options) {
		var settings = $.extend(
			{
				exclude: [], // Default is to exclude no elements
				callback: function () {},
			},
			options
		);

		var $element = this;
		var excludeElements = $(settings.exclude);

		function handleClickOutside(event) {
			var clickedInsideExclude =
				excludeElements.filter(function () {
					return (
						$(this).is(event.target) ||
						$(this).has(event.target).length > 0
					);
				}).length > 0;

			if (
				!$element.is(event.target) &&
				$element.has(event.target).length === 0 &&
				!clickedInsideExclude
			) {
				if (typeof settings.callback === "function") {
					settings.callback.call($element, event);
				}
			}
		}

		$(document).on("click", handleClickOutside);

		return this.each(function () {
			var $this = $(this);
			$this.data("clickOutside", handleClickOutside);
		});
	};

	// Optional: cleanup method to remove event listener
	$.fn.removeClickOutside = function () {
		return this.each(function () {
			var $this = $(this);
			var handler = $this.data("clickOutside");
			if (handler) {
				$(document).off("click", handler);
				$this.removeData("clickOutside");
			}
		});
	};
})(jQuery);
