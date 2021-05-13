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
<?php the_module('footer'); ?>

<?php
wp_footer();
if (setted($_SERVER['PANTHEON_ENVIRONMENT']) && !in_array($_SERVER['PANTHEON_ENVIRONMENT'], array('test', 'live'))) {
	the_module('build-version');
} ?>

</body>

</html>
