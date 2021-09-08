<?php
get_header();
?>
    <main id="main" class="container-fluid p-0">
        <?php
        while (have_posts()) :
            the_post();

            get_template_part('template-parts/content', get_post_type());

        endwhile; // End of the loop.
        ?>
        <?php include get_template_directory() . '/template-parts/social-bar.php'; ?>
    </main>

<?php
// get_sidebar();
get_footer();
