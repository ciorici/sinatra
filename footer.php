<?php
/**
 * The template for displaying the footer in our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

?>
		<?php do_action( 'prisma_core_main_end' ); ?>

	</div><!-- #main .site-main -->
	<?php do_action( 'prisma_core_after_main' ); ?>

	<?php do_action( 'prisma_core_before_colophon' ); ?>

	<?php if ( prisma_core_is_colophon_displayed() ) { ?>
		<footer id="colophon" class="site-footer" role="contentinfo"<?php prisma_core_schema_markup( 'footer' ); ?>>

			<?php do_action( 'prisma_core_footer' ); ?>

		</footer><!-- #colophon .site-footer -->
	<?php } ?>

	<?php do_action( 'prisma_core_after_colophon' ); ?>

</div><!-- END #page -->
<?php do_action( 'prisma_core_after_page_wrapper' ); ?>
<?php wp_footer(); ?>

</body>
</html>
