<?php

class FacetWP_Facet_Hierarchy_Select_Addon extends FacetWP_Facet
{

    function __construct()
    {
        $this->label = __('Hierarchy Select', 'fwp');
        $this->fields = ['orderby', 'depth_labels'];
    }


    /**
     * CUSTOMIZED: Ghi đè hoàn toàn hàm load_values() để lấy tất cả các term, kể cả term rỗng.
     */
    function load_values($params)
    {
        global $wpdb;

        $facet = $params['facet'];
        $output = [];
        $taxonomy = str_replace('tax/', '', $facet['source']);
        $where_clause = $this->get_where_clause($facet);

        // Lấy danh sách ĐẦY ĐỦ các term từ taxonomy, kể cả term không có bài viết
        $all_terms = get_terms([
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        ]);

        if (is_wp_error($all_terms)) {
            return [];
        }

        // Lấy thông tin về cấp độ của tất cả term
        $depths = FWP()->helper->get_term_depths($taxonomy);

        // Lấy số đếm cho các term CÓ bài viết
        $sql = "
            SELECT f.term_id, COUNT(DISTINCT f.post_id) AS counter
            FROM {$wpdb->prefix}facetwp_index f
            WHERE f.facet_name = '{$facet['name']}' $where_clause
            GROUP BY f.term_id";
        $results = $wpdb->get_results($sql, ARRAY_A);

        // Tạo một mảng tra cứu số đếm (lookup) để tăng hiệu suất
        $counts = [];
        foreach ($results as $result) {
            $counts[$result['term_id']] = (int) $result['counter'];
        }

        // Xây dựng mảng kết quả cuối cùng
        foreach ($all_terms as $term) {
            $term_id = $term->term_id;
            $output[] = [
                'facet_value'           => $term->slug,
                'facet_display_value'   => $term->name,
                'term_id'               => $term_id,
                'parent_id'             => $term->parent,
                'depth'                 => $depths[$term_id]['depth'] ?? 0,
                'counter'               => $counts[$term_id] ?? 0,
            ];
        }

        return $output;
    }


    /**
     * Filter out irrelevant choices - The original function is kept.
     */
    function filter_load_values($values, $selected_values)
    {
        foreach ($selected_values as $depth => $selected_value) {
            $selected_id = -1;

            foreach ($values as $key => $val) {
                if ($selected_value == $val['facet_value']) { // save the parent_id
                    $selected_id = $val['term_id'];
                }

                if ($val['depth'] == ($depth + 1)) { // child of the selected value
                    if ($val['parent_id'] != $selected_id) {
                        unset($values[$key]);
                    }
                }
            }
        }

        return $this->group_by_depth($values);
    }


    /**
     * Group values in buckets by depth to make output easier - The original function is kept.
     */
    function group_by_depth($values)
    {
        $depths = [];

        foreach ($values as $val) {
            $depth = (int) $val['depth'];
            $depths[$depth][] = $val;
        }

        return $depths;
    }


