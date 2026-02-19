<?php
/**
 * Prisma Core Customizer custom toggle control class.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Control_Toggle' ) ) :
	/**
	 * Prisma Core Customizer custom toggle control class.
	 */
	class Prisma_Core_Customizer_Control_Toggle extends Prisma_Core_Customizer_Control {

		/**
		 * The control type.
		 *
		 * @var string
		 */
		public $type = 'prisma-core-toggle';

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
			<div class="prisma-core-toggle-wrapper prisma-core-control-wrapper">

				<# if ( data.label ) { #>
					<div class="customize-control-title">
						<span>{{{ data.label }}}</span>

						<# if ( data.description ) { #>
							<i class="prisma-core-info-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
									<circle cx="12" cy="12" r="10"></circle>
									<path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
									<line x1="12" y1="17" x2="12" y2="17"></line>
								</svg>
								<span class="prisma-core-tooltip">{{{ data.description }}}</span>
							</i>
						<# } #>

					</div>
				<# } #>

				<div id="input_{{ data.id }}" class="prisma-core-toggle">

					<input type="checkbox" id="{{ data.id }}" name="{{ data.id }}" <# if ( data.value ) { #> checked="checked" <# } #>>

					<label for="{{ data.id }}">
						<span class="prisma-core-toggle-switch"></span>
					</label>
				</div><!-- END .prisma-core-toggle -->

			</div><!-- END .prisma-core-toggle-wrapper -->
			<?php
		}

	}
endif;
