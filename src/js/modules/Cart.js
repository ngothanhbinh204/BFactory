$(function () {
	$(".cart-toggle").on("click", function () {
		$(".mini-cart-popup").toggleClass("open");
		$(".mini-cart-backdrop").fadeToggle();
	});
	$(document).on("click", ".btn-close-cart", function (e) {
		e.stopPropagation();
		e.preventDefault();
		$(".mini-cart-popup").removeClass("open");
		$(".mini-cart-backdrop").fadeOut();
	});
});
