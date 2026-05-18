import { Fancybox } from "@fancyapps/ui";
import "./modules/Header";
import "./modules/Slider";
import "./modules/Accordion";
import "./modules/BackToTop";
import "./modules/ExpandContent";
// import "./modules/ProductDetail";
import "./modules/Tab";
import "./modules/Dealer";
import "./modules/Checkout";
import "./modules/Cart";

var lazyLoadInstance = new LazyLoad({
	// Your custom settings go here
});

window.lazyLoadInstance = lazyLoadInstance;
window.Fancybox = Fancybox;

Fancybox.bind("[data-fancybox]", {
	// Your custom options
});

$(function () {
	try {
		document.addEventListener("facetwp-loaded", function () {
			lazyLoadInstance.update();
		});
	} catch (error) {}

	addFirstColumnClass();
	initProductFilter();

	$(".copy-link").on("click", function () {
		var url = window.location.href;
		if (navigator.clipboard && window.isSecureContext) {
			navigator.clipboard.writeText(url);
		} else {
			var textArea = document.createElement("textarea");
			textArea.value = url;
			textArea.style.position = "fixed";
			textArea.style.left = "-999999px";
			textArea.style.top = "-999999px";
			document.body.appendChild(textArea);
			textArea.focus();
			textArea.select();
			try {
				document.execCommand("copy");
			} catch (err) {
				console.error("Fallback: Oops, unable to copy", err);
			}
			document.body.removeChild(textArea);
		}
		$(this).find("span").addClass("fa-check").removeClass("fa-copy");
		$(this).addClass("copied");
	});

	$(window).on("resize", function () {
		addFirstColumnClass();
	});
});

function addFirstColumnClass() {
	const row = $(".row-computed");
	let currentTopPosition = null;

	row.find("> *")
		.removeClass("first-column")
		.each(function () {
			const itemTopPosition = $(this).position().top;

			if (
				currentTopPosition === null ||
				itemTopPosition > currentTopPosition
			) {
				currentTopPosition = itemTopPosition;
				$(this).addClass("first-column");
			}
		});
}

function initProductFilter() {
	$(".filter-item").each(function () {
		const $filter = $(this);
		const $filterTitle = $filter.find(".filter-item-title");
		const $filterContent = $filter.find(".filter-item-content");

		$filterTitle.on("click", function () {
			$filterContent.slideToggle();
			$filterTitle.find("i").css("transform", "rotate(180deg)");
		});
	});
}
