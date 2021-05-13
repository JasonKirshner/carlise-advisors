<?php

/**
 * Add support for ACF Theme Options page
 */
function create_options_pages()
{
  if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
      'page_title'   => 'Theme General Settings',
      'menu_title'  => 'Theme Settings',
      'menu_slug'   => 'theme-settings',
      'capability'  => 'edit_posts',
      'redirect'    => false
    ));

    acf_add_options_sub_page(array(
      'page_title'   => 'Development Settings',
      'menu_title'  => 'Development',
      'parent_slug'  => 'theme-settings',
      'post_id' => 'development-settings'
    ));

    // acf_add_options_sub_page(array(
    //   'page_title'   => 'Careers Settings',
    //   'menu_title'  => 'Careers Settings',
    //   'parent_slug'   => 'edit.php?post_type=careers',
    //   'post_id' => 'careers-settings'
    // ));
  }
}
create_options_pages();
