<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pb
 */
get_header();
?>

    <main id="main" class="container-fluid p-0">
        <div class="container">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12 mx-auto pt-3 pb-3 pl-lg-0 pr-lg-0 pl-xl-0 pr-xl-0">
                <p id="breadcrumbs" class="m-0 pt-4 pb-5 mt-4">
                    <span>
                        <span>
                            <a href="<?php bloginfo('url'); ?>">Home page</a> &gt;
                            <span class="breadcrumb_last">Archivio News</span>
                        </span>
                    </span>
                </p>
            </div>
            <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12 mx-auto pt-3 pb-3 pl-lg-0 pr-lg-0 pl-xl-0 pr-xl-0">
                <header class="entry-header">
                    <h1>ARCHIVIO <strong>NEWS</strong></h1>
                </header>
            </div>
        </div>

        <?php if (have_posts()) : ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12 mx-auto pb-3 pl-lg-0 pr-lg-0 pl-xl-0 pr-xl-0">
                        <ul id="entry-news" class="list-unstyled pt-5">
                            <?php
                            /* Start the Loop */
                            while (have_posts()) :
                                the_post();
                                $immagine = types_render_field('articolo-thumbnail', array('output' => 'raw'));
                                $link = types_render_field('link-esterno', array('output' => 'raw'));
                                $linktesto = types_render_field('testo-link-esterno', array('output' => 'raw'));
                                if ($link) : ?>
                                    <a target="_blank" href="<?php echo $link; ?>" data-aos="fade-up">
                                        <li class="media mb-3">
                                            <img class="img-fluid d-none d-md-block" src="<?php echo $immagine; ?>"
                                                 alt="<?php echo the_title(); ?>">
                                            <div class="media-body popolazione imprese agricoltura">
                                                <h4 class="mt-3 mb-1"><?php echo get_the_date('j F Y'); ?></h4>
                                                <h3><?php echo the_title(); ?></h3>
                                                <?php echo the_excerpt(); ?>
                                            </div>
                                        </li>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo the_permalink(); ?>" data-aos="fade-up">
                                        <li class="media mb-3">
                                            <img class="img-fluid d-none d-md-block" src="<?php echo $immagine; ?>"
                                                 alt="<?php echo the_title(); ?>">
                                            <div class="media-body popolazione imprese agricoltura">
                                                <h4 class="mt-3 mb-1"><?php echo get_the_date('j F Y'); ?></h4>
                                                <h3><?php echo the_title(); ?></h3>
                                                <?php echo the_excerpt(); ?>
                                            </div>
                                        </li>
                                    </a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>
<?php
// get_sidebar();
get_footer();
