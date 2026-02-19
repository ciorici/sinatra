<?php
/**
 * Prisma Core Blog - Single Post section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Single_Post' ) ) :
	/**
	 * Prisma Core Blog - Single Post section in Customizer.
	 */
	class Prisma_Core_Customizer_Single_Post {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Registers our custom options in Customizer.
			 */
			add_filter( 'prisma_core_customizer_options', array( $this, 'register_options' ) );
		}

		/**
		 * Registers our custom options in Customizer.
		 *
		 * @since 1.0.0
		 * @param array $options Array of customizer options.
		 */
		public function register_options( $options ) {

			// Section.
			$options['section']['prisma_core_section_blog_single_post'] = array(
				'title'    => esc_html__( 'Single Post', 'prisma-core' ),
				'panel'    => 'prisma_core_panel_blog',
				'priority' => 20,
			);

			// Single post layout.
			$options['setting']['prisma_core_single_post_layout_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Layout', 'prisma-core' ),
					'section' => 'prisma_core_section_blog_single_post',
				),
			);

			// Content Layout.
			$options['setting']['prisma_core_single_title_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Title Position', 'prisma-core' ),
					'description' => esc_html__( 'Select title position for single post pages.', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_single_post',
					'choices'     => array(
						'in-content'     => esc_html__( 'In Content', 'prisma-core' ),
						'in-page-header' => esc_html__( 'In Page Header', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Alignment.
			$options['setting']['prisma_core_single_title_alignment'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'     => 'prisma-core-alignment',
					'label'    => esc_html__( 'Title Alignment', 'prisma-core' ),
					'section'  => 'prisma_core_section_blog_single_post',
					'choices'  => 'horizontal',
					'icons'    => array(
						'left'   => 'dashicons dashicons-editor-alignleft',
						'center' => 'dashicons dashicons-editor-aligncenter',
						'right'  => 'dashicons dashicons-editor-alignright',
					),
					'required' => array(
						array(
							'control'  => 'prisma_core_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Spacing.
			$options['setting']['prisma_core_single_title_spacing'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'        => 'prisma-core-spacing',
					'label'       => esc_html__( 'Title Spacing', 'prisma-core' ),
					'description' => esc_html__( 'Specify title top and bottom padding.', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_single_post',
					'choices'     => array(
						'top'    => esc_html__( 'Top', 'prisma-core' ),
						'bottom' => esc_html__( 'Bottom', 'prisma-core' ),
					),
					'responsive'  => true,
					'unit'        => array(
						'px',
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_single_title_position',
							'value'    => 'in-page-header',
							'operator' => '==',
						),
					),
				),
			);

			// Content width.
			$options['setting']['prisma_core_single_content_width'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Content Width', 'prisma-core' ),
					'description' => esc_html__( 'Narrow content width or match your site&rsquo;s Content Width (defined in General Settings &raquo; Layout).', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_single_post',
					'choices'     => array(
						'wide'   => esc_html__( 'Content Width', 'prisma-core' ),
						'narrow' => esc_html__( 'Narrow Width', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Narrow container width.
			$options['setting']['prisma_core_single_narrow_container_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_range',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Narrow Container Width', 'prisma-core' ),
					'description' => esc_html__( 'Choose the width (in px) for narrow container on single posts.', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_single_post',
					'min'         => 500,
					'max'         => 1500,
					'step'        => 10,
					'required'    => array(
						array(
							'control'  => 'prisma_core_single_content_width',
							'value'    => 'narrow',
							'operator' => '==',
						),
						array(
							'control'  => 'prisma_core_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Single post elements.
			$options['setting']['prisma_core_single_post_elements_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Post Elements', 'prisma-core' ),
					'section' => 'prisma_core_section_blog_single_post',
				),
			);

			$options['setting']['prisma_core_single_post_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_sortable',
				'control'           => array(
					'type'        => 'prisma-core-sortable',
					'section'     => 'prisma_core_section_blog_single_post',
					'label'       => esc_html__( 'Post Elements', 'prisma-core' ),
					'description' => esc_html__( 'Set visibility of post elements.', 'prisma-core' ),
					'sortable'    => false,
					'choices'     => array(
						'thumb'          => esc_html__( 'Featured Image', 'prisma-core' ),
						'category'       => esc_html__( 'Post Categories', 'prisma-core' ),
						'tags'           => esc_html__( 'Post Tags', 'prisma-core' ),
						'last-updated'   => esc_html__( 'Last Updated Date', 'prisma-core' ),
						'about-author'   => esc_html__( 'About Author Box', 'prisma-core' ),
						'prev-next-post' => esc_html__( 'Next/Prev Post Links', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Meta/Post Details Layout.
			$options['setting']['prisma_core_single_post_meta_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_sortable',
				'control'           => array(
					'type'        => 'prisma-core-sortable',
					'label'       => esc_html__( 'Post Meta', 'prisma-core' ),
					'description' => esc_html__( 'Set order and visibility for post meta details.', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_single_post',
					'choices'     => array(
						'author'   => esc_html__( 'Author', 'prisma-core' ),
						'date'     => esc_html__( 'Publish Date', 'prisma-core' ),
						'comments' => esc_html__( 'Comments', 'prisma-core' ),
						'category' => esc_html__( 'Categories', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Meta icons.
			$options['setting']['prisma_core_single_entry_meta_icons'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'     => 'prisma-core-toggle',
					'section'  => 'prisma_core_section_blog_single_post',
					'label'    => esc_html__( 'Show avatar and icons in post meta', 'prisma-core' ),
					'required' => array(
						array(
							'control'  => 'prisma_core_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Toggle Comments.
			$options['setting']['prisma_core_single_toggle_comments'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Show Toggle Comments', 'prisma-core' ),
					'description' => esc_html__( 'Hide comments and comment form behind a toggle button. ', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_single_post',
					'required'    => array(
						array(
							'control'  => 'prisma_core_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Single Post typography heading.
			$options['setting']['prisma_core_typography_single_post_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-heading',
					'label'   => esc_html__( 'Typography', 'prisma-core' ),
					'section' => 'prisma_core_section_blog_single_post',
				),
			);

			// Single post content font size.
			$options['setting']['prisma_core_single_content_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_responsive',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Post Content Font Size', 'prisma-core' ),
					'description' => esc_html__( 'Choose your single post content font size.', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_single_post',
					'responsive'  => true,
					'unit'        => array(
						array(
							'id'   => 'px',
							'name' => 'px',
							'min'  => 8,
							'max'  => 30,
							'step' => 1,
						),
						array(
							'id'   => 'em',
							'name' => 'em',
							'min'  => 0.5,
							'max'  => 1.875,
							'step' => 0.01,
						),
						array(
							'id'   => 'rem',
							'name' => 'rem',
							'min'  => 0.5,
							'max'  => 1.875,
							'step' => 0.01,
						),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_typography_single_post_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Prisma_Core_Customizer_Single_Post();
