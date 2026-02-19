<?php
/**
 * Template part for displaying entry content.
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

<?php do_action( 'prisma_core_before_entry_content' ); ?>
<div class="entry-content pr-entry"<?php prisma_core_schema_markup( 'text' ); ?>>
	<?php the_content(); ?>
</div>

<?php prisma_core_link_pages(); ?>

<?php do_action( 'prisma_core_after_entry_content' ); ?>
