<?php 
/*-----------------------------------------------------------------------------------*/
// Custom Comment Structure
/*-----------------------------------------------------------------------------------*/
function zl_custom_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

		<div class="medium-1 column norightgap">
			<?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
		</div>
		<div class="medium-11 column">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="comment-author"><strong><?php printf(__('%s', 'zatolab'), get_comment_author_link()) ?></strong> <?php echo zl_option('lang_on',__('on','zatolab')); ?> <em class="zl_commenttime"><small><?php comment_date() ?>, <?php comment_time('H:i:s'); ?></small></em></div>
				<div class="clear"></div>
				<div class="zl_comment_content">
					<?php comment_text();
					if ($comment->comment_approved == '0') : ?>
						<p><em><?php echo zl_option('lang_commoderate', __('Your comment is awaiting moderation.', 'zatolab')) ?></em></p>
					<?php endif; ?>
					<div class="clear"></div>
					<?php comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
		</div>
		<div class="clear"></div>


<?php } //END CUSTOM COMMENT


function attachmentcomment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class('photocomment'); ?> id="li-comment-<?php comment_ID() ?>">

		<div class="large-2 column noleftpad">
			<?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
		</div>
		<div class="large-10 column">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="comment-author"><strong><?php printf(__('%s', 'zatolab'), get_comment_author_link()) ?></strong></div>
				<div class="clear"></div>
				<div>
					<?php comment_text();
					if ($comment->comment_approved == '0') : ?>
						<p><em><?php echo zl_option('lang_commoderate', __('Your comment is awaiting moderation.', 'zatolab')) ?></em></p>
					<?php endif; ?>
					<div class="clear"></div>
					<div class="small-5 column nogap commenttime">
						<?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?>
					</div>
					<div class="small-7 column">
						<?php comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
					
				</div>
			</div>
		</div>
		<div class="clear"></div>


<?php } //END CUSTOM COMMENT

/*
 * Change the comment reply link to use 'Reply to &lt;Author First Name>'
 */
function add_comment_author_to_reply_link($link, $args, $comment){
 
    $comment = get_comment( $comment );
 
    // If no comment author is blank, use 'Anonymous'
    if ( empty($comment->comment_author) ) {
        if (!empty($comment->user_id)){
            $user=get_userdata($comment->user_id);
            $author=$user->user_login;
        } else {
            $author = zl_option('lang_anonymous', __('Anonymous', 'zatolab'));
        }
    } else {
        $author = $comment->comment_author;
    }
 
    // If the user provided more than a first name, use only first name
    if(strpos($author, ' ')){
        $author = substr($author, 0, strpos($author, ' '));
    }
 
    // Replace Reply Link with "Reply to &lt;Author First Name>"
    $reply_link_text = $args['reply_text'];
    $link = str_replace($reply_link_text, '<span class="entypo reply"></span> ' . zl_option('lang_reply', __('Reply to ','zatolab')) . $author, $link);
 
    return $link;
}
add_filter('comment_reply_link', 'add_comment_author_to_reply_link', 10, 3);



?>