<?php
/**
 * The template for displaying header navigation.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>

<nav class="site-navigation main-navigation prisma-core-primary-nav prisma-core-nav pr-header-element" role="navigation"<?php prisma_core_schema_markup( 'site_navigation' ); ?> aria-label="<?php esc_attr_e( 'Site Navigation', 'prisma-core' ); ?>">
<?php

if ( has_nav_menu( 'prisma-core-primary' ) ) {
	wp_nav_menu(
		array(
			'theme_location' => 'prisma-core-primary',
			'menu_id'        => 'prisma-core-primary-nav',
			'container'      => '',
			'link_before'    => '<span>',
			'link_after'     => '</span>',
		)
	);
} else {
	wp_page_menu(
		array(
			'menu_class'  => 'prisma-core-primary-nav',
			'show_home'   => true,
			'container'   => 'ul',
			'before'      => '',
			'after'       => '',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		)
	);
}

?>
</nav><!-- END .prisma-core-nav -->
