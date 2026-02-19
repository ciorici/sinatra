<?php
/**
 * Prisma Core Blog » Blog Page / Archive section in Customizer.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Blog_Page' ) ) :
	/**
	 * Prisma Core Blog » Blog Page / Archive section in Customizer.
	 */
	class Prisma_Core_Customizer_Blog_Page {

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
			$options['section']['prisma_core_section_blog_page'] = array(
				'title' => esc_html__( 'Blog Page / Archive', 'prisma-core' ),
				'panel' => 'prisma_core_panel_blog',
			);

			// Layout.
			$options['setting']['prisma_core_blog_layout'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Layout', 'prisma-core' ),
					'description' => esc_html__( 'Choose blog layout. This will affect blog layout on archives, search results and posts page.', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_page',
					'choices'     => array(
						'blog-layout-1'   => esc_html__( 'Vertical', 'prisma-core' ),
						'blog-horizontal' => esc_html__( 'Horizontal', 'prisma-core' ),
					),
				),
			);

			$_image_sizes = prisma_core_get_image_sizes();
			$size_choices = array();

			if ( ! empty( $_image_sizes ) ) {
				foreach ( $_image_sizes as $key => $value ) {
					$name = ucwords( str_replace( array( '-', '_' ), ' ', $key ) );

					$size_choices[ $key ] = $name;

					if ( $value['width'] || $value['height'] ) {
						$size_choices[ $key ] .= ' (' . $value['width'] . 'x' . $value['height'] . ')';
					}
				}
			}

			// Featured Image Size.
			$options['setting']['prisma_core_blog_image_size'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Featured Image Size', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_page',
					'choices'     => $size_choices,
				),
			);

			// Post Elements.
			$options['setting']['prisma_core_blog_entry_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_sortable',
				'control'           => array(
					'type'        => 'prisma-core-sortable',
					'section'     => 'prisma_core_section_blog_page',
					'label'       => esc_html__( 'Post Elements', 'prisma-core' ),
					'description' => esc_html__( 'Set order and visibility for post elements.', 'prisma-core' ),
					'choices'     => array(
						'summary'        => esc_html__( 'Summary', 'prisma-core' ),
						'header'         => esc_html__( 'Title', 'prisma-core' ),
						'meta'           => esc_html__( 'Post Meta', 'prisma-core' ),
						'thumbnail'      => esc_html__( 'Featured Image', 'prisma-core' ),
						'summary-footer' => esc_html__( 'Read More', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_blog_layout',
							'value'    => 'blog-layout-1',
							'operator' => '==',
						),
					),
				),
			);

			// Meta/Post Details Layout.
			$options['setting']['prisma_core_blog_entry_meta_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_sortable',
				'control'           => array(
					'type'        => 'prisma-core-sortable',
					'section'     => 'prisma_core_section_blog_page',
					'label'       => esc_html__( 'Post Meta', 'prisma-core' ),
					'description' => esc_html__( 'Set order and visibility for post meta details.', 'prisma-core' ),
					'choices'     => array(
						'author'   => esc_html__( 'Author', 'prisma-core' ),
						'date'     => esc_html__( 'Publish Date', 'prisma-core' ),
						'comments' => esc_html__( 'Comments', 'prisma-core' ),
						'category' => esc_html__( 'Categories', 'prisma-core' ),
						'tag'      => esc_html__( 'Tags', 'prisma-core' ),
					),
				),
			);

			// Post Categories.
			$options['setting']['prisma_core_blog_horizontal_post_categories'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Show Post Categories', 'prisma-core' ),
					'description' => esc_html__( 'A list of categories the post belongs to. Displayed above post title.', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_page',
					'required'    => array(
						array(
							'control'  => 'prisma_core_blog_layout',
							'value'    => 'blog-horizontal',
							'operator' => '==',
						),
					),
				),
			);

			// Read More Button.
			$options['setting']['prisma_core_blog_horizontal_read_more'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Show Read More Button', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_page',
					'required'    => array(
						array(
							'control'  => 'prisma_core_blog_layout',
							'value'    => 'blog-horizontal',
							'operator' => '==',
						),
					),
				),
			);

			// Meta Author image.
			$options['setting']['prisma_core_entry_meta_icons'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'    => 'prisma-core-toggle',
					'section' => 'prisma_core_section_blog_page',
					'label'   => esc_html__( 'Show avatar and icons in post meta', 'prisma-core' ),
				),
			);

			// Featured Image Position.
			$options['setting']['prisma_core_blog_image_position'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'Featured Image Position', 'prisma-core' ),
					'section'     => 'prisma_core_section_blog_page',
					'choices'     => array(
						'left'  => esc_html__( 'Left', 'prisma-core' ),
						'right' => esc_html__( 'Right', 'prisma-core' ),
					),
					'required'    => array(
						array(
							'control'  => 'prisma_core_blog_layout',
							'value'    => 'blog-horizontal',
							'operator' => '==',
						),
					),
				),
			);

			// Excerpt Length.
			$options['setting']['prisma_core_excerpt_length'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_range',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'section'     => 'prisma_core_section_blog_page',
					'label'       => esc_html__( 'Excerpt Length', 'prisma-core' ),
					'description' => esc_html__( 'Number of words displayed in the excerpt.', 'prisma-core' ),
					'min'         => 0,
					'max'         => 100,
					'step'        => 1,
					'unit'        => '',
					'responsive'  => false,
				),
			);

			// Excerpt more.
			$options['setting']['prisma_core_excerpt_more'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'prisma-core-text',
					'section'     => 'prisma_core_section_blog_page',
					'label'       => esc_html__( 'Excerpt More', 'prisma-core' ),
					'description' => esc_html__( 'What to append to excerpt if the text is cut.', 'prisma-core' ),
				),
			);

			return $options;
		}
	}
endif;

new Prisma_Core_Customizer_Blog_Page();
