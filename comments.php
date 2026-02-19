<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Prisma Core
 * @author      Prisma Core Team
 * @since       1.0.0
 */

/*
 * Return if comments are not meant to be displayed.
 */
if ( ! prisma_core_comments_displayed() ) {
	return;
}

?>
<?php do_action( 'prisma_core_before_comments' ); ?>
<section id="comments" class="comments-area">

	<div class="comments-title-wrapper center-text">
		<h3 class="comments-title">
			<?php

			// Get comments number.
			$prisma_core_comments_count = get_comments_number();

			if ( 0 === intval( $prisma_core_comments_count ) ) {
				$prisma_core_comments_title = esc_html__( 'Comments', 'prisma-core' );
			} else {
				/* translators: %s Comment number */
				$prisma_core_comments_title = sprintf( _n( '%s Comment', '%s Comments', $prisma_core_comments_count, 'prisma-core' ), number_format_i18n( $prisma_core_comments_count ) );
			}

			// Apply filters to the comments count.
			$prisma_core_comments_title = apply_filters( 'prisma_core_comments_count', $prisma_core_comments_title );

			echo wp_kses( $prisma_core_comments_title, prisma_core_get_allowed_html_tags() );
			?>
		</h3><!-- END .comments-title -->

		<?php
		if ( ! have_comments() ) {
			$prisma_core_no_comments_title = apply_filters( 'prisma_core_no_comments_text', esc_html__( 'No comments yet. Why don&rsquo;t you start the discussion?', 'prisma-core' ) );
			?>
			<p class="no-comments"><?php echo esc_html( $prisma_core_no_comments_title ); ?></p>
		<?php } ?>
	</div>

	<ol class="comment-list">
		<?php

		// List comments.
		wp_list_comments(
			array(
				'callback'    => 'prisma_core_comment',
				'avatar_size' => apply_filters( 'prisma_core_comment_avatar_size', 50 ),
				'reply_text'  => __( 'Reply', 'prisma-core' ),
			)
		);
		?>
	</ol>

	<?php
	// If comments are closed and there are comments, let's leave a note.
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="comments-closed center-text"><?php esc_html_e( 'Comments are closed', 'prisma-core' ); ?></p>
	<?php endif; ?>

	<?php
	the_comments_pagination(
		array(
			'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'prisma-core' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'prisma-core' ) . '</span>',
		)
	);
	?>

	<?php
	comment_form(
		array(
			/* translators: %1$s opening anchor tag, %2$s closing anchor tag */
			'must_log_in'   => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a comment.', 'prisma-core' ), '<a href="' . wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) . '">', '</a>' ) . '</p>', // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
			'logged_in_as'  => '<p class="logged-in-as">' . esc_html__( 'Logged in as', 'prisma-core' ) . ' <a href="' . esc_url( admin_url( 'profile.php' ) ) . '">' . $user_identity . '</a> <a href="' . wp_logout_url( get_permalink() ) . '" title="' . esc_html__( 'Log out of this account', 'prisma-core' ) . '">' . esc_html__( 'Log out?', 'prisma-core' ) . '</a></p>',
			'class_submit'  => 'pr-btn primary-button',
			'comment_field' => '<p class="comment-textarea"><textarea name="comment" id="comment" cols="44" rows="8" class="textarea-comment" placeholder="' . esc_html__( 'Write a comment&hellip;', 'prisma-core' ) . '" required="required"></textarea></p>',
			'id_submit'     => 'comment-submit',
		)
	);
	?>

</section><!-- #comments -->
<?php do_action( 'prisma_core_after_comments' ); ?>
