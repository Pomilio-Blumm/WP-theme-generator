<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>
    <div class="">
        <?php include get_template_directory() . '/template-parts/breadcrumbs.php'; ?>
    </div>

    <div class="">

        <?php pb_post_thumbnail(); ?>

        <header class="entry-header">
            <?php the_title('<h1>', '</h1>'); ?>
        </header>

        <div class="entry-content">
            <?php
            the_content();
            ?>
        </div>
    </div>
</article>
