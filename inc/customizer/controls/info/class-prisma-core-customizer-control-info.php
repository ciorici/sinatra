<?php
/**
 * Prisma Core Customizer info control class.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Control_Info' ) ) :
	/**
	 * Prisma Core Customizer info control class.
	 */
	class Prisma_Core_Customizer_Control_Info extends Prisma_Core_Customizer_Control {

		/**
		 * The control type.
		 *
		 * @var string
		 */
		public $type = 'prisma-core-info';

		/**
		 * Custom URL.
		 *
		 * @since  1.0.0
		 * @var    string
		 */
		public $url = '';

		/**
		 * Link target.
		 *
		 * @since  1.0.0
		 * @var    string
		 */
		public $target = '_blank';

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {

			// Script debug.
			$prisma_core_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			// Control type.
			$prisma_core_type = str_replace( 'prisma-core-', '', $this->type );

			/**
			 * Enqueue control stylesheet
			 */
			wp_enqueue_style(
				'prisma-core-' . $prisma_core_type . '-control-style',
				PRISMA_CORE_THEME_URI . '/inc/customizer/controls/' . $prisma_core_type . '/' . $prisma_core_type . $prisma_core_suffix . '.css',
				false,
				PRISMA_CORE_THEME_VERSION,
				'all'
			);
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['url']    = $this->url;
			$this->json['target'] = $this->target;
		}

		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @see WP_Customize_Control::print_template()
		 */
		protected function content_template() {
			?>
			<div class="prisma-core-info-wrapper prisma-core-control-wrapper">

				<# if ( data.label ) { #>
					<span class="prisma-core-control-heading customize-control-title prisma-core-field">{{{ data.label }}}</span>
				<# } #>

				<# if ( data.description ) { #>
					<div class="description customize-control-description prisma-core-field prisma-core-info-description">{{{ data.description }}}</div>
				<# } #>

				<a href="{{ data.url }}" class="button button-primary" target="{{ data.target }}" rel="noopener noreferrer"><?php esc_html_e( 'Learn More', 'prisma-core' ); ?></a>

			</div><!-- END .prisma-core-control-wrapper -->
			<?php
		}

	}
endif;
