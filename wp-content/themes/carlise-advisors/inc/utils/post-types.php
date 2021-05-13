<?php

function quantum_register_post_types()
{
  $default_supports = array(
    'title',
    'thumbnail',
    'editor',
    'revisions',
    'author',
    'excerpt',
    'page-attributes'
  );

  // register_post_type('team-members', array(
  //   'labels' => array(
  //     'name' => __('Team Members'),
  //     'singular_name' => __('Team Member')
  //   ),
  //   'public' => true,
  //   'has_archive' => false,
  //   'rewrite' => array(
  //     'with_front' => false
  //   ),
  //   'supports' => $default_supports
  // ));

  // register_post_type('testimonials', array(
  //   'labels' => array(
  //     'name' => __('Testimonials'),
  //     'singular_name' => __('Testimonial')
  //   ),
  //   'public' => true,
  //   'has_archive' => false,
  //   'rewrite' => array(
  //     'with_front' => false
  //   ),
  //   'supports' => array_diff($default_supports, array('editor'))
  // ));

  // register_post_type('resources', array(
  //   'labels' => array(
  //     'name' => __('Resources'),
  //     'singular_name' => __('Resource')
  //   ),
  //   'public' => true,
  //   'has_archive' => false,
  //   'rewrite' => array(
  //     'with_front' => false
  //   ),
  //   'supports' => $default_supports
  // ));

  // register_post_type('careers', array(
  //   'labels' => array(
  //     'name' => __('Careers'),
  //     'singular_name' => __('Career')
  //   ),
  //   'public' => true,
  //   'has_archive' => false,
  //   'rewrite' => array(
  //     'with_front' => false
  //   ),
  //   'supports' => $default_supports
  // ));

  // register_post_type('testimonials', array(
  //   'labels' => array(
  //     'name' => __('Testimonials'),
  //     'singular_name' => __('Testimonial')
  //   ),
  //   'public' => true,
  //   'has_archive' => false,
  //   'rewrite' => array(
  //     'with_front' => false
  //   ),
  //   'supports' => $default_supports
  // ));

  // register_post_type('leaders', array(
  //   'labels' => array(
  //     'name' => __('Leaders'),
  //     'singular_name' => __('Leader')
  //   ),
  //   'public' => true,
  //   'has_archive' => false,
  //   'rewrite' => array(
  //     'with_front' => false
  //   ),
  //   'supports' => $default_supports
  // ));
}
quantum_register_post_types();
