<?php
/**
 * Template Name: Glass — Hub
 * Template Post Type: page
 *
 * Top-level /glass/ landing page: intro + an auto-generated grid of the category
 * roots (residential, commercial, emergency), then the global trust sections.
 * Body is shared with the category root via template-parts/glass-listing.php.
 *
 * @package SolidGuard
 */

get_header();
get_template_part( 'template-parts/glass-listing' );
get_footer();
