<?php get_header(); ?>

<?php global $ecobox_data;

  $blog_sidebar = $ecobox_data['opt-blog-sidebar']; 
  switch ($blog_sidebar) {
    case '1':
      $blog_sidebar = 'blog-standard';
      break;
    case '2':
      $blog_sidebar = 'blog-standard blog-standard__left';
      break;
    case '3':
      $blog_sidebar = 'blog-fullwidth';
      break;
  }

  $blog_layout = $ecobox_data['opt-blog-layout']; 
  switch($blog_layout) {
    case '1':
      $blog_layout = '';
      break;
    case '2':
      $blog_layout = 'blog-columns blog-columns__two';
      break;
    case '3':
      $blog_layout = 'blog-columns blog-columns__three';
      break;
  };

?>

<!-- BEGIN CONTENT WRAPPER -->
<section id="primary" class="row <?php echo $blog_sidebar; ?> <?php echo $blog_layout; ?>">

  <main id="main" class="content" role="main">
    <div class="inner">
  
    <!-- Content -->
      <?php
        if(isset($_GET['author_name'])) :
          $curauth = get_userdatabylogin($author_name);
          else :
          $curauth = get_userdata(intval($author));
        endif;
      ?>
      <div class="author-info clearfix">
        <h2><?php _e('About:', 'ecobox'); ?> <?php echo $curauth->display_name; ?></h2>
        <figure class="thumb alignleft">
          <?php if(function_exists('get_avatar')) { echo get_avatar( $curauth->user_email, $size = '120' ); } /* Displays the Gravatar based on the author's email address. Visit Gravatar.com for info on Gravatars */ ?>
        </figure>
        
        <?php if($curauth->description !="") { /* Displays the author's description from their Wordpress profile */ ?>
          <p><?php echo $curauth->description; ?></p>
        <?php } ?>
      </div><!--.author-->

      <hr class="lg">

      <div id="recent-author-posts">
        <h3><?php _e('Recent Posts by', 'ecobox'); ?> <?php echo $curauth->display_name; ?></h3>
        
        <?php if ( have_posts() ) : ?>

          <div class="posts-wrapper">

          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>

            <?php
              get_template_part( 'content' );
            ?>

          <?php endwhile; ?>
          
          </div>

          <?php ecobox_pagination(); ?>

        <?php else : ?>

          <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>
        
        
      </div><!--#recentPosts-->

      <hr class="hr-lg">

      <div id="recent-author-comments">
        <h3><?php _e('Recent Comments by', 'ecobox'); ?> <?php echo $curauth->display_name; ?></h3>
          <?php
            $number=5; // number of recent comments to display
            $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' and comment_author_email='$curauth->user_email' ORDER BY comment_date_gmt DESC LIMIT $number");
          ?>
        <div class="list list list-square list-color-secondary">
          <ul>
            <?php
              if ( $comments ) : foreach ( (array) $comments as $comment) :
              echo  '<li class="recentcomments">' . sprintf(__('%1$s on %2$s', 'ecobox'), get_comment_date(), '<a href="'. get_comment_link($comment->comment_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
            endforeach; else: ?>
              <p>
                <?php _e('No comments by', 'ecobox'); ?> <?php echo $curauth->display_name; ?> <?php _e('yet.', 'ecobox'); ?>
              </p>
            <?php endif; ?>
          </ul>
        </div>
      </div><!--#recentAuthorComments-->

  
    </div><!-- .inner -->
  </main><!-- #main -->

  <div class="spacer hidden-md hidden-lg"></div>

  <!-- Sidebar -->
  <?php if($ecobox_data['opt-blog-sidebar'] != '3'): ?>
  <?php get_sidebar(); ?>
  <?php endif; ?>
  <!-- /Sidebar -->



</section><!-- #primary -->

<?php get_footer(); ?>