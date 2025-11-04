<?php // fallback code for classic/hybrid theme behavior; remove this file for full-site editing
get_header();
if (have_posts()):
the_post();
?>
<div id="content" class="site-content">
    <main class="site-main" id="site-main">
        <?php the_content(); ?>
    </main>
<?php endif; /* have_posts */
get_footer();
?>