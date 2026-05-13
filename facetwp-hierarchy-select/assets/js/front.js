(function ($) {
  FWP.hooks.addAction(
    "facetwp/refresh/hierarchy_select",
    function ($this, facet_name) {
      var selected_values = [];
      $this.find(".facetwp-hierarchy_select option:checked").each(function () {
        var value = $(this).attr("value");
        if (value.length) {
          selected_values.push(value);
        }
      });
      FWP.facets[facet_name] = selected_values;
    }
  );

  FWP.hooks.addFilter(
    "facetwp/selections/hierarchy_select",
    function (output, params) {
      var selected_values = [];
      params.el
        .find(".facetwp-hierarchy_select option:checked")
        .each(function () {
          var value = $(this).attr("value");
          if (value.length) {
            selected_values.push({ value: value, label: $(this).text() });
          }
        });
      return selected_values;
    }
  );

  // CUSTOMIZATION IS HERE
  $(document).on(
    "change",
    ".facetwp-type-hierarchy_select select",
    function () {
      var $this = $(this); // The <select> element that was changed
      var $parent = $this.closest(".facetwp-facet");
      var active_level = parseInt($this.attr("data-level"));

      // --- MỚI: Logic kiểm tra số đếm và hiển thị popup ---
      var $selected_option = $this.find("option:checked");
      var selected_value = $selected_option.attr("value");

      // Chỉ kiểm tra khi người dùng chọn một giá trị cụ thể (không phải "Any")
      if (selected_value.length > 0) {
        var count = $selected_option.data("count");
        // Nếu tìm thấy số đếm và nó bằng 0
        if (count === 0) {
          // Kiểm tra xem Fancybox có tồn tại không
          if ("undefined" !== typeof Fancybox) {
            // Hiển thị popup
            Fancybox.show([
              {
                src: "#no-results-popup",
                type: "inline",
              },
            ]);
          } else {
            // Fallback nếu không có Fancybox
            alert("Rất tiếc, khu vực bạn vừa chọn hiện không có kết quả nào.");
          }
        }
      }
      // --- KẾT THÚC LOGIC MỚI ---

      // Logic gốc: reset các dropdown con
      $parent.find("select").each(function () {
        // Note: using 'el' from original code was incorrect, should be 'this'
        var level = parseInt($(this).attr("data-level"));
        if (level > active_level) {
          $(this).val("");
        }
      });

      // Tải lại kết quả của FacetWP
      FWP.autoload();
    }
  );
})(jQuery); // Changed fUtil to jQuery for consistency as the original code uses $
