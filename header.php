<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Science+Gothic:wght@100..900&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&family=Science+Gothic:wght@100..900&display=swap"
        rel="stylesheet">
	<!-- Style-->
	<?php wp_head(); ?>
	<!-- Script-->
	<script>
        var APP_CONFIG = {
            toast: {
                title: {
                    success: "Thành công",
                    error: "Thất bại.",
                    warning: "Cảnh báo.",
                    message: "Thông báo."
                }
            }
        }
    </script>
</head>

<body <?php body_class() ?>>
	<?php get_template_part("./modules/common/header") ?>