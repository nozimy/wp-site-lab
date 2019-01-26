

<div class="row">
	<div class="zl_profilebar extrabar">
		<!-- pagination -->
		<div class="large-12 column">
			<h2 class="fword"><?php get_comments_number();?> <?php echo zl_option('lang_feedbacks', __('Feedbacks', 'zatolab'));?></h2>
		</div>
		<div class="clear"></div>
		<ul id="comment-list">
			<?php
				$args = array(
				   'post_ID'  => get_the_ID(),
				   'post_id'  => get_the_ID(),
				);

				// The Query
				$comments_query = new WP_Comment_Query;
				$comments = $comments_query->query( $args );

				// Comment Loop
				if ( $comments ) {
					foreach ( $comments as $comment ) { ?>
					<li>
						<div class="large-1 column">
							<?php echo get_avatar( $comment->comment_author_email, 50 );?>
						</div>
						<div class="large-11 column">
							<div class="zl_comment_content">
								<div class="comment-author"><a href="#"><?php echo $comment->comment_author;?></a><br/></div>
								<span class="comment-date">17 Minutes</span>
								<hr/>
								<?php echo $comment->comment_content; ?>
								<a href="#">Reply</a>
							</div>
						</div>
						<div class="clear"></div>
					</li>
			<?php }
			} else {
				echo 'No comments found.';
			}
			?>
		</ul>
		<div class="clear"></div>
	</div><div class="clear"></div>
</div>
<div class="clear"></div>