<?php

/**
 * This is the template that displays all of the <head> section and everything up until <div class="main-content">
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<?php the_module('skip-content'); ?>

		<header id="masthead" class="site-header">
			<?php the_module('navigation') ?>
		</header><!-- #masthead -->

		<div class="main-content">
