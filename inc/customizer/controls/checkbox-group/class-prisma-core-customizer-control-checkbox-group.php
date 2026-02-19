<?php
/**
 * Prisma Core Customizer checkbox group control class.
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

if ( ! class_exists( 'Prisma_Core_Customizer_Control_Checkbox_Group' ) ) :
	/**
	 * Prisma Core Customizer checkbox group control class.
	 */
	class Prisma_Core_Customizer_Control_Checkbox_Group extends Prisma_Core_Customizer_Control {

		/**
		 * The control type.
		 *
		 * @var string
		 */
		public $type = 'prisma-core-checkbox-group';

		/**
		 * Link target.
		 *
		 * @since 1.0.0
		 * @var   string
		 */
		public $choices = array();

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param string               $id      Control ID.
		 * @param array                $args    Default parent's arguments.
		 */
		public function __construct( $manager, $id, $args = array() ) { // phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();
			$this->json['choices'] = $this->choices;
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
			<div class="prisma-core-checkbox-group-wrapper prisma-core-control-wrapper">

				<# if ( data.label ) { #>
					<div class="prisma-core-control-heading customize-control-title prisma-core-field">
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

				<div class="prisma-core-checkbox-group-control">

					<# _.each( data.choices, function( params, key ) { #>

						<p>
							<label class="pr-checkbox">
								<input type="checkbox" name="{{ data.id }}-{{ key }}" data-id="{{ key }}" <# if ( _.contains( data.value, key ) ) { #>checked="checked" <# } #>>
								<span class="pr-label">{{ params.title }}
									<# if ( params.desc ) { #>
									<i class="prisma-core-info-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
											<circle cx="12" cy="12" r="10"></circle>
											<path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
											<line x1="12" y1="17" x2="12" y2="17"></line>
										</svg>
										<span class="prisma-core-tooltip">{{ params.desc }}</span>
									</i>
									<# } #>
								</span>
							</label>
						</p>

					<# } ) #>

				</div>

			</div><!-- END .prisma-core-button-wrapper -->
			<?php
		}

	}
endif;
