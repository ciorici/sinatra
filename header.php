<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?><?php prisma_core_schema_markup( 'html' ); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'prisma_core_before_page_wrapper' ); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'prisma-core' ); ?></a>

	<?php do_action( 'prisma_core_before_masthead' ); ?>

	<header id="masthead" class="site-header" role="banner"<?php prisma_core_masthead_atts(); ?><?php prisma_core_schema_markup( 'header' ); ?>>
		<?php do_action( 'prisma_core_header' ); ?>
		<?php do_action( 'prisma_core_page_header' ); ?>
	</header><!-- #masthead .site-header -->

	<?php do_action( 'prisma_core_after_masthead' ); ?>

	<?php do_action( 'prisma_core_before_main' ); ?>
	<div id="main" class="site-main">

		<?php do_action( 'prisma_core_main_start' ); ?>
