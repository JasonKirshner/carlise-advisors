<?php

/**
 * Template Name: Error 404
 */
get_header();

the_module('error-404', array(
  'four_image' => get_field('four_image', 7),
  'four_text' => get_field('four_text', 7)
));

get_footer();
