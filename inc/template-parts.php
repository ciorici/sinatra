<?php
/**
 * Template parts.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds the meta tag to the site header.
 *
 * @since 1.0.0
 */
function prisma_core_meta_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
}
add_action( 'wp_head', 'prisma_core_meta_viewport', 1 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 *
 * @since 1.0.0
 */
function prisma_core_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'prisma_core_pingback_header' );

/**
 * Adds the meta tag for website accent color.
 *
 * @since 1.0.0
 */
function prisma_core_meta_theme_color() {

	$color = prisma_core_option( 'accent_color' );

	if ( $color ) {
		printf( '<meta name="theme-color" content="%s">', esc_attr( $color ) );
	}
}
add_action( 'wp_head', 'prisma_core_meta_theme_color' );

/**
 * Outputs the theme top bar area.
 *
 * @since 1.0.0
 */
function prisma_core_topbar_output() {

	if ( ! prisma_core_is_top_bar_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/topbar/topbar' );
}
add_action( 'prisma_core_header', 'prisma_core_topbar_output', 10 );

/**
 * Outputs the top bar widgets.
 *
 * @since 1.0.0
 * @param string $location Widget location in top bar.
 */
function prisma_core_topbar_widgets_output( $location ) {

	do_action( 'prisma_core_top_bar_widgets_before_' . $location );

	$prisma_core_top_bar_widgets = prisma_core_option( 'top_bar_widgets' );

	if ( is_array( $prisma_core_top_bar_widgets ) && ! empty( $prisma_core_top_bar_widgets ) ) {
		foreach ( $prisma_core_top_bar_widgets as $widget ) {

			if ( ! isset( $widget['values'] ) ) {
				continue;
			}

			if ( $location !== $widget['values']['location'] ) {
				continue;
			}

			if ( function_exists( 'prisma_core_top_bar_widget_' . $widget['type'] ) ) {

				$classes   = array();
				$classes[] = 'pr-topbar-widget__' . esc_attr( $widget['type'] );
				$classes[] = 'pr-topbar-widget';

				if ( isset( $widget['values']['visibility'] ) && $widget['values']['visibility'] ) {
					$classes[] = 'prisma-core-' . esc_attr( $widget['values']['visibility'] );
				}

				$classes = apply_filters( 'prisma_core_topbar_widget_classes', $classes, $widget );
				$classes = trim( implode( ' ', $classes ) );

				printf( '<div class="%s">', esc_attr( $classes ) );
				call_user_func( 'prisma_core_top_bar_widget_' . $widget['type'], $widget['values'] );
				printf( '</div><!-- END .pr-topbar-widget -->' );
			}
		}
	}

	do_action( 'prisma_core_top_bar_widgets_after_' . $location );
}
add_action( 'prisma_core_topbar_widgets', 'prisma_core_topbar_widgets_output' );

/**
 * Outputs the theme header area.
 *
 * @since 1.0.0
 */
function prisma_core_header_output() {

	if ( ! prisma_core_is_header_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/header/base' );
}
add_action( 'prisma_core_header', 'prisma_core_header_output', 20 );

/**
 * Outputs the header widgets in Header Widget Locations.
 *
 * @since 1.0.0
 * @param string $locations Widget location.
 */
function prisma_core_header_widgets( $locations ) {

	$locations      = (array) $locations;
	$all_widgets    = (array) prisma_core_option( 'header_widgets' );
	$header_widgets = $all_widgets;
	$header_class   = '';

	if ( ! empty( $locations ) ) {

		$header_widgets = array();

		foreach ( $locations as $location ) {

			$header_class = ' prisma-core-widget-location-' . $location;

			$header_widgets[ $location ] = array();

			if ( ! empty( $all_widgets ) ) {
				foreach ( $all_widgets as $i => $widget ) {
					if ( $location === $widget['values']['location'] ) {
						$header_widgets[ $location ][] = $widget;
					}
				}
			}
		}
	}

	echo '<div class="pr-header-widgets pr-header-element' . esc_attr( $header_class ) . '">';

	if ( ! empty( $header_widgets ) ) {
		foreach ( $header_widgets as $location => $widgets ) {

			do_action( 'prisma_core_header_widgets_before_' . $location );

			if ( ! empty( $widgets ) ) {
				foreach ( $widgets as $widget ) {
					if ( function_exists( 'prisma_core_header_widget_' . $widget['type'] ) ) {

						$classes   = array();
						$classes[] = 'pr-header-widget__' . esc_attr( $widget['type'] );
						$classes[] = 'pr-header-widget';

						if ( isset( $widget['values']['visibility'] ) && $widget['values']['visibility'] ) {
							$classes[] = 'prisma-core-' . esc_attr( $widget['values']['visibility'] );
						}

						$classes = apply_filters( 'prisma_core_header_widget_classes', $classes, $widget );
						$classes = trim( implode( ' ', $classes ) );

						printf( '<div class="%s"><div class="pr-widget-wrapper">', esc_attr( $classes ) );
						call_user_func( 'prisma_core_header_widget_' . $widget['type'], $widget['values'] );
						printf( '</div></div><!-- END .pr-header-widget -->' );
					}
				}
			}

			do_action( 'prisma_core_header_widgets_after_' . $location );
		}
	}

	echo '</div><!-- END .pr-header-widgets -->';
}
add_action( 'prisma_core_header_widget_location', 'prisma_core_header_widgets', 1 );

/**
 * Outputs the content of theme header.
 *
 * @since 1.0.0
 */
function prisma_core_header_content_output() {

	// Get the selected header layout from Customizer.
	$header_layout = prisma_core_option( 'header_layout' );

	?>
	<div id="prisma-core-header-inner">
	<?php

	// Load header layout template.
	get_template_part( 'template-parts/header/header', $header_layout );

	?>
	</div><!-- END #prisma-core-header-inner -->
	<?php
}
add_action( 'prisma_core_header_content', 'prisma_core_header_content_output' );

/**
 * Outputs the main footer area.
 *
 * @since 1.0.0
 */
function prisma_core_footer_output() {

	if ( ! prisma_core_is_footer_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/footer/base' );

}
add_action( 'prisma_core_footer', 'prisma_core_footer_output', 20 );

/**
 * Outputs the copyright area.
 *
 * @since 1.0.0
 */
function prisma_core_copyright_bar_output() {

	if ( ! prisma_core_is_copyright_bar_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/footer/copyright/copyright' );
}
add_action( 'prisma_core_footer', 'prisma_core_copyright_bar_output', 30 );

/**
 * Outputs the copyright widgets.
 *
 * @since 1.0.0
 * @param string $location Widget location in copyright.
 */
function prisma_core_copyright_widgets_output( $location ) {

	do_action( 'prisma_core_copyright_widgets_before_' . $location );

	$prisma_core_widgets = prisma_core_option( 'copyright_widgets' );

	if ( is_array( $prisma_core_widgets ) && ! empty( $prisma_core_widgets ) ) {
		foreach ( $prisma_core_widgets as $widget ) {

			if ( ! isset( $widget['values'] ) ) {
				continue;
			}

			if ( isset( $widget['values'], $widget['values']['location'] ) && $location !== $widget['values']['location'] ) {
				continue;
			}

			if ( function_exists( 'prisma_core_copyright_widget_' . $widget['type'] ) ) {

				$classes   = array();
				$classes[] = 'pr-copyright-widget__' . esc_attr( $widget['type'] );
				$classes[] = 'pr-copyright-widget';

				if ( isset( $widget['values']['visibility'] ) && $widget['values']['visibility'] ) {
					$classes[] = 'prisma-core-' . esc_attr( $widget['values']['visibility'] );
				}

				$classes = apply_filters( 'prisma_core_copyright_widget_classes', $classes, $widget );
				$classes = trim( implode( ' ', $classes ) );

				printf( '<div class="%s">', esc_attr( $classes ) );
				call_user_func( 'prisma_core_copyright_widget_' . $widget['type'], $widget['values'] );
				printf( '</div><!-- END .pr-copyright-widget -->' );
			}
		}
	}

	do_action( 'prisma_core_copyright_widgets_after_' . $location );

}
add_action( 'prisma_core_copyright_widgets', 'prisma_core_copyright_widgets_output' );

/**
 * Outputs the theme sidebar area.
 *
 * @since 1.0.0
 */
function prisma_core_sidebar_output() {

	if ( prisma_core_is_sidebar_displayed() ) {
		get_sidebar();
	}
}
add_action( 'prisma_core_sidebar', 'prisma_core_sidebar_output' );

/**
 * Outputs the back to top button.
 *
 * @since 1.0.0
 */
function prisma_core_back_to_top_output() {

	if ( ! prisma_core_option( 'enable_scroll_top' ) ) {
		return;
	}

	get_template_part( 'template-parts/misc/back-to-top' );
}
add_action( 'prisma_core_after_page_wrapper', 'prisma_core_back_to_top_output' );

/**
 * Outputs the theme page content.
 *
 * @since 1.0.0
 */
function prisma_core_page_header_template() {

	do_action( 'prisma_core_before_page_header' );

	if ( prisma_core_is_page_header_displayed() ) {
		if ( is_singular( 'post' ) ) {
			get_template_part( 'template-parts/header-page-title-single' );
		} else {
			get_template_part( 'template-parts/header-page-title' );
		}
	}

	do_action( 'prisma_core_after_page_header' );
}
add_action( 'prisma_core_page_header', 'prisma_core_page_header_template' );

/**
 * Outputs the theme hero content.
 *
 * @since 1.0.0
 */
function prisma_core_hero() {

	if ( ! prisma_core_is_hero_displayed() ) {
		return;
	}

	// Hero type.
	$hero_type = prisma_core_option( 'hero_type' );

	do_action( 'prisma_core_before_hero' );

	// Enqueue Prisma Core Slider script.
	wp_enqueue_script( 'prisma-core-slider' );

	?>
	<div id="hero" <?php prisma_core_hero_classes(); ?>>
		<?php get_template_part( 'template-parts/hero/hero', $hero_type ); ?>
	</div><!-- END #hero -->
	<?php

	do_action( 'prisma_core_after_hero' );
}
add_action( 'prisma_core_after_masthead', 'prisma_core_hero', 30 );

/**
 * Outputs the queried articles.
 *
 * @since 1.0.0
 */
function prisma_core_content() {

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content', prisma_core_get_article_feed_layout() );
		endwhile;

		prisma_core_pagination();

		else :
			get_template_part( 'template-parts/content/content', 'none' );
		endif;
}
add_action( 'prisma_core_content', 'prisma_core_content' );
add_action( 'prisma_core_content_archive', 'prisma_core_content' );
add_action( 'prisma_core_content_search', 'prisma_core_content' );

/**
 * Outputs the theme single content.
 *
 * @since 1.0.0
 */
function prisma_core_content_singular() {

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			if ( is_singular( 'post' ) ) {
				do_action( 'prisma_core_content_single' );
			} else {
				do_action( 'prisma_core_content_page' );
			}

		endwhile;
		else :
			get_template_part( 'template-parts/content/content', 'none' );
	endif;
}
add_action( 'prisma_core_content_singular', 'prisma_core_content_singular' );

/**
 * Outputs the theme 404 page content.
 *
 * @since 1.0.0
 */
function prisma_core_404_page_content() {

	get_template_part( 'template-parts/content/content', '404' );
}
add_action( 'prisma_core_content_404', 'prisma_core_404_page_content' );

/**
 * Outputs the theme page content.
 *
 * @since 1.0.0
 */
function prisma_core_content_page() {

	get_template_part( 'template-parts/content/content', 'page' );
}
add_action( 'prisma_core_content_page', 'prisma_core_content_page' );

/**
 * Outputs the theme single post content.
 *
 * @since 1.0.0
 */
function prisma_core_content_single() {

	get_template_part( 'template-parts/content/content', 'single' );
}
add_action( 'prisma_core_content_single', 'prisma_core_content_single' );

/**
 * Outputs the comments template.
 *
 * @since 1.0.0
 */
function prisma_core_output_comments() {
	comments_template();
}
add_action( 'prisma_core_after_singular', 'prisma_core_output_comments' );

/**
 * Outputs the theme archive page info.
 *
 * @since 1.0.0
 */
function prisma_core_archive_info() {

	// Author info.
	if ( is_author() ) {
		get_template_part( 'template-parts/entry/entry', 'about-author' );
	}
}
add_action( 'prisma_core_before_content', 'prisma_core_archive_info' );

/**
 * Outputs more posts button to author description box.
 *
 * @since 1.0.0
 */
function prisma_core_add_author_posts_button() {
	if ( ! is_author() ) {
		get_template_part( 'template-parts/entry/entry', 'author-posts-button' );
	}
}
add_action( 'prisma_core_entry_after_author_description', 'prisma_core_add_author_posts_button' );

/**
 * Outputs Comments Toggle button.
 *
 * @since 1.0.0
 */
function prisma_core_comments_toggle() {

	if ( prisma_core_comments_toggle_displayed() ) {
		get_template_part( 'template-parts/entry/entry-show-comments' );
	}
}
add_action( 'prisma_core_before_comments', 'prisma_core_comments_toggle' );

/**
 * Outputs Pre-Footer area.
 *
 * @since 1.0.0
 */
function prisma_core_pre_footer() {

	if ( ! prisma_core_is_pre_footer_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/pre-footer/base' );
}
add_action( 'prisma_core_before_colophon', 'prisma_core_pre_footer' );

/**
 * Outputs Page Preloader.
 *
 * @since 1.0.0
 */
function prisma_core_preloader() {

	if ( ! prisma_core_is_preloader_displayed() ) {
		return;
	}

	get_template_part( 'template-parts/preloader/base' );
}
add_action( 'prisma_core_before_page_wrapper', 'prisma_core_preloader' );

/**
 * Outputs breadcrumbs after header.
 *
 * @since  1.1.0
 * @return void
 */
function prisma_core_breadcrumb_after_header_output() {

	if ( 'below-header' === prisma_core_option( 'breadcrumbs_position' ) && prisma_core_has_breadcrumbs() ) {

		$alignment = 'pr-text-align-' . prisma_core_option( 'breadcrumbs_alignment' );

		$args = array(
			'container_before' => '<div class="pr-breadcrumbs"><div class="pr-container ' . $alignment . '">',
			'container_after'  => '</div></div>',
		);

		prisma_core_breadcrumb( $args );
	}
}
add_action( 'prisma_core_main_start', 'prisma_core_breadcrumb_after_header_output' );

/**
 * Outputs breadcumbs in page header.
 *
 * @since  1.1.0
 * @return void
 */
function prisma_core_breadcrumb_page_header_output() {

	if ( prisma_core_page_header_has_breadcrumbs() ) {

		if ( is_singular( 'post' ) ) {
			$args = array(
				'container_before' => '<div class="pr-container pr-breadcrumbs">',
				'container_after'  => '</div>',
			);
		} else {
			$args = array(
				'container_before' => '<div class="pr-breadcrumbs">',
				'container_after'  => '</div>',
			);
		}

		prisma_core_breadcrumb( $args );
	}
}
add_action( 'prisma_core_page_header_end', 'prisma_core_breadcrumb_page_header_output' );

/**
 * Replace tranparent header logo.
 *
 * @since  1.1.1
 * @param  string $output Current logo markup.
 * @return string         Update logo markup.
 */
function prisma_core_transparent_header_logo( $output ) {

	// Check if transparent header is displayed.
	if ( prisma_core_is_header_transparent() ) {

		// Check if transparent logo is set.
		$logo = prisma_core_option( 'tsp_logo' );
		$logo = isset( $logo['background-image-id'] ) ? $logo['background-image-id'] : false;

		$retina = prisma_core_option( 'tsp_logo_retina' );
		$retina = isset( $retina['background-image-id'] ) ? $retina['background-image-id'] : false;

		if ( $logo ) {
			$output = prisma_core_get_logo_img_output( $logo, $retina, 'pr-tsp-logo' );
		}
	}

	return $output;
}
add_filter( 'prisma_core_logo_img_output', 'prisma_core_transparent_header_logo' );
add_filter( 'prisma_core_site_title_markup', 'prisma_core_transparent_header_logo' );

/**
 * Output the main navigation template.
 */
function prisma_core_main_navigation_template() {
	get_template_part( 'template-parts/header/navigation' );
}

/**
 * Output the Header logo template.
 */
function prisma_core_header_logo_template() {
	get_template_part( 'template-parts/header/logo' );
}
