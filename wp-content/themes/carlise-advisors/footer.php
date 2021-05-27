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
  'footer_contact_us' => get_field('footer_contact_us'),
  'footer_contact_sales' => get_field('footer_contact_sales'),
  'footer_contact_support' => get_field('footer_contact_support'),
  'footer_contact_email' => get_field('footer_contact_email'),
  'footer_address' => get_field('footer_address'),
  'footer_address_location' => get_field('footer_address_location')
)); ?>

<?php
wp_footer();
if (setted($_SERVER['PANTHEON_ENVIRONMENT']) && !in_array($_SERVER['PANTHEON_ENVIRONMENT'], array('test', 'live'))) {
	the_module('build-version');
} ?>

</body>

</html>
