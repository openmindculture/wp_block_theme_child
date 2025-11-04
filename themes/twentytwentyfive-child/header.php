<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header id="masthead" class="site-header">
    <div class="site-header-inner wp-block-group alignfull"><!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="site-header-row wp-block-group">
            <div class="site-branding wp-block-group alignwide">
                <div class="wrap">
                    <a href="<?php
					echo esc_url(home_url('/'));
					?>" rel="home" class="site-title-link">
                        <picture>
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo.png" alt="home logo" class="site-logo" width="640" height="289">
                        </picture>
                    </a>
                </div>
            </div>
            <div class="site-navigation wp-block-group alignwide">
                <nav>
	                <?php
	                wp_list_pages(array(
		                'title_li'    => '',
		                'sort_column' => 'menu_order, post_title',
		                'depth'       => 0,
	                ));
	                ?>
                </nav>
            </div>
        </div>
    </div>
</header>