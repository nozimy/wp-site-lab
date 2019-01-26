<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Ecobox
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="alt-title text-center">
			<?php
				printf( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'ecobox' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'ecobox' ); ?></h1>
			<div class="clearfix">
				<p class="nav-previous pull-left"><?php previous_comments_link( __( '&larr; Older Comments', 'ecobox' ) ); ?></p>
				<p class="nav-next pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ecobox' ) ); ?></p>
			</div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="media-list comments-list">
			<?php wp_list_comments('type=all&callback=ecobox_comments'); ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'ecobox' ); ?></h1>
			<div class="clearfix">
				<p class="nav-previous pull-left"><?php previous_comments_link( __( '&larr; Older Comments', 'ecobox' ) ); ?></p>
				<p class="nav-next pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ecobox' ) ); ?></p>
			</div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'ecobox' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$comments_args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave a Reply', 'ecobox' ),
			'title_reply_to'       => __( 'Leave a Reply to %s', 'ecobox' ),
			'cancel_reply_link'    => __( 'Cancel Reply', 'ecobox' ),
			'label_submit'         => __( 'Send', 'ecobox' ),

			'comment_field'        =>  '<p class="comment-form-comment form-group"><label for="comment">' . __( 'Comment', 'ecobox' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" class="form-control input-lg" aria-required="true">' .
			'</textarea></p>',

			'comment_notes_before' => '',
			'comment_notes_after'  => '',

			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' =>
					'<div class="row">' .
					'<div class="col-md-6">' .
					'<p class="comment-form-author form-group">' .
					'<label for="author">' . __( 'Name', 'ecobox' ) . '</label> ' .
					( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="author" name="author" type="text" class="form-control input-lg" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' /></p>' .
					'</div>',
				'email' =>
					'<div class="col-md-6">' .
					'<p class="comment-form-email form-group"><label for="email">' . __( 'Email', 'ecobox' ) . '</label> ' .
					( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="email" name="email" type="text" class="form-control input-lg" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' /></p>' .
					'</div>' .
					'</div>',
				'url' => ''
				)
			),
		);
		comment_form($comments_args);
	?>

</div><!-- #comments -->