<?php
/**
 * Prisma Core Options Class.
 *
 * @package  Prisma Core
 * @author   Prisma Core Team
 * @since    1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Prisma_Core_Options' ) ) :

	/**
	 * Prisma Core Options Class.
	 */
	class Prisma_Core_Options {

		/**
		 * Singleton instance of the class.
		 *
		 * @since 1.0.0
		 * @var object
		 */
		private static $instance;

		/**
		 * Options variable.
		 *
		 * @since 1.0.0
		 * @var mixed $options
		 */
		private static $options;

		/**
		 * Main Prisma_Core_Options Instance.
		 *
		 * @since 1.0.0
		 * @return Prisma_Core_Options
		 */
		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Prisma_Core_Options ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Refresh options.
			add_action( 'after_setup_theme', array( $this, 'refresh' ) );
		}

		/**
		 * Set default option values.
		 *
		 * @since  1.0.0
		 * @return array Default values.
		 */
		public function get_defaults() {

			$defaults = array(

				/**
				 * General Settings.
				 */

				// Layout.
				'prisma_core_site_layout'                      => 'fw-contained',
				'prisma_core_container_width'                  => 1200,

				// Base Colors.
				'prisma_core_accent_color'                     => '#3857F1',
				'prisma_core_content_text_color'               => '#30373e',
				'prisma_core_headings_color'                   => '#23282d',
				'prisma_core_content_link_hover_color'         => '#23282d',
				'prisma_core_body_background_heading'          => true,
				'prisma_core_content_background_heading'       => true,
				'prisma_core_boxed_content_background_color'   => '#FFFFFF',
				'prisma_core_scroll_top_visibility'            => 'all',

				// Base Typography.
				'prisma_core_html_base_font_size'              => array(
					'desktop' => 16,
				),
				'prisma_core_font_smoothing'                   => true,
				'prisma_core_typography_body_heading'          => false,
				'prisma_core_typography_headings_heading'      => false,
				'prisma_core_body_font'                        => prisma_core_typography_defaults(
					array(
						'font-family'         => 'default',
						'font-weight'         => 400,
						'font-size-desktop'   => '0.9375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.733',
					)
				),
				'prisma_core_headings_font'                    => prisma_core_typography_defaults(
					array(
						'font-weight'     => 500,
						'font-style'      => 'normal',
						'text-transform'  => 'none',
						'text-decoration' => 'none',
					)
				),
				'prisma_core_h1_font'                          => prisma_core_typography_defaults(
					array(
						'font-weight'         => 600,
						'font-size-desktop'   => '2.375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.1',
					)
				),
				'prisma_core_h2_font'                          => prisma_core_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '1.875',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.25',
					)
				),
				'prisma_core_h3_font'                          => prisma_core_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '1.625',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.25',
					)
				),
				'prisma_core_h4_font'                          => prisma_core_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '1.25',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.5',
					)
				),
				'prisma_core_h5_font'                          => prisma_core_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '1',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.5',
					)
				),
				'prisma_core_h6_font'                          => prisma_core_typography_defaults(
					array(
						'font-weight'         => 'inherit',
						'font-size-desktop'   => '0.6875',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.72',
						'text-transform'      => 'uppercase',
						'letter-spacing'      => '2',
					)
				),
				'prisma_core_heading_em_font'                  => prisma_core_typography_defaults(
					array(
						'font-weight' => 'inherit',
						'font-style'  => 'italic',
					)
				),
				'prisma_core_footer_widget_title_font_size'    => array(
					'desktop' => 1.125,
					'unit'    => 'em',
				),

				// Primary Button.
				'prisma_core_primary_button_heading'           => false,
				'prisma_core_primary_button_bg_color'          => '',
				'prisma_core_primary_button_hover_bg_color'    => '',
				'prisma_core_primary_button_text_color'        => '#FFFFFF',
				'prisma_core_primary_button_hover_text_color'  => '#FFFFFF',
				'prisma_core_primary_button_border_radius'     => array(
					'top-left'     => 2,
					'top-right'    => 2,
					'bottom-right' => 2,
					'bottom-left'  => 2,
					'unit'         => 'px',
				),
				'prisma_core_primary_button_border_width'      => 1,
				'prisma_core_primary_button_border_color'      => 'rgba(0, 0, 0, 0.12)',
				'prisma_core_primary_button_hover_border_color' => 'rgba(0, 0, 0, 0.12)',
				'prisma_core_primary_button_typography'        => prisma_core_typography_defaults(
					array(
						'font-family'         => 'inherit',
						'font-weight'         => 500,
						'font-size-desktop'   => '0.9375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.4',
					)
				),

				// Secondary Button.
				'prisma_core_secondary_button_heading'         => false,
				'prisma_core_secondary_button_bg_color'        => '#23282d',
				'prisma_core_secondary_button_hover_bg_color'  => '#3e4750',
				'prisma_core_secondary_button_text_color'      => '#FFFFFF',
				'prisma_core_secondary_button_hover_text_color' => '#FFFFFF',
				'prisma_core_secondary_button_border_radius'   => array(
					'top-left'     => 2,
					'top-right'    => 2,
					'bottom-right' => 2,
					'bottom-left'  => 2,
					'unit'         => 'px',
				),
				'prisma_core_secondary_button_border_width'    => 1,
				'prisma_core_secondary_button_border_color'    => 'rgba(0, 0, 0, 0.12)',
				'prisma_core_secondary_button_hover_border_color' => 'rgba(0, 0, 0, 0.12)',
				'prisma_core_secondary_button_typography'      => prisma_core_typography_defaults(
					array(
						'font-family'         => 'inherit',
						'font-weight'         => 500,
						'font-size-desktop'   => '0.9375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.4',
					)
				),

				// Text button.
				'prisma_core_text_button_heading'              => false,
				'prisma_core_text_button_text_color'           => '#23282d',
				'prisma_core_text_button_hover_text_color'     => '',
				'prisma_core_text_button_typography'           => prisma_core_typography_defaults(
					array(
						'font-family'         => 'inherit',
						'font-weight'         => 500,
						'font-size-desktop'   => '0.9375',
						'font-size-unit'      => 'rem',
						'line-height-desktop' => '1.4',
					)
				),

				// Misc Settings.
				'prisma_core_enable_schema'                    => true,
				'prisma_core_custom_input_style'               => true,
				'prisma_core_preloader_heading'                => false,
				'prisma_core_preloader'                        => false,
				'prisma_core_preloader_style'                  => '1',
				'prisma_core_preloader_visibility'             => 'all',
				'prisma_core_scroll_top_heading'               => false,
				'prisma_core_enable_scroll_top'                => true,

				/**
				 * Logos & Site Title.
				 */
				'prisma_core_logo_default_retina'              => '',
				'prisma_core_logo_max_height'                  => array(
					'desktop' => 30,
				),
				'prisma_core_logo_margin'                      => array(
					'desktop' => array(
						'top'    => 25,
						'right'  => 0,
						'bottom' => 25,
						'left'   => 0,
					),
					'tablet'  => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'mobile'  => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'unit'    => 'px',
				),
				'prisma_core_display_tagline'                  => false,
				'prisma_core_logo_heading_site_identity'       => true,
				'prisma_core_typography_logo_heading'          => false,
				'prisma_core_logo_text_font_size'              => array(
					'desktop' => 1.875,
					'unit'    => 'rem',
				),

				/**
				 * Header.
				 */

				// Top Bar.
				'prisma_core_top_bar_enable'                   => false,
				'prisma_core_top_bar_container_width'          => 'content-width',
				'prisma_core_top_bar_visibility'               => 'hide-mobile-tablet',
				'prisma_core_top_bar_heading_widgets'          => true,
				'prisma_core_top_bar_widgets'                  => array(
					array(
						'classname' => 'prisma_core_customizer_widget_text',
						'type'      => 'text',
						'values'    => array(
							'content'    => esc_html__( 'This is a placeholder text widget in Top Bar section.', 'prisma-core' ),
							'location'   => 'left',
							'visibility' => 'all',
						),
					),
				),
				'prisma_core_top_bar_widgets_separator'        => 'regular',
				'prisma_core_top_bar_heading_design_options'   => false,
				'prisma_core_top_bar_background'               => prisma_core_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(
								'background-color' => '#FFFFFF',
							),
							'gradient' => array(),
						),
					)
				),
				'prisma_core_top_bar_text_color'               => prisma_core_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'prisma_core_top_bar_border'                   => prisma_core_design_options_defaults(
					array(
						'border' => array(
							'border-bottom-width' => '1',
							'border-style'        => 'solid',
							'border-color'        => 'rgba(0,0,0, .085)',
							'separator-color'     => '#cccccc',
						),
					)
				),

				// Main Header.
				'prisma_core_header_layout'                    => 'layout-1',
				'prisma_core_header_container_width'           => 'content-width',
				'prisma_core_header_heading_widgets'           => true,
				'prisma_core_header_widgets'                   => array(
					array(
						'classname' => 'prisma_core_customizer_widget_search',
						'type'      => 'search',
						'values'    => array(
							'location'   => 'left',
							'visibility' => 'hide-mobile-tablet',
						),
					),
				),
				'prisma_core_header_widgets_separator'         => 'none',
				'prisma_core_header_heading_design_options'    => false,
				'prisma_core_header_background'                => prisma_core_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(
								'background-color' => '#FFFFFF',
							),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'prisma_core_header_border'                    => prisma_core_design_options_defaults(
					array(
						'border' => array(
							'border-bottom-width' => 1,
							'border-color'        => 'rgba(0,0,0, .085)',
							'separator-color'     => '#cccccc',
						),
					)
				),
				'prisma_core_header_text_color'                => prisma_core_design_options_defaults(
					array(
						'color' => array(
							'text-color' => '#66717f',
							'link-color' => '#23282d',
						),
					)
				),

				// Transparent Header.
				'prisma_core_tsp_header'                       => false,
				'prisma_core_tsp_header_disable_on'            => array(
					'404',
					'posts_page',
					'archive',
					'search',
				),
				'prisma_core_tsp_logo_heading'                 => false,
				'prisma_core_tsp_logo'                         => '',
				'prisma_core_tsp_logo_retina'                  => '',
				'prisma_core_tsp_logo_max_height'              => array(
					'desktop' => 30,
				),
				'prisma_core_tsp_logo_margin'                  => array(
					'desktop' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'tablet'  => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'mobile'  => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'unit'    => 'px',
				),
				'prisma_core_tsp_colors_heading'               => false,
				'prisma_core_tsp_header_background'            => prisma_core_design_options_defaults(
					array(
						'background' => array(
							'color' => array(),
						),
					)
				),
				'prisma_core_tsp_header_font_color'            => prisma_core_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'prisma_core_tsp_header_border'                => prisma_core_design_options_defaults(
					array(
						'border' => array(),
					)
				),

				// Sticky Header.
				'prisma_core_sticky_header'                    => false,
				'prisma_core_sticky_header_hide_on'            => array( '' ),

				// Main Navigation.
				'prisma_core_main_nav_heading_animation'       => false,
				'prisma_core_main_nav_hover_animation'         => 'underline',
				'prisma_core_main_nav_heading_sub_menus'       => false,
				'prisma_core_main_nav_sub_indicators'          => true,
				'prisma_core_main_nav_heading_mobile_menu'     => false,
				'prisma_core_main_nav_mobile_breakpoint'       => 960,
				'prisma_core_main_nav_mobile_label'            => '',
				'prisma_core_nav_design_options'               => false,
				'prisma_core_main_nav_background'              => prisma_core_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(
								'background-color' => '#FFFFFF',
							),
							'gradient' => array(),
						),
					)
				),
				'prisma_core_main_nav_border'                  => prisma_core_design_options_defaults(
					array(
						'border' => array(
							'border-top-width'    => 1,
							'border-bottom-width' => 1,
							'border-style'        => 'solid',
							'border-color'        => 'rgba(0,0,0, .085)',
						),
					)
				),
				'prisma_core_main_nav_font_color'              => prisma_core_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'prisma_core_typography_main_nav_heading'      => false,
				'prisma_core_main_nav_font_size'               => array(
					'value' => 0.9375,
					'unit'  => 'rem',
				),

				// Page Header.
				'prisma_core_page_header_enable'               => true,
				'prisma_core_page_header_alignment'            => 'left',
				'prisma_core_page_header_spacing'              => array(
					'desktop' => array(
						'top'    => 30,
						'bottom' => 30,
					),
					'tablet'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'mobile'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'unit'    => 'px',
				),
				'prisma_core_page_header_background'           => prisma_core_design_options_defaults(
					array(
						'background' => array(
							'color'    => array( 'background-color' => 'rgba(0,0,0,.025)' ),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'prisma_core_page_header_text_color'           => prisma_core_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'prisma_core_page_header_border'               => prisma_core_design_options_defaults(
					array(
						'border' => array(
							'border-bottom-width' => 1,
							'border-style'        => 'solid',
							'border-color'        => 'rgba(0,0,0,.062)',
						),
					)
				),
				'prisma_core_typography_page_header'           => false,
				'prisma_core_page_header_font_size'            => array(
					'desktop' => 1.625,
					'unit'    => 'rem',
				),

				// Breadcrumbs.
				'prisma_core_breadcrumbs_enable'               => true,
				'prisma_core_breadcrumbs_hide_on'              => array( 'home' ),
				'prisma_core_breadcrumbs_position'             => 'in-page-header',
				'prisma_core_breadcrumbs_alignment'            => 'left',
				'prisma_core_breadcrumbs_spacing'              => array(
					'desktop' => array(
						'top'    => 15,
						'bottom' => 15,
					),
					'tablet'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'mobile'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'unit'    => 'px',
				),
				'prisma_core_breadcrumbs_heading_design'       => false,
				'prisma_core_breadcrumbs_background'           => prisma_core_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'prisma_core_breadcrumbs_text_color'           => prisma_core_design_options_defaults(
					array(
						'color' => array(),
					)
				),
				'prisma_core_breadcrumbs_border'               => prisma_core_design_options_defaults(
					array(
						'border' => array(
							'border-top-width'    => 0,
							'border-bottom-width' => 0,
							'border-color'        => '',
							'border-style'        => 'solid',
						),
					)
				),

				/**
				 * Hero.
				 */
				'prisma_core_enable_hero'                      => false,
				'prisma_core_hero_type'                        => 'hover-slider',
				'prisma_core_hero_visibility'                  => 'all',
				'prisma_core_hero_enable_on'                   => array( 'home' ),
				'prisma_core_hero_hover_slider'                => false,
				'prisma_core_hero_hover_slider_container'      => 'content-width',
				'prisma_core_hero_hover_slider_height'         => 500,
				'prisma_core_hero_hover_slider_overlay'        => '1',
				'prisma_core_hero_hover_slider_elements'       => array(
					'category'  => true,
					'meta'      => true,
					'read_more' => true,
				),
				'prisma_core_hero_hover_slider_posts'          => false,
				'prisma_core_hero_hover_slider_post_number'    => 3,
				'prisma_core_hero_hover_slider_category'       => array(),

				/**
				 * Blog.
				 */

				// Blog Page / Archive.
				'prisma_core_blog_entry_elements'              => array(
					'thumbnail'      => true,
					'header'         => true,
					'meta'           => true,
					'summary'        => true,
					'summary-footer' => true,
				),
				'prisma_core_blog_entry_meta_elements'         => array(
					'author'   => true,
					'date'     => true,
					'category' => true,
					'tag'      => false,
					'comments' => true,
				),
				'prisma_core_entry_meta_icons'                 => false,
				'prisma_core_excerpt_length'                   => 30,
				'prisma_core_excerpt_more'                     => '&hellip;',
				'prisma_core_blog_layout'                      => 'blog-layout-1',
				'prisma_core_blog_image_position'              => 'left',
				'prisma_core_blog_image_size'                  => 'large',
				'prisma_core_blog_horizontal_post_categories'  => true,
				'prisma_core_blog_horizontal_read_more'        => false,

				// Single Post.
				'prisma_core_single_post_layout_heading'       => false,
				'prisma_core_single_title_position'            => 'in-content',
				'prisma_core_single_title_alignment'           => 'left',
				'prisma_core_single_title_spacing'             => array(
					'desktop' => array(
						'top'    => 152,
						'bottom' => 100,
					),
					'tablet'  => array(
						'top'    => 90,
						'bottom' => 55,
					),
					'mobile'  => array(
						'top'    => '',
						'bottom' => '',
					),
					'unit'    => 'px',
				),
				'prisma_core_single_content_width'             => 'narrow',
				'prisma_core_single_narrow_container_width'    => 700,
				'prisma_core_single_post_elements_heading'     => false,
				'prisma_core_single_post_meta_elements'        => array(
					'author'   => true,
					'date'     => true,
					'comments' => true,
					'category' => false,
				),
				'prisma_core_single_post_thumb'                => true,
				'prisma_core_single_post_categories'           => true,
				'prisma_core_single_post_tags'                 => true,
				'prisma_core_single_last_updated'              => true,
				'prisma_core_single_about_author'              => true,
				'prisma_core_single_post_next_prev'            => true,
				'prisma_core_single_post_elements'             => array(
					'thumb'          => true,
					'category'       => true,
					'tags'           => true,
					'last-updated'   => true,
					'about-author'   => true,
					'prev-next-post' => true,
				),
				'prisma_core_single_toggle_comments'           => false,
				'prisma_core_single_entry_meta_icons'          => false,
				'prisma_core_typography_single_post_heading'   => false,
				'prisma_core_single_content_font_size'         => array(
					'desktop' => '1',
					'unit'    => 'rem',
				),

				/**
				 * Sidebar.
				 */

				'prisma_core_sidebar_position'                 => 'right-sidebar',
				'prisma_core_single_post_sidebar_position'     => 'no-sidebar',
				'prisma_core_single_page_sidebar_position'     => 'default',
				'prisma_core_archive_sidebar_position'         => 'default',
				'prisma_core_sidebar_options_heading'          => false,
				'prisma_core_sidebar_style'                    => '1',
				'prisma_core_sidebar_width'                    => 25,
				'prisma_core_sidebar_sticky'                   => '',
				'prisma_core_sidebar_responsive_position'      => 'after-content',
				'prisma_core_typography_sidebar_heading'       => false,
				'prisma_core_sidebar_widget_title_font_size'   => array(
					'desktop' => 1,
					'unit'    => 'rem',
				),

				/**
				 * Footer.
				 */

				// Pre Footer.
				'prisma_core_pre_footer_cta'                   => true,
				'prisma_core_enable_pre_footer_cta'            => false,
				'prisma_core_pre_footer_cta_visibility'        => 'all',
				'prisma_core_pre_footer_cta_hide_on'           => array(),
				'prisma_core_pre_footer_cta_style'             => '1',
				'prisma_core_pre_footer_cta_text'              => wp_kses_post( __( 'This is an example of <em>Pre Footer</em> section in Prisma Core.', 'prisma-core' ) ),
				'prisma_core_pre_footer_cta_btn_text'          => wp_kses_post( __( 'Example Button', 'prisma-core' ) ),
				'prisma_core_pre_footer_cta_btn_url'           => '#',
				'prisma_core_pre_footer_cta_btn_new_tab'       => false,
				'prisma_core_pre_footer_cta_design_options'    => false,
				'prisma_core_pre_footer_cta_background'        => prisma_core_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'prisma_core_pre_footer_cta_border'            => prisma_core_design_options_defaults(
					array(
						'border' => array(),
					)
				),
				'prisma_core_pre_footer_cta_text_color'        => prisma_core_design_options_defaults(
					array(
						'color' => array(
							'text-color' => '#FFFFFF',
						),
					)
				),
				'prisma_core_pre_footer_cta_typography'        => false,
				'prisma_core_pre_footer_cta_font_size'         => array(
					'desktop' => 1.75,
					'unit'    => 'rem',
				),

				// Copyright.
				'prisma_core_enable_copyright'                 => true,
				'prisma_core_copyright_layout'                 => 'layout-1',
				'prisma_core_copyright_separator'              => 'contained-separator',
				'prisma_core_copyright_visibility'             => 'all',
				'prisma_core_copyright_heading_widgets'        => true,
				'prisma_core_copyright_widgets'                => array(
					array(
						'classname' => 'prisma_core_customizer_widget_text',
						'type'      => 'text',
						'values'    => array(
							'content'    => esc_html__( 'Copyright {{the_year}} &mdash; {{site_title}}. All rights reserved. {{theme_link}}', 'prisma-core' ),
							'location'   => 'start',
							'visibility' => 'all',
						),
					),
				),
				'prisma_core_copyright_heading_design_options' => false,
				'prisma_core_copyright_background'             => prisma_core_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(),
							'gradient' => array(),
						),
					)
				),
				'prisma_core_copyright_text_color'             => prisma_core_design_options_defaults(
					array(
						'color' => array(
							'text-color'       => '',
							'link-color'       => '',
							'link-hover-color' => '#FFFFFF',
						),
					)
				),

				// Main Footer.
				'prisma_core_enable_footer'                    => true,
				'prisma_core_footer_layout'                    => 'layout-1',
				'prisma_core_footer_widgets_align_center'      => false,
				'prisma_core_footer_visibility'                => 'all',
				'prisma_core_footer_heading_design_options'    => false,
				'prisma_core_footer_background'                => prisma_core_design_options_defaults(
					array(
						'background' => array(
							'color'    => array(
								'background-color' => '#23282d',
							),
							'gradient' => array(),
							'image'    => array(),
						),
					)
				),
				'prisma_core_footer_text_color'                => prisma_core_design_options_defaults(
					array(
						'color' => array(
							'text-color'         => '#9BA1A7',
							'link-color'         => '',
							'link-hover-color'   => '#FFFFFF',
							'widget-title-color' => '#FFFFFF',
						),
					)
				),
				'prisma_core_footer_border'                    => prisma_core_design_options_defaults(
					array(
						'border' => array(),
					)
				),
				'prisma_core_typography_main_footer_heading'   => false,
			);

			$defaults = apply_filters( 'prisma_core_default_option_values', $defaults );

			return $defaults;
		}

		/**
		 * Get the options from static array()
		 *
		 * @since  1.0.0
		 * @return array    Return array of theme options.
		 */
		public function get_options() {
			return self::$options;
		}

		/**
		 * Get the options from static array()
		 *
		 * @since  1.0.0
		 * @return array    Return array of theme options.
		 */
		public function get( $id ) {
			$value = isset( self::$options[ $id ] ) ? self::$options[ $id ] : self::get_default( $id );
			$value = apply_filters( "theme_mod_{$id}", $value ); // phpcs:ignore
			return $value;
		}

		/**
		 * Set option.
		 *
		 * @since  1.0.0
		 */
		public function set( $id, $value ) {
			set_theme_mod( $id, $value );
			self::$options[ $id ] = $value;
		}

		/**
		 * Refresh options.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function refresh() {
			self::$options = wp_parse_args(
				get_theme_mods(),
				self::get_defaults()
			);
		}

		/**
		 * Returns the default value for option.
		 *
		 * @since  1.0.0
		 * @param  string $id Option ID.
		 * @return mixed      Default option value.
		 */
		public function get_default( $id ) {
			$defaults = self::get_defaults();
			return isset( $defaults[ $id ] ) ? $defaults[ $id ] : false;
		}
	}

endif;
