<?php
function field_image($instance, $class = '')
{
	return "<img data-src='{$instance['url']}' alt='{$instance['alt']}' class='lazy {$class}'>";
}

function post_thumbnail($post_id, $class = '')
{
	$thumbnail_url = get_the_post_thumbnail_url($post_id);
	$title = get_the_title($post_id);
	return "<img data-src='{$thumbnail_url}' alt='{$title}' class='lazy {$class}'>";
}