    /**
     * CUSTOMIZED: Ghi đè hàm render() để tự xử lý logic hiển thị
     */
    function render($params)
    {
        $output = '';
        $facet = $params['facet'];
        $values = (array) $params['values'];
        $selected_values = (array) $params['selected_values'];

        // --- Bắt đầu logic xử lý dữ liệu ngay trong hàm render ---
        $grouped_values = [];
        foreach ($values as $val) {
            $depth = (int) $val['depth'];
            $grouped_values[$depth][] = $val;
        }
        foreach ($selected_values as $depth => $selected_value) {
            $selected_id = -1;
            foreach ($values as $val) {
                if ($selected_value == $val['facet_value']) {
                    $selected_id = $val['term_id'];
                    break;
                }
            }
            if (isset($grouped_values[$depth + 1])) {
                $children = [];
                foreach ($grouped_values[$depth + 1] as $child_val) {
                    if ($child_val['parent_id'] == $selected_id) {
                        $children[] = $child_val;
                    }
                }
                $grouped_values[$depth + 1] = $children;
            }
        }

        // --- Bắt đầu tạo HTML ---
        $levels = $facet['levels'] ?? [];
        $active_levels = count($selected_values);
        foreach ($levels as $level_num => $level_name) {
            $is_disabled = ($level_num > $active_levels);
            $disabled_attr = $is_disabled ? ' disabled' : '';
            $class = $is_disabled ? ' is-disabled' : '';
            $label = empty($level_name) ? __('Any', 'fwp') : facetwp_i18n($level_name);
            if (empty($grouped_values[$level_num])) {
                $class .= ' is-empty';
            }
            $output .= '<select class="facetwp-hierarchy_select' . $class . '" data-level="' . $level_num . '"' . $disabled_attr . '>';
            $output .= '<option value="">' . esc_attr($label) . '</option>';
            if (! $is_disabled && isset($grouped_values[$level_num])) {
                foreach ($grouped_values[$level_num] as $row) {
                    $selected_attr = (isset($selected_values[$level_num]) && $selected_values[$level_num] == $row['facet_value']) ? ' selected' : '';
                    $display_value = esc_attr($row['facet_display_value']);
                    $show_counts = apply_filters('facetwp_facet_dropdown_show_counts', true, array('facet' => $facet));

                    // Nếu bạn đã ẩn counter, bạn có thể xóa/chú thích dòng if này
                    if ($show_counts) {
                        $display_value .= ' (' . $row['counter'] . ')';
                    }

                    // THAY ĐỔI QUAN TRỌNG: Thêm thuộc tính data-count vào thẻ option
                    $output .= '<option value="' . esc_attr($row['facet_value']) . '"' . $selected_attr . ' data-count="' . esc_attr($row['counter']) . '">' . $display_value . '</option>';
                }
            }
            $output .= '</select>';
        }
        return $output;
    }


    /**
     * Filter the query based on selected values - The original function is kept.
     */
    function filter_posts($params)
    {
        global $wpdb;

        $facet = $params['facet'];
        $selected_values = (array) $params['selected_values'];
        $selected_values = array_pop($selected_values);

        $sql = "
        SELECT DISTINCT post_id FROM {$wpdb->prefix}facetwp_index
        WHERE facet_name = '{$facet['name']}' AND facet_value IN ('$selected_values')";
        return $wpdb->get_col($sql);
    }


    /**
     * Output any front-end scripts - The original function is kept.
     */
    function front_scripts()
    {
        FWP()->display->assets['hierarchy-select-front.js'] = [plugins_url('', __FILE__) . '/assets/js/front.js', FACETWP_HIERARCHY_SELECT_VERSION];
    }


    /**
     * Output any admin scripts - The original function is kept.
     */
    function admin_scripts()
    {
?>
        <script>
            Vue.component('levels', {
                props: ['facet'],
                template: `
    <div>
        <div v-for="(label, index) in facet.levels">
            <div style="padding-bottom:10px">
                <input type="text" :value="label" @change="setValue(index, event.target.value)" :placeholder="getPlaceholder(index)" />
                <button class="button" @click="removeLabel(index)" v-if="index > 0">x</button>
            </div>
        </div>
        <button class="button" @click="addLabel()">Add label</button>
    </div>
    `,
                methods: {
                    setValue: function(index, value) {
                        this.facet.levels.splice(index, 1, value);
                    },
                    addLabel: function() {
                        this.facet.levels.push('');
                    },
                    removeLabel: function(index) {
                        Vue.delete(this.facet.levels, index);
                    },
                    getPlaceholder: function(index) {
                        return 'Enter label (depth ' + index + ')';
                    }
                },
                created() {
                    this.facet.hierarchical = 'yes';

                    if (this.facet.levels.length < 1) {
                        this.facet.levels = [''];
                    }
                }
            });
        </script>
<?php
    }


    function register_fields()
    {
        return [
            'depth_labels' => [
                'type' => 'alias',
                'items' => [
                    'levels' => [
                        'label' => __('Show depth levels', 'fwp'),
                        'notes' => '(Required) Add a label for each hierarchy depth level',
                        'html' => '<input type="hidden" class="facet-levels" value="[]" /><levels :facet="facet"></levels>'
                    ]
                ]
            ]
        ];
    }
}
