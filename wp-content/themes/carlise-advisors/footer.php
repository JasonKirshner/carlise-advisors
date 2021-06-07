<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package carlise-advisors-base
 */

?>

</div><!-- #content -->
<?php the_module('footer', array(
  'footer_logo' => get_field('footer_logo'),
  'footer_wysiwyg_left' => get_field('footer_wysiwyg_left'),
  'footer_wysiwyg_right' => get_field('footer_wysiwyg_right')
)); ?>

<?php
wp_footer();
if (setted($_SERVER['PANTHEON_ENVIRONMENT']) && !in_array($_SERVER['PANTHEON_ENVIRONMENT'], array('test', 'live'))) {
  the_module('build-version');
} ?>

</body>

</html>