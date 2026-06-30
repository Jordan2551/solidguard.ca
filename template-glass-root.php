<?php
/**
 * Template Name: Glass — Category Root
 * Template Post Type: page
 *
 * Category landing page (e.g. /glass/residential/): intro + an auto-generated
 * grid of its child spokes, then the global trust sections. Body is shared with
 * the hub via template-parts/glass-listing.php. Shares the Glass Service ACF group.
 *
 * @package SolidGuard
 */

get_header();
get_template_part( 'template-parts/glass-listing' );
get_footer();
