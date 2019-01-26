<?php
/**
 * The template for displaying comments
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
 /**
 * Add custom HTML just after the opening `<form>` tag in the comment_form() output.
 */
add_action( 'comment_form_top', function(){
     // Adjust this to your needs:
     echo '<div class="row">';
});

/**
* Add custom HTML just before the close `<form>` tag in the comment_form() output.
*/
add_action( 'comment_form_bottom', function(){
   // Adjust this to your needs:
   echo '</div>';
});

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
   return;
}
?>

<div id="comments" class="comments-area humble-comments">

   <div class="section-title">

        <h4><?php comments_number(esc_html__('No Comments Found','humble'), esc_html__('1 Comment','humble'), '% ' . esc_html__('Comments','humble') ); ?></h4>

    </div>

   <?php if ( have_comments() ) : ?>

       <?php the_comments_navigation(); ?>

       <ul class="comments-list">
           <?php
           wp_list_comments(array(
               'avatar_size'	=> 70,
               'max_depth'		=> 4,
               'short_ping'    => true,
               'style'			=> 'ul',
               'callback'		=> 'humble_comments',
               'type'			=> 'all'
           ));
           ?>
       </ul>

       <?php the_comments_navigation(); ?>

   <?php endif; // Check for have_comments(). ?>

   <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'humble' ); ?></p>

   <?php endif; ?>

    <div class="section comment-form">
   <?php
     $commenter = wp_get_current_commenter();
     $req       = get_option( 'require_name_email' );
     $aria_req  = ( $req ? " aria-required='true'" : '' );
     $args = array(
       'id_form'           => 'commentform',
       'class_form'        => 'humble-form',
       'id_submit'         => 'comment_submit',
       'title_reply'       => esc_html__( 'Leave a Reply' ,'humble'),
       'title_reply_to'    => esc_html__( 'Leave a Comment to %s'  ,'humble'),
       'cancel_reply_link' => esc_html__( 'Cancel Comment'  ,'humble'),
       'label_submit'      => esc_html__( 'Post Comment'  ,'humble'),
       'comment_field'     => '<div class="col-md-12 formitem"><textarea name="comment" id="text" ' . $aria_req . ' class="form-control" placeholder="'.esc_html__('Comment','humble').'" rows="10"  maxlength="400"></textarea>',
       'must_log_in'          => '<p class="col-md-12 must-log-in">' .  wp_kses_post(sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'humble' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) )) . '</p>',
       'logged_in_as'         => '<p class="col-md-12 logged-in-as">' . wp_kses_post(sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  ,'humble'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ). '</p>',
       'comment_notes_before' => '',
       'comment_notes_after'  => '',
       'class_submit'         => '',
       'fields' => apply_filters( 'comment_form_default_fields',
         array(
           'author' => '
               <div class="col-md-6 formitem forminput">
                 <input type="text" placeholder="'.esc_html__('Name','humble').'" name="author" id="name" ' . $aria_req . ' class="form-control" maxlength="100">
               </div>',

           'email' => '
               <div class="col-md-6 formitem forminput">
                 <input type="email" placeholder="'.esc_html__('Email','humble').'" name="email" id="email" class="form-control" maxlength="100">
               </div>',

           'url' => '
               <div class="col-md-12 formitem forminput">
                 <input type="text" placeholder="'.esc_html__('Website','humble').'" name="url" id="url" class="form-control" maxlength="100">
               </div>',
         )

       )
     );
     comment_form($args);
   ?>

   </div><!-- End Form -->

</div><!-- .comments-area -->
