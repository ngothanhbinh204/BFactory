var $globalHeader = $(".global-header");

$(function () {
	let headerHeight = $globalHeader.outerHeight();
	$("body").css({
		"--header-height": headerHeight + "px",
	});
	window.headerHeight = headerHeight;

	let headerPositionCss = $globalHeader.css("position");

	if (headerPositionCss === "relative") {
		$globalHeader.sticky({
			top: 0,
			zIndex: 100,
		});
	}

	$(window).on("scroll", function () {
		var scrollTop = window.pageYOffset || $(document).scrollTop();
		$globalHeader.toggleClass("scrolling", scrollTop > 0);
	});

	$globalHeader.on("sticky-end", function () {
		$("#sticky-wrapper").css({
			height: headerHeight,
		});
	});

	const accountWrapper = new MappingListener({
		selector: ".account-wrapper",
		mobileWrapper: ".menu-mobile-body",
		mobileMethod: "appendTo",
		desktopWrapper: ".language-wrapper",
		desktopMethod: "insertAfter",
	}).watch();

	const menuMapping = new MappingListener({
		selector: ".menu-wrapper",
		mobileWrapper: ".menu-mobile-body",
		mobileMethod: "appendTo",
		desktopWrapper: ".logo-wrapper",
		desktopMethod: "insertAfter",
		breakpoint: 1025,
	}).watch();

	$(".close-menu-mobile, .menu-mobile-backdrop").on("click", function () {
		$(".menu-mobile").removeClass("show");
		$("body").removeClass("overflow-hidden");
		$(".menu-mobile-backdrop").fadeOut();
	});

	$(".toggle-sub-menu").each(function (index, el) {
		$(el).on("click", function () {
			$(el).next().slideToggle();
		});
	});

	$(".menu-toggle").on("click", function () {
		$(".menu-mobile").addClass("show");
		$("body").addClass("overflow-hidden");
		$(".menu-mobile-backdrop").fadeIn();
	});
});
