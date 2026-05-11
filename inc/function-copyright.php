<?php
function generate_copyright_notice()
{
	$first_year = 2025; // Replace with the first year of your website.
	$current_year = date('Y');
	$blogname = get_bloginfo('name');

	$years = $first_year;
	if ($current_year > $first_year) {
		$years = "$first_year - $current_year";
	}

	$design_link = '<a href="" target="_blank" rel="noopener noreferrer">' . __('Thiết k website', 'canhcamtheme') . '</a>';
	$developer_link = '<a href="" target="_blank" rel="noopener noreferrer">' . __('Cánh Cam', 'canhcamtheme') . '</a>';

	$copyright = "&copy; $years $blogname. " . " " . __("Mọi quyền được bảo lưu", 'canhcamtheme') . ". " . $design_link . " " . __('bởi', 'canhcamtheme') . " " . $developer_link . ".";

	return $copyright;
}
