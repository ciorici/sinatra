// Toggle control
wp.customize.controlConstructor[ 'prisma-core-toggle' ] = wp.customize.Control.extend({
	ready: function() {
		"use strict";

		var control = this;

		// Change the value
		control.container.on( 'click', '.prisma-core-toggle-switch', function() {
			control.setting.set( ! control.setting.get() );
		});
	}
});