<?php 

/**
 * Template Name: Error 404
 */
get_header();

the_module('error-404', array('four_image' => get_field('four_image')));

get_footer();
