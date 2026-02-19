<?php
/**
 * The template for displaying Hero Hover Slider.
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

$prisma_core_hero_categories = ! empty( $prisma_core_hero_categories ) ? implode( ', ', $prisma_core_hero_categories ) : '';

// Setup Hero posts.
$prisma_core_args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => prisma_core_option( 'hero_hover_slider_post_number' ), // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page
	'ignore_sticky_posts' => true,
	'tax_query'           => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote' ),
			'operator' => 'NOT IN',
		),
	),
);

$prisma_core_hero_categories = prisma_core_option( 'hero_hover_slider_category' );

if ( ! empty( $prisma_core_hero_categories ) ) {
	$prisma_core_args['category_name'] = implode( ', ', $prisma_core_hero_categories );
}

$prisma_core_args = apply_filters( 'prisma_core_hero_hover_slider_query_args', $prisma_core_args );

$prisma_core_posts = new WP_Query( $prisma_core_args );

// No posts found.
if ( ! $prisma_core_posts->have_posts() ) {
	return;
}

$prisma_core_hero_bgs_html   = '';
$prisma_core_hero_items_html = '';

$prisma_core_hero_elements = (array) prisma_core_option( 'hero_hover_slider_elements' );
$prisma_core_hero_readmore = isset( $prisma_core_hero_elements['read_more'] ) && $prisma_core_hero_elements['read_more'] ? ' pr-hero-readmore' : '';

while ( $prisma_core_posts->have_posts() ) :
	$prisma_core_posts->the_post();

	// Background images HTML markup.
	$prisma_core_hero_bgs_html .= '<div class="hover-slide-bg" data-background="' . get_the_post_thumbnail_url( get_the_ID(), 'full' ) . '"></div>';

	// Post items HTML markup.
	ob_start();
	?>
	<div class="col-xs-<?php echo esc_attr( 12 / $prisma_core_args['posts_per_page'] ); ?> hover-slider-item-wrapper<?php echo esc_attr( $prisma_core_hero_readmore ); ?>">
		<div class="hover-slide-item">
			<div class="slide-inner">

				<?php if ( isset( $prisma_core_hero_elements['category'] ) && $prisma_core_hero_elements['category'] ) { ?>
					<div class="post-category">
						<?php prisma_core_entry_meta_category( ' ', false ); ?>
					</div>
				<?php } ?>

				<?php if ( get_the_title() ) { ?>
					<h3><a href="<?php echo esc_url( prisma_core_entry_get_permalink() ); ?>"><?php the_title(); ?></a></h3>
				<?php } ?>

				<?php if ( isset( $prisma_core_hero_elements['meta'] ) && $prisma_core_hero_elements['meta'] ) { ?>
					<div class="entry-meta">
						<div class="entry-meta-elements">
							<?php
							prisma_core_entry_meta_author();

							prisma_core_entry_meta_date(
								array(
									'show_modified'   => false,
									'published_label' => '',
								)
							);
							?>
						</div>
					</div><!-- END .entry-meta -->
				<?php } ?>

				<?php if ( $prisma_core_hero_readmore ) { ?>
					<a href="<?php echo esc_url( prisma_core_entry_get_permalink() ); ?>" class="read-more pr-btn btn-small btn-outline btn-uppercase" role="button"><span><?php esc_html_e( 'Continue Reading', 'prisma-core' ); ?></span></a>
				<?php } ?>

			</div><!-- END .slide-inner -->
		</div><!-- END .hover-slide-item -->
	</div><!-- END .hover-slider-item-wrapper -->
	<?php
	$prisma_core_hero_items_html .= ob_get_clean();
endwhile;

// Restore original Post Data.
wp_reset_postdata();

// Hero container.
$prisma_core_hero_container = prisma_core_option( 'hero_hover_slider_container' );
$prisma_core_hero_container = 'full-width' === $prisma_core_hero_container ? 'pr-container pr-container__wide' : 'pr-container';

// Hero overlay.
$prisma_core_hero_overlay = absint( prisma_core_option( 'hero_hover_slider_overlay' ) );
?>

<div class="pr-hover-slider slider-overlay-<?php echo esc_attr( $prisma_core_hero_overlay ); ?>">
	<div class="hover-slider-backgrounds">

		<?php echo wp_kses_post( $prisma_core_hero_bgs_html ); ?>

	</div><!-- END .hover-slider-items -->

	<div class="pr-hero-container <?php echo esc_attr( $prisma_core_hero_container ); ?>">
		<div class="pr-flex-row hover-slider-items">

			<?php echo wp_kses_post( $prisma_core_hero_items_html ); ?>

		</div><!-- END .hover-slider-items -->
	</div>

	<div class="pr-spinner visible">
		<div></div>
		<div></div>
	</div>
</div><!-- END .pr-hover-slider -->
