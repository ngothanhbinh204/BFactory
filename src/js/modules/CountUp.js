import { CountUp } from "countup.js";

$(function () {
	$(".counter").each(function (index, element) {
		let count = parseInt($(element).data("count"));
		const countUp = new CountUp(element, count, {
			enableScrollSpy: true,
			scrollSpyOnce: true,
			separator: ".",
		});
		if (!countUp.error) {
			countUp.start();
		} else {
			console.error(countUp.error);
		}
	});
});
