<?php
/**
 * Template part for displaying entry header.
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

<?php do_action( 'prisma_core_before_entry_header' ); ?>
<header class="entry-header">

	<?php
	$prisma_core_tag = is_single( get_the_ID() ) && ! prisma_core_page_header_has_title() ? 'h1' : 'h2';
	$prisma_core_tag = apply_filters( 'prisma_core_entry_header_tag', $prisma_core_tag );

	$prisma_core_title_string = '%2$s%1$s';

	if ( 'link' === get_post_format() ) {
		$prisma_core_title_string = '<a href="%3$s" title="%3$s" rel="bookmark">%2$s%1$s</a>';
	} elseif ( ! is_single( get_the_ID() ) ) {
		$prisma_core_title_string = '<a href="%3$s" title="%4$s" rel="bookmark">%2$s%1$s</a>';
	}

	$prisma_core_title_icon = apply_filters( 'prisma_core_post_title_icon', '' );
	$prisma_core_title_icon = prisma_core()->icons->get_svg( $prisma_core_title_icon );
	?>

	<<?php echo tag_escape( $prisma_core_tag ); ?> class="entry-title"<?php prisma_core_schema_markup( 'headline' ); ?>>
		<?php
		echo sprintf(
			wp_kses_post( $prisma_core_title_string ),
			wp_kses_post( get_the_title() ),
			$prisma_core_title_icon ? wp_kses_post( $prisma_core_title_icon ) : '',
			esc_url( prisma_core_entry_get_permalink() ),
			the_title_attribute( array( 'echo' => false ) )
		);
		?>
	</<?php echo tag_escape( $prisma_core_tag ); ?>>

</header>
<?php do_action( 'prisma_core_after_entry_header' ); ?>
