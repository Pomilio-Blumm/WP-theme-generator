<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package pb
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pb_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}

add_filter('body_class', 'pb_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pb_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'pb_pingback_header');

/**
 * Wrap embed html with bootstrap responsive embed div
 * https://gist.github.com/jeweltheme/e16ccb6d6c268aaca932aeef3c24e5d6
 */
function bootstrap_embed($html, $url, $attr)
{
    if (!is_admin()) {
        return "<div class=\"embed-responsive embed-responsive-16by9\">" . $html . "</div>";
    } else {
        return $html;
    }
}

add_filter('embed_oembed_html', 'bootstrap_embed', 10, 3);

/**
 * make wordpress gallery responsive with bootstrap grid
 * @param string $output
 * @param $atts
 * @param $instance
 * @return string
 */

function bootstrap_gallery($output = '', $atts, $instance)
{
    if (strlen($atts['columns']) < 1) {
        $columns = 3;
    } else {
        $columns = $atts['columns'];
    }

    $images = explode(',', $atts['ids']);
    if ($columns < 1 || $columns > 12) {
        $columns == 3;
    }

    $col_class = 'col-6 col-sm-6 col-md-4';

    $return = '<div class="row">';
    $i = 0;
    foreach ($images as $key => $value) {
        if ($i % $columns == 0 && $i > 0) {
            $return .= '</div><div class="row">';
        }
        $image_attributes = wp_get_attachment_image_src($value, 'full');
        $return .= '
            <div class="' . $col_class . '">
                <div class="gallery-image-wrap">
                    <a data-gallery="gallery" data-lightbox="photogallery" href="' . $image_attributes[0] . '">
                        <img src="' . $image_attributes[0] . '" alt="" class="img-fluid">
                    </a>
                </div>
            </div>';
        $i++;
    }
    $return .= '</div>';
    return $return;
}

add_filter('post_gallery', 'bootstrap_gallery', 10, 4);