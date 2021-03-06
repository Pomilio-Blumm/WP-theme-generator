<?php
get_header();
?>
    <main id="main" class="container-fluid p-0">
        <div class="container">
            <?php include get_template_directory() . '/template-parts/breadcrumbs.php'; ?>
            <?php if (have_posts()) : ?>
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12 mx-auto pt-3 pb-3 pl-lg-0 pr-lg-0 pl-xl-0 pr-xl-0">
                <header class="entry-header pt-4">
                    <h1>
                        <?php
                        /* translators: %s: search query. */
                        printf(esc_html__('Search Results for: %s', 'pb'), '<span>' . get_search_query() . '</span>');
                        ?>
                    </h1>
                </header>

                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part('template-parts/content', 'search');

                endwhile;

                the_posts_navigation();

                else :

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>
            </div>
        </div>
    </main>
<?php
// get_sidebar();
get_footer();
