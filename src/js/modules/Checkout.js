$(document).ready(function () {
	$(".quantity-input-button").click(function () {
		var $input = $(this).closest(".quantity").find("input");
		var currentValue = parseInt($input.val());
		if ($(this).hasClass("is-minus")) {
			if (currentValue > 1) {
				$input.val(currentValue - 1);
			}
		} else if ($(this).hasClass("is-plus")) {
			$input.val(currentValue + 1);
		}
		$input.trigger("change");
	});
});
