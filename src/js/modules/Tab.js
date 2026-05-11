import scrollToElement from "./ScrollElement";

$(function () {
	$('[data-toggle="tab"]').each(function () {
		const $this = $(this);
		const $tabContainer = $this.data("target");
		$this.tabslet({
			container: $tabContainer,
		});
	});
});
