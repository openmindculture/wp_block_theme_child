<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>CUSTOM HEADER
    <nav>
		<?php
		wp_nav_menu(array(
			'theme_location' => 'primary',
			'fallback_cb' => false,
			'container' => false,
		));
		?>
    </nav>
</header>
