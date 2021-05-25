<?php

/**
 * Template Name: Homepage
 */

get_header();
//                         key  <pass>   value
the_module('hero', array('hero_title' => get_field('hero_title'), 'hero_image' => get_field('hero_image')));
the_module('image-copy', array( 
  'project_icon' => get_field('project_icon'), 
  'project_title' => get_field('project_title'),
  'project_image' => get_field('project_image'), 
  'project_subtitle' => get_field('project_subtitle'),
  'project_subtitle_1' => get_field('project_subtitle_1'),
  'project_blurb_1' => get_field('project_blurb_1'),
  'project_subtitle_2' => get_field('project_subtitle_2'),
  'project_blurb_2' => get_field('project_blurb_2'),
));
the_module('copy-grid', array(
  'services_icon' => get_field('services_icon'), 
  'services_title' => get_field('services_title'), 
  'service' => get_field('service')
));
the_module('image-copy', array(
  'prepare_icon' => get_field('prepare_icon'), 
  'prepare_title' => get_field('prepare_title'), 
  'prepare_image' => get_field('prepare_image'), 
  'prepare_subtitle' => get_field('prepare_subtitle'), 
  'prepare_blurb' => get_field('prepare_blurb')
));
the_module('image-copy', array(
  'call_center_icon' => get_field('call_center_icon'), 
  'call_center_title' => get_field('call_center_title'), 
  'call_center_image' => get_field('call_center_image'), 
  'call_center_subtitle' => get_field('call_center_subtitle'), 
  'call_center_blurb' => get_field('call_center_blurb')
));
the_module('upgrade-tech', array(
  'upgrade_icon' => get_field('upgrade_icon'), 
  'upgrade_title' => get_field('upgrade_title'), 
  'upgrade_image' => get_field('upgrade_image'), 
  'upgrade_subtitle' => get_field('upgrade_subtitle'), 
  'upgrade_blurb' => get_field('upgrade_blurb')
));
the_module('footer-cta');

get_footer();
