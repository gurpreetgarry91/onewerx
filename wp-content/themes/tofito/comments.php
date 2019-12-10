<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) : ?>

<p class="nocomment">
  <?php _e( 'This post is password protected. Enter the password to view any comments.', 'PixTheme' ); ?>
</p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
<h3>
  <?php _e( 'Comments', 'PixTheme' ); ?>
</h3>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
<div class="navigation">
  <div class="nav-previous">
    <?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'PixTheme' ) ); ?>
  </div>
  <div class="nav-next">
    <?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'PixTheme' ) ); ?>
  </div>
</div>
<!-- .navigation -->
<?php endif; ?>
<ul class="comments-list unstyled clearfix">
  <?php wp_list_comments('callback=pixtheme_comment'); ?>
</ul>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
<div class="navigation">
  <div class="nav-previous">
    <?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'PixTheme' ) ); ?>
  </div>
  <div class="nav-next">
    <?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'PixTheme' ) ); ?>
  </div>
</div>
<!-- .navigation -->
<?php endif; // check for comment navigation ?>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments">
  <?php _e( 'Comments are closed.', 'PixTheme' ); ?>
</p>
<?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
<div id="respond" class="contact-form">
  <div class="comments-header"><span>
    <?php comment_form_title( 'Leave a Comment', 'Leave a Reply to %s' ); ?>
    </span></div>
  <div class="cancel-comment-reply bottom10">
    <?php cancel_comment_reply_link(); ?>
  </div>
  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
  <p class="bottom20"> <?php _e('You must be', 'PixTheme')?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> <?php _e('logged in', 'PixTheme')?></a>  <?php _e('to post a comment.', 'PixTheme')?></p>
  <?php else : ?>
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="form-add-comment form-full-width " >
    <?php if ( $user_ID ) : ?>
    <div class="row">
      <div class="col-xs-12 col-sm-12">
       <p class="bottom20">   <?php _e('Logged in as', 'PixTheme')?>
       <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"> </a> 
        <?php _e('Log out', 'PixTheme')?>
        &raquo;</a> </p></div>
    </div>
    <?php else : ?>
    <fieldset>
      <ul>
        <li>
          <input class="input-text" type="text" name="author" id="author" placeholder="Name" title="<?php _e('Name', 'PixTheme')?>" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
        </li>
        <li>
          <input  class="input-text"  type="text" name="website" id="website" placeholder="Website" title="<?php _e('Website', 'PixTheme')?>" value="<?php echo isset( $comment_author_website) ? esc_attr($comment_author_website) : ''; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
        </li>
        <li>
          <input  class="input-text"  type="text" name="email" id="email" placeholder="Email" title="<?php _e('Email', 'PixTheme')?>" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
        </li>
      </ul>
    </fieldset>
    <?php endif; ?>
    <div class="row">
      <div class="col-xs-12 col-sm-12">
        <div class="form-group">
          <textarea class=" <?php if ( $user_ID ) : ?>    ta-login   <?php else : ?>   ta-not-login <?php endif; ?>" name="comment" title="<?php _e('Comment', 'PixTheme')?>" id="comment" cols="30" rows="10" tabindex="4"></textarea>
        </div>
      </div>
    </div>
    <div class="  col-xs-12 col-sm-12 text-right">
      <button ype="submit"  id="contact-submit" class="btn btn-main btn-primary btn-lg uppercase"><span>
      <?php _e( 'Send Message.', 'PixTheme' ); ?>
      </span></button>
    </div>
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
  </form>
  <?php endif; // If registration required and not logged in ?>
</div>
<?php endif;  ?>
