<?php

/**
 * Template Name: Homepage
 */

get_header();
//                         key  <pass>   value
the_module('hero', array('title' => get_field('hero_title')));
the_module('image-copy', array('aaa' => get_field('project_image')));
the_module('copy-grid');
the_module('image-copy');
the_module('image-copy');
the_module('image-copy');
the_module('footer-cta');
the_module('footer');

get_footer();
