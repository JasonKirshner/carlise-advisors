<?php

/**
 * theme-name functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package theme-name
 */

if (!function_exists('theme_name_setup')) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function theme_name_setup()
  {
    /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on theme-name, use a find and replace
		 * to change 'theme-name' to the name of your theme in all the template files.
		 */
    load_theme_textdomain('theme-name', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
    add_theme_support('title-tag');

    /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
      'primary' => esc_html__('Primary', 'theme-name'),
      'footer-menu' => esc_html__('Footer Menu', 'theme-name'),
    ));

    /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
    add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ));

    /**
     * Add custom post types
     */
    require_once 'utils/post-types.php';
    /**
     * Add taxonomies
     */
    require_once 'utils/taxonomies.php';
    /**
     * Add options-pages
     */
    require_once 'utils/options-pages.php';
  }
endif;
add_action('after_setup_theme', 'theme_name_setup');
