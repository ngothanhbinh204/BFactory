jQuery(function ($) {
	$(".single_add_to_cart_button, .add_to_cart_button").on(
		"click",
		function (e) {
			e.preventDefault(); // Prevent default action
			var $thisbutton = $(this);
			var $form = $thisbutton.closest("form.cart");
			var variation_id_input = $form.find("input[name=variation_id]");
			var product_id = variation_id_input.val() || $thisbutton.val();
			var quantity = $form.find("input[name=quantity]").val() || 1;

			var data = {
				action: "woocommerce_ajax_add_to_cart",
				product_id: product_id,
				product_sku: "",
				quantity: quantity,
			};

			// $(document.body).trigger("adding_to_cart", [$thisbutton, data]);

			$.ajax({
				type: "post",
				url: wc_add_to_cart_params.ajax_url,
				data: data,
				beforeSend: function (response) {
					$thisbutton.removeClass("added").addClass("loading");
				},
				complete: function (response) {
					$thisbutton.addClass("added").removeClass("loading");
				},
				success: function (response) {
					if (response.error & response.product_url) {
						window.location = response.product_url;
						return;
					} else {
						// Trigger event so cart is refreshed
						$(document.body).trigger("added_to_cart", [
							response.fragments,
							response.cart_hash,
							$thisbutton,
						]);
					}
					$(".cart-count").html(
						"(" + response.cart_contents_count + ")"
					);
					$(".mini-cart-popup").html(response.mini_cart_html);
					$(".mini-cart-popup").addClass("open");
					$(".mini-cart-backdrop").fadeIn();
					$(document.body).trigger("cart_contents_updated");
				},
			});

			return false;
		}
	);
});
