<?php
/**
 * Prisma Core WooCommerce section in Customizer.
 *
 * @package Prisma Core
 * @author  Prisma Core Team
 * @since   1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Prisma_Core_Customizer_WooCommerce' ) ) :
	/**
	 * Prisma Core WooCommerce section in Customizer.
	 */
	class Prisma_Core_Customizer_WooCommerce {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Registers our custom options in Customizer.
			add_filter( 'prisma_core_customizer_options', array( $this, 'register_options' ), 20 );
			add_action( 'customize_register', array( $this, 'customizer_tweak' ), 20 );

			// Add default values for WooCommerce options.
			add_filter( 'prisma_core_default_option_values', array( $this, 'default_customizer_values' ) );

			// Add localized strings to script.
			add_filter( 'prisma_core_customizer_localized', array( $this, 'customizer_localized_strings' ) );
		}

		/**
		 * Add defaults for new WooCommerce customizer options.
		 *
		 * @param  array $defaults Array of default values.
		 * @return array           Array of default values.
		 */
		public function default_customizer_values( $defaults ) {

			$defaults['prisma_core_wc_product_gallery_lightbox'] = true;
			$defaults['prisma_core_wc_product_gallery_zoom']     = true;
			$defaults['prisma_core_shop_product_hover']          = 'none';
			$defaults['prisma_core_product_sale_badge']          = 'percentage';
			$defaults['prisma_core_product_sale_badge_text']     = esc_html__( 'Sale!', 'prisma-core' );
			$defaults['prisma_core_wc_product_slider_arrows']    = true;
			$defaults['prisma_core_wc_product_gallery_style']    = 'default';
			$defaults['prisma_core_wc_product_sidebar_position'] = 'no-sidebar';
			$defaults['prisma_core_wc_sidebar_position']         = 'no-sidebar';
			$defaults['prisma_core_wc_upsell_products']          = true;
			$defaults['prisma_core_wc_upsells_columns']          = 4;
			$defaults['prisma_core_wc_upsells_rows']             = 1;
			$defaults['prisma_core_wc_related_products']         = true;
			$defaults['prisma_core_wc_related_columns']          = 4;
			$defaults['prisma_core_wc_related_rows']             = 1;
			$defaults['prisma_core_wc_cross_sell_products']      = true;
			$defaults['prisma_core_wc_cross_sell_rows']          = 1;
			$defaults['prisma_core_product_catalog_elements']    = array(
				'category' => true,
				'title'    => true,
				'ratings'  => true,
				'price'    => true,
			);

			return $defaults;
		}

		/**
		 * Tweak Customizer.
		 *
		 * @since 1.0.0
		 * @param WP_Customize_Manager $customizer Instance of WP_Customize_Manager class.
		 */
		public function customizer_tweak( $customizer ) {
			// Move WooCommerce panel.
			$customizer->get_panel( 'woocommerce' )->priority = 10;

			return $customizer;
		}

		/**
		 * Registers our custom options in Customizer.
		 *
		 * @since 1.0.0
		 * @param array $options Array of customizer options.
		 */
		public function register_options( $options ) {

			// Shop image hover effect.
			$options['setting']['prisma_core_shop_product_hover'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'section'     => 'woocommerce_product_catalog',
					'label'       => esc_html__( 'Product image hover', 'prisma-core' ),
					'description' => esc_html__( 'Effect for product image on hover', 'prisma-core' ),
					'choices'     => array(
						'none'       => esc_html__( 'No Effect', 'prisma-core' ),
						'image-swap' => esc_html__( 'Image Swap', 'prisma-core' ),
					),
				),
			);

			// Sale badge.
			$options['setting']['prisma_core_product_sale_badge'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'section'     => 'woocommerce_product_catalog',
					'label'       => esc_html__( 'Product sale badge', 'prisma-core' ),
					'description' => esc_html__( 'Choose what to display on the product sale badge.', 'prisma-core' ),
					'choices'     => array(
						'hide'       => esc_html__( 'Hide badge', 'prisma-core' ),
						'percentage' => esc_html__( 'Show percentage', 'prisma-core' ),
						'text'       => esc_html__( 'Show text', 'prisma-core' ),
					),
				),
			);

			// Sale badge text.
			$options['setting']['prisma_core_product_sale_badge_text'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'prisma-core-text',
					'label'       => esc_html__( 'Sale badge text', 'prisma-core' ),
					'description' => esc_html__( 'Add custom text for the product sale badge.', 'prisma-core' ),
					'placeholder' => esc_html__( 'Sale!', 'prisma-core' ),
					'section'     => 'woocommerce_product_catalog',
					'required'    => array(
						array(
							'control'  => 'prisma_core_product_sale_badge',
							'value'    => 'text',
							'operator' => '==',
						),
					),
				),
			);

			// Catalog product elements.
			$options['setting']['prisma_core_product_catalog_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_sortable',
				'control'           => array(
					'type'        => 'prisma-core-sortable',
					'section'     => 'woocommerce_product_catalog',
					'label'       => esc_html__( 'Product details', 'prisma-core' ),
					'description' => esc_html__( 'Set order and visibility for product details.', 'prisma-core' ),
					'choices'     => array(
						'title'    => esc_html__( 'Title', 'prisma-core' ),
						'ratings'  => esc_html__( 'Ratings', 'prisma-core' ),
						'price'    => esc_html__( 'Price', 'prisma-core' ),
						'category' => esc_html__( 'Category', 'prisma-core' ),
					),
				),
			);

			// Section.
			$options['section']['prisma_core_woocommerce_single_product'] = array(
				'title'    => esc_html__( 'Single Product', 'prisma-core' ),
				'priority' => 50,
				'panel'    => 'woocommerce',
			);

			// Product Gallery Zoom.
			$options['setting']['prisma_core_wc_product_gallery_zoom'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Gallery Zoom', 'prisma-core' ),
					'description' => esc_html__( 'Enable zoom effect when hovering product gallery.', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'space'       => true,
				),
			);

			// Product Gallery Lightbox.
			$options['setting']['prisma_core_wc_product_gallery_lightbox'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Gallery Lightbox', 'prisma-core' ),
					'description' => esc_html__( 'Open product gallery images in lightbox.', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'space'       => true,
				),
			);

			// Product slider arrows.
			$options['setting']['prisma_core_wc_product_slider_arrows'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Slider Arrows', 'prisma-core' ),
					'description' => esc_html__( 'Enable left and right arrows on product gallery slider.', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'space'       => true,
				),
			);

			// Related Products.
			$options['setting']['prisma_core_wc_related_products'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Related Products', 'prisma-core' ),
					'description' => esc_html__( 'Display related products.', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'space'       => true,
				),
			);

			// Related product column count.
			$options['setting']['prisma_core_wc_related_columns'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_range',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Related Products Columns', 'prisma-core' ),
					'description' => esc_html__( 'How many related products should be shown per row?', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'min'         => 1,
					'max'         => 6,
					'step'        => 1,
					'required'    => array(
						array(
							'control'  => 'prisma_core_wc_related_products',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Related product row count.
			$options['setting']['prisma_core_wc_related_rows'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_range',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Related Products Rows', 'prisma-core' ),
					'description' => esc_html__( 'How many rows of related products should be shown?', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'min'         => 1,
					'max'         => 5,
					'step'        => 1,
					'required'    => array(
						array(
							'control'  => 'prisma_core_wc_related_products',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Up-Sell Products.
			$options['setting']['prisma_core_wc_upsell_products'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Up-Sell Products', 'prisma-core' ),
					'description' => esc_html__( 'Display linked upsell products.', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'space'       => true,
				),
			);

			// Up-Sells column count.
			$options['setting']['prisma_core_wc_upsells_columns'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_range',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Up-Sell Products Columns', 'prisma-core' ),
					'description' => esc_html__( 'How many up-sell products should be shown per row?', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'min'         => 1,
					'max'         => 6,
					'step'        => 1,
					'required'    => array(
						array(
							'control'  => 'prisma_core_wc_upsell_products',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Up-Sells rows count.
			$options['setting']['prisma_core_wc_upsells_rows'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_range',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Up-Sell Products Rows', 'prisma-core' ),
					'description' => esc_html__( 'How many rows of up-sell products should be shown?', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'min'         => 1,
					'max'         => 6,
					'step'        => 1,
					'required'    => array(
						array(
							'control'  => 'prisma_core_wc_upsell_products',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Cross-Sell Products.
			$options['setting']['prisma_core_wc_cross_sell_products'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_toggle',
				'control'           => array(
					'type'        => 'prisma-core-toggle',
					'label'       => esc_html__( 'Cross-Sell Products', 'prisma-core' ),
					'description' => esc_html__( 'Display linked cross-sell products on cart page.', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'space'       => true,
				),
			);

			// Cross-Sells rows count.
			$options['setting']['prisma_core_wc_cross_sell_rows'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_range',
				'control'           => array(
					'type'        => 'prisma-core-range',
					'label'       => esc_html__( 'Cross-Sell Products Rows', 'prisma-core' ),
					'description' => esc_html__( 'How many rows of cross-sell products should be shown?', 'prisma-core' ),
					'section'     => 'prisma_core_woocommerce_single_product',
					'min'         => 1,
					'max'         => 6,
					'step'        => 1,
					'required'    => array(
						array(
							'control'  => 'prisma_core_wc_cross_sells_products',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			$sidebar_options = array();

			$sidebar_options['prisma_core_wc_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'WooCommerce', 'prisma-core' ),
					'description' => esc_html__( 'Choose default sidebar position for cart, checkout and catalog pages. You can change this setting per page via metabox settings.', 'prisma-core' ),
					'section'     => 'prisma_core_section_sidebar',
					'choices'     => array(
						'default'       => esc_html__( 'Default', 'prisma-core' ),
						'no-sidebar'    => esc_html__( 'No Sidebar', 'prisma-core' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'prisma-core' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'prisma-core' ),
					),
				),
			);

			$sidebar_options['prisma_core_wc_product_sidebar_position'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'prisma_core_sanitize_select',
				'control'           => array(
					'type'        => 'prisma-core-select',
					'label'       => esc_html__( 'WooCommerce - Single Product', 'prisma-core' ),
					'description' => esc_html__( 'Choose default sidebar position layout for product pages. You can change this setting per product via metabox settings.', 'prisma-core' ),
					'section'     => 'prisma_core_section_sidebar',
					'choices'     => array(
						'default'       => esc_html__( 'Default', 'prisma-core' ),
						'no-sidebar'    => esc_html__( 'No Sidebar', 'prisma-core' ),
						'left-sidebar'  => esc_html__( 'Left Sidebar', 'prisma-core' ),
						'right-sidebar' => esc_html__( 'Right Sidebar', 'prisma-core' ),
					),
				),
			);

			$options['setting'] = prisma_core_array_insert( $options['setting'], $sidebar_options, 'prisma_core_archive_sidebar_position' );

			return $options;
		}

		/**
		 * Add localize strings.
		 *
		 * @param  array $strings Array of strings to be localized.
		 * @return array          Modified string array.
		 */
		public function customizer_localized_strings( $strings ) {

			// Preview a random single product for WooCommerce > Single Product section.
			$products = get_posts(
				array(
					'post_type'      => 'product',
					'posts_per_page' => 1,
					'orderby'        => 'rand',
				)
			);

			if ( count( $products ) ) {
				$strings['preview_url_for_section']['prisma_core_woocommerce_single_product'] = get_permalink( $products[0] );
			}

			return $strings;
		}
	}
endif;
new Prisma_Core_Customizer_WooCommerce();
