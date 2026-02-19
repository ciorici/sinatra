<?php
/**
 * Template part for displaying entry content (summary).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

?>

<?php do_action( 'prisma_core_before_entry_summary' ); ?>
<div class="entry-summary pr-entry"<?php prisma_core_schema_markup( 'text' ); ?>>

	<?php
	if ( post_password_required() ) {
		esc_html_e( 'This content is password protected. To view it please go to the post page and enter the password.', 'prisma-core' );
	} else {
		prisma_core_excerpt();
	}
	?>

</div>
<?php do_action( 'prisma_core_after_entry_summary' ); ?>
