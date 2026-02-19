<?php
/**
 * Enqueue scripts & styles.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

/**
 * Enqueue and register scripts and styles.
 *
 * @since 1.0.0
 */
function prisma_core_enqueues() {

	// Script debug.
	$prisma_core_dir    = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'dev/' : '';
	$prisma_core_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Enqueue theme stylesheet.
	wp_enqueue_style(
		'prisma-core-styles',
		PRISMA_CORE_THEME_URI . '/assets/css/style' . $prisma_core_suffix . '.css',
		false,
		PRISMA_CORE_THEME_VERSION,
		'all'
	);


	// Register ImagesLoaded library.
	wp_register_script(
		'imagesloaded',
		PRISMA_CORE_THEME_URI . '/assets/js/' . $prisma_core_dir . 'vendors/imagesloaded' . $prisma_core_suffix . '.js',
		array(),
		'4.1.4',
		true
	);

	// Register Prisma Core slider.
	wp_register_script(
		'prisma-core-slider',
		PRISMA_CORE_THEME_URI . '/assets/js/prisma-core-slider' . $prisma_core_suffix . '.js',
		array( 'imagesloaded' ),
		PRISMA_CORE_THEME_VERSION,
		true
	);

	// Load comment reply script if comments are open.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue main theme script.
	wp_enqueue_script(
		'prisma-core-js',
		PRISMA_CORE_THEME_URI . '/assets/js/prisma-core' . $prisma_core_suffix . '.js',
		array(),
		PRISMA_CORE_THEME_VERSION,
		true
	);

	// Comment count used in localized strings.
	$comment_count = get_comments_number();

	// Localized variables so they can be used for translatable strings.
	$localized = array(
		'ajaxurl'               => esc_url( admin_url( 'admin-ajax.php' ) ),
		'nonce'                 => wp_create_nonce( 'prisma-core-nonce' ),
		'responsive-breakpoint' => intval( prisma_core_option( 'main_nav_mobile_breakpoint' ) ),
		'sticky-header'         => array(
			'enabled' => prisma_core_option( 'sticky_header' ),
			'hide_on' => prisma_core_option( 'sticky_header_hide_on' ),
		),
		'strings'               => array(
			/* translators: %s Comment count */
			'comments_toggle_show' => $comment_count > 0 ? esc_html( sprintf( _n( 'Show %s Comment', 'Show %s Comments', $comment_count, 'prisma-core' ), $comment_count ) ) : esc_html__( 'Leave a Comment', 'prisma-core' ),
			'comments_toggle_hide' => esc_html__( 'Hide Comments', 'prisma-core' ),
		),
	);

	wp_localize_script(
		'prisma-core-js',
		'prisma_core_vars',
		apply_filters( 'prisma_core_localized', $localized )
	);

	// Enqueue google fonts.
	prisma_core()->fonts->enqueue_google_fonts();

	// Add additional theme styles.
	do_action( 'prisma_core_enqueue_scripts' );
}
add_action( 'wp_enqueue_scripts', 'prisma_core_enqueues' );

/**
 * Skip link focus fix for IE11.
 *
 * @since 1.0.0
 *
 * @return void
 */
function prisma_core_skip_link_focus_fix() {
	?>
	<script>
	!function(){var e=-1<navigator.userAgent.toLowerCase().indexOf("webkit"),t=-1<navigator.userAgent.toLowerCase().indexOf("opera"),n=-1<navigator.userAgent.toLowerCase().indexOf("msie");(e||t||n)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var e,t=location.hash.substring(1);/^[A-z0-9_-]+$/.test(t)&&(e=document.getElementById(t))&&(/^(?:a|select|input|button|textarea)$/i.test(e.tagName)||(e.tabIndex=-1),e.focus())},!1)}();
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'prisma_core_skip_link_focus_fix' );

/**
 * Enqueue assets for the Block Editor.
 *
 * @since 1.0.0
 *
 * @return void
 */
function prisma_core_block_editor_assets() {

	// RTL version.
	$rtl = is_rtl() ? '-rtl' : '';

	// Minified version.
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Enqueue block editor styles.
	wp_enqueue_style(
		'prisma-core-block-editor-styles',
		PRISMA_CORE_THEME_URI . '/inc/admin/assets/css/prisma-core-block-editor-styles' . $rtl . $min . '.css',
		false,
		PRISMA_CORE_THEME_VERSION,
		'all'
	);

	// Enqueue google fonts.
	prisma_core()->fonts->enqueue_google_fonts();

	// Add dynamic CSS as inline style.
	wp_add_inline_style(
		'prisma-core-block-editor-styles',
		apply_filters( 'prisma_core_block_editor_dynamic_css', prisma_core_dynamic_styles()->get_block_editor_css() )
	);
}
add_action( 'enqueue_block_editor_assets', 'prisma_core_block_editor_assets' );
