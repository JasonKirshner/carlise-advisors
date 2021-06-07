<?php

/**
 * Template Name: Homepage
 */

get_header();
//                         key  <pass>   value
the_module('hero', array('hero_title' => get_field('hero_title'), 'hero_image' => get_field('hero_image')));
the_module('image-copy', array( 
  'icon' => get_field('project_icon'), 
  'title' => get_field('project_title'), 
  'image' => get_field('project_image'), 
  'wysiwyg' => get_field('project_wysiwyg'), 
));
the_module('copy-grid', array(
  'services_icon' => get_field('services_icon'), 
  'services_title' => get_field('services_title'), 
  'service' => get_field('service')
));
the_module('image-copy', array( 
  'icon' => get_field('prepare_icon'), 
  'title' => get_field('prepare_title'), 
  'image' => get_field('prepare_image'), 
  'wysiwyg' => get_field('prepare_wysiwyg'), 
));
the_module('image-copy', array(
  'icon' => get_field('call_center_icon'), 
  'title' => get_field('call_center_title'), 
  'image' => get_field('call_center_image'), 
  'wysiwyg' => get_field('call_center_wysiwyg'), 
  'background' => 'background',
  'direction' => 'reverse',
));
the_module('image-copy', array( 
  'icon' => get_field('upgrade_icon'), 
  'title' => get_field('upgrade_title'), 
  'image' => get_field('upgrade_image'), 
  'wysiwyg' => get_field('upgrade_wysiwyg'), 
));
the_module('footer-cta', array(
  'footer_cta_title' => get_field('footer_cta_title')
  //'footer_button' => get_field('footer_button')
  
));

get_footer();
