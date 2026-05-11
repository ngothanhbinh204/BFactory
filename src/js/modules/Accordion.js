(function ($) {
	// Automatically initialize accordions with data-toggle="accordion"
	$(document).ready(function () {
		$('[data-toggle="accordion"]').each(function () {
			const activeIndex = $(this).data("active-index");
			const multipleOpen = $(this).data("multiple-open");
			$(this).customAccordion({
				defaultOpenIndex:
					activeIndex !== undefined ? activeIndex : "none",
				multipleOpen: multipleOpen !== undefined ? true : false,
			});
		});
	});

	$.fn.customAccordion = function (options) {
		// Default settings
		const defaults = {
			activeOpenClass: "current", // Class added to open accordion items by default
			animationSpeed: 300, // Animation speed in milliseconds
			multipleOpen: false, // Allow multiple accordions to stay open
			defaultOpenIndex: "none", // Index of the accordion to be open by default
			activeClass: "active", // Class added to active accordion title
			triggerSelector: ".accordion-trigger", // Selector for trigger elements
			contentSelector: ".accordion-content", // Selector for content elements
			onOpen: function (trigger, content) {}, // Callback function when an accordion is opened
			onClose: function (trigger, content) {}, // Callback function when an accordion is closed
		};

		// Extend default settings with options provided by user
		const settings = $.extend(true, {}, defaults, options);
		let lastScrollTop;
		// Helper function to debounce user clicks
		let debounce = false;
		function debounceClick(callback, delay) {
			if (debounce) return;
			debounce = true;
			setTimeout(() => (debounce = false), delay);
			callback();
		}

		this.open = function (index) {
			const $accordion = $(this);
			const $items = $accordion.find(".accordion-item");
			if (index >= 0 && index < $items.length) {
				const $trigger = $items
					.eq(index)
					.find(settings.triggerSelector);
				if (!$trigger.hasClass(settings.activeClass)) {
					$trigger.trigger("click");
				}
			}
		};

		this.close = function (index) {
			const $accordion = $(this);
			const $items = $accordion.find(".accordion-item");
			if (index >= 0 && index < $items.length) {
				const $trigger = $items
					.eq(index)
					.find(settings.triggerSelector);
				const $content = $items
					.eq(index)
					.find(settings.contentSelector);

				lastScrollTop = $(window).scrollTop();
				if ($trigger.hasClass(settings.activeClass)) {
					$trigger.removeClass(settings.activeClass);
					$content.slideUp(settings.animationSpeed, function () {
						settings.onClose($trigger, $content);
					});
				}
			}
		};

		this.openAll = function () {
			const $accordion = $(this);
			const $items = $accordion.find(".accordion-item");
			$items.each(function () {
				const $trigger = $(this).find(settings.triggerSelector);
				if (!$trigger.hasClass(settings.activeClass)) {
					$trigger.trigger("click");
				}
			});
		};

		this.closeAll = function () {
			const $accordion = $(this);
			const $items = $accordion.find(".accordion-item");
			$items.each(function () {
				const $trigger = $(this).find(settings.triggerSelector);
				const $content = $(this).find(settings.contentSelector);
				if ($trigger.hasClass(settings.activeClass)) {
					$trigger.removeClass(settings.activeClass);
					$content.slideUp(settings.animationSpeed, function () {
						settings.onClose($trigger, $content);
					});
				}
			});
		};

		this.reinit = function () {
			const $accordion = $(this);
			$accordion.find(settings.contentSelector).hide();
			$accordion
				.find(settings.triggerSelector)
				.removeClass(settings.activeClass);
			if (
				typeof settings.defaultOpenIndex === "number" &&
				settings.defaultOpenIndex >= 0
			) {
				const $defaultItem = $accordion
					.find(".accordion-item")
					.eq(settings.defaultOpenIndex);
				const $defaultTrigger = $defaultItem.find(
					settings.triggerSelector
				);
				const $defaultContent = $defaultItem.find(
					settings.contentSelector
				);
				$defaultTrigger.addClass(settings.activeClass);
				$defaultContent.show();
			}
		};

		return this.each(function () {
			const $accordion = $(this);
			const $items = $accordion.find(".accordion-item");
			const $triggers = $items.find(settings.triggerSelector);
			const $contents = $items.children(settings.contentSelector);
			// Initialize the accordion
			function init() {
				$contents.hide(); // Hide all contents initially
				$triggers.removeClass(settings.activeClass);

				// Ensure items with activeOpenClass are open by default
				$items.each(function () {
					const $item = $(this);
					if ($item.hasClass(settings.activeOpenClass)) {
						const $trigger = $item
							.find(settings.triggerSelector)
							.first();
						const $content = $item
							.children(settings.contentSelector)
							.first();
						$trigger.addClass(settings.activeClass);
						$content.show();
					}
				}); // Hide all contents initially

				// Open the default accordion if specified
				if (
					typeof settings.defaultOpenIndex === "number" &&
					settings.defaultOpenIndex >= 0
				) {
					const $defaultItem = $items.eq(settings.defaultOpenIndex);
					const $defaultTrigger = $defaultItem.find(
						settings.triggerSelector
					);
					const $defaultContent = $defaultItem.find(
						settings.contentSelector
					);
					$defaultTrigger.addClass(settings.activeClass);
					$defaultItem.addClass("open");
					$defaultContent.show();
				}
			}

			// Handle accordion trigger click event
			$triggers.on("click", function (event) {
				event.stopPropagation();
				debounceClick(() => {
					const $trigger = $(this);
					const $item = $trigger.closest(".accordion-item");
					const $content = $item.children(settings.contentSelector);

					lastScrollTop = $(window).scrollTop();

					if ($trigger.hasClass(settings.activeClass)) {
						// Close the currently active accordion
						$trigger.removeClass(settings.activeClass);
						$content.slideUp(settings.animationSpeed, function () {
							$item.removeClass("open"); // Remove 'open' class when closed
							settings.onClose($trigger, $content);
						});
					} else {
						if (!settings.multipleOpen) {
							// Close only sibling accordions if multipleOpen is false
							$item
								.siblings(".accordion-item")
								.find(settings.triggerSelector)
								.removeClass(settings.activeClass);
							$item
								.parent()
								.siblings()
								.find(".accordion-item")
								.find(settings.triggerSelector)
								.removeClass(settings.activeClass);
							$item
								.siblings(".accordion-item")
								.removeClass("open") // Remove 'open' class from siblings
								.children(settings.contentSelector)
								.slideUp(settings.animationSpeed, function () {
									settings.onClose(
										$(this)
											.closest(".accordion-item")
											.find(settings.triggerSelector),
										$(this)
									);
								});
							$item
								.parent()
								.siblings()
								.find(".accordion-item")
								.removeClass("open") // Remove 'open' class from siblings
								.children(settings.contentSelector)
								.slideUp(settings.animationSpeed, function () {
									settings.onClose(
										$(this)
											.closest(".accordion-item")
											.find(settings.triggerSelector),
										$(this)
									);
								});
						}

						// Open the clicked accordion
						$trigger.addClass(settings.activeClass);
						$content.slideDown(
							settings.animationSpeed,
							function () {
								$item.addClass("open"); // Add 'open' class when opened
								settings.onOpen($trigger, $content);
							}
						);
					}
				}, 300);
			});
			// Initialize the accordion on load
			init();
		});
	};
})(jQuery);
