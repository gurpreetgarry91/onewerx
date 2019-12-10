<?php

/**** WIDGETS AREA ****/


/* ***************************************************** 
 * Plugin Name: PixTheme Flickr
 * Description: Retrieve and display photos from Flickr.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class pix_flickr_widget extends WP_Widget {

	// Widget setup.
	function pix_flickr_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'pix-flickr-widget',
			'description' => __('Display images from flickr', 'PixTheme')
		);

		// Widget control settings.
		$control_ops = array(
			'id_base' => 'pix-flickr-widget'
		);

		// Create the widget.
		$this->WP_Widget('pix-flickr-widget', __('PixTheme - Flickr images', 'PixTheme') , $widget_ops, $control_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$id = $instance['flickr_id'];
		$nr = ($instance['flickr_nr'] != '') ? $nr = $instance['flickr_nr'] : $nr = 16;
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		echo "
		<script type=\"text/javascript\">
			jQuery(document).ready(function(){
				jQuery('#basicuse').jflickrfeed({
					limit: ".$nr.",
					qstrings: {
						id: '".$id."'
					},
					itemTemplate: '<li><a href=\"http://www.flickr.com/photos/".$id."\"><img src=\"{{image_s}}\" alt=\"{{title}}\" /></a></li>'
				});
			});
		</script>";
		echo '<ul id="basicuse" class="flickr clearfix"></ul>'.$after_widget;
		
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['flickr_nr'] = strip_tags($new_instance['flickr_nr']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
		'title' => 'Latest From Flickr',
		'flickr_nr' => '16',
		'flickr_id' => '47445714@N03'
		);
		
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'PixTheme'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
        
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>"><?php _e('Flickr ID:', 'PixTheme'); ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('flickr_id')); ?>" value="<?php echo esc_attr($instance['flickr_id']); ?>" class="widefat" />
            <?php /* <small style="line-height:12px;"><a href="http://www.idgettr.com">Find your Flickr user or group id</a></small> */ ?>
		</p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr_nr')); ?>"><?php _e('Number of photos:', 'PixTheme'); ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id('flickr_nr')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('flickr_nr')); ?>" value="<?php echo esc_attr($instance['flickr_nr']); ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('pix_flickr_widget');


/* ***************************************************** 
 * Plugin Name: Last Tweets
 * Description: Displays Latest Tweets.
 * Version: 1.1
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */

add_action( 'widgets_init', 'latest_tweet_widget' );
function latest_tweet_widget() {
	register_widget( 'Latest_Tweets' );
}
class Latest_Tweets extends WP_Widget {

	function Latest_Tweets() {
		$widget_ops = array( 'classname' => 'twitter-widget'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'latest-tweets-widget' );
		$this->WP_Widget( 'latest-tweets-widget','PixTheme - Latest Tweets', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_tweets = $instance['no_of_tweets'];
		$transName = 'list_tweets';
	    $cacheTime = 20;
		$twitter_username 		= $instance['twitter_username'];
		$consumer_key 			= $instance['consumer_key'];
		$consumer_secret		= $instance['consumer_secret'];
		$access_token 			= $instance['access_token'];
		$access_token_secret 	= $instance['access_token_secret'];
		
	if( !empty($twitter_username) && !empty($consumer_key) && !empty($consumer_secret) && !empty($access_token) && !empty($access_token_secret)  ){
	    if(false === ($twitterData = get_transient($transName) ) ){
		
			$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
			$twitterData = $twitterConnection->get(
					  'statuses/user_timeline',
					  array(
					    'screen_name'     => $twitter_username ,
					    'count'           => $no_of_tweets
						)
					);
			if($twitterConnection->http_code != 200)
			{
				$twitterData = get_transient($transName);
			}
	        // Save our new transient.
	        set_transient($transName, $twitterData, 60 * $cacheTime);
	    }
		/* Before widget (defined by themes). */
		echo $before_widget;
	
	
			echo $before_title; ?>
			<?php echo $title ; ?>
		<?php echo $after_title; 

            	if( !empty($twitterData) && is_array($twitterData)  && !isset($twitterData['error'])){
            		$i=0;
					$hyperlinks = true;
					$encode_utf8 = true;
					$twitter_users = true;
					$update = true;
					echo '
<div id="twitter-widget">
<ul class="twitter_update_list">';
		            foreach($twitterData as $item){
		                    $msg = $item->text;
		                    $permalink = 'http://twitter.com/#!/'. $twitter_username .'/status/'. $item->id_str;
		                    if($encode_utf8) $msg = utf8_encode($msg);
		                    $link = $permalink;
		                     echo '
<li class="twitter-item"><i class="icon-twitter"></i>';
		                      if ($hyperlinks) {    $msg = $this->hyperlinks($msg); }
		                      if ($twitter_users)  { $msg = $this->twitter_users($msg); }
		                      echo $msg;
		                    if($update) {
		                      $time = strtotime($item->created_at);
		                      if ( ( abs( time() - $time) ) < 86400 )
		                        $h_time = sprintf( __('%s ago', 'PixTheme'), human_time_diff( $time ) );
		                      else
		                        $h_time = date(__('Y/m/d', 'PixTheme'), $time);
		                      echo sprintf( __('%s', 'twitter-for-wordpress', 'PixTheme'),' <span class="twitter-timestamp"><abbr title="' . date(__('Y/m/d H:i:s', 'PixTheme'), $time) . '">' . $h_time . '</abbr></span>' );
		                     }
		                    echo '</li>
';
		                    $i++;
		                    if ( $i >= $no_of_tweets ) break;
		            }
					echo '</ul> </div>
';
            	}
				else
				{ 
					echo _e('Sorry , Twitter seems down or responds slowly.', 'PixTheme'); 
				}
            ?>
		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	else{
		echo $before_widget;
		echo $before_title; ?>
			<a href="http://twitter.com/<?php echo esc_url($twitter_username)?>" class="twitter-title"><?php echo $title ; ?></a>
		<?php echo $after_title._e('You need to Setup Twitter API OAuth settings first', 'PixTheme');
		echo $after_widget;
	}
}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );
		
		$instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
		$instance['consumer_key'] = strip_tags( $new_instance['consumer_key'] );
		$instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret'] );
		$instance['access_token'] = strip_tags( $new_instance['access_token'] );
		$instance['access_token_secret'] = strip_tags( $new_instance['access_token_secret'] );
		//$instance['accounts'] = strip_tags( $new_instance['accounts'] );
		//$instance['replies'] = strip_tags( $new_instance['replies'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('@Follow Me' , 'PixTheme') , 'no_of_tweets' => '5', 'twitter_username'=>'weblusive', 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter_username' )); ?>"><?php _e('Username', 'PixTheme')?> : </label>
			<input id="<?php echo esc_attr($this->get_field_id( 'twitter_username' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_username' )); ?>" value="<?php echo esc_attr($instance['twitter_username']); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'consumer_key' )); ?>"><?php _e('Consumer Key', 'PixTheme')?> : </label>
			<input id="<?php echo esc_attr($this->get_field_id( 'consumer_key' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'consumer_key' )); ?>" value="<?php echo esc_attr($instance['consumer_key']); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'consumer_secret' )); ?>"><?php _e('Consumer Secret', 'PixTheme')?> : </label>
			<input id="<?php echo esc_attr($this->get_field_id( 'consumer_secret' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'consumer_secret' )); ?>" value="<?php echo esc_attr($instance['consumer_secret']); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>"><?php _e('Access Token', 'PixTheme')?> : </label>
			<input id="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'access_token' )); ?>" value="<?php echo esc_attr($instance['access_token']); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'access_token_secret' )); ?>"><?php _e('Access Token Secret', 'PixTheme')?> : </label>
			<input id="<?php echo esc_attr($this->get_field_id( 'access_token_secret' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'access_token_secret' )); ?>" value="<?php echo esc_attr($instance['access_token_secret']); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title', 'PixTheme')?> : </label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'no_of_tweets' )); ?>"><?php _e('Number of Tweets to show', 'PixTheme')?> : </label>
			<input id="<?php echo esc_attr($this->get_field_id( 'no_of_tweets' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'no_of_tweets' )); ?>" value="<?php echo esc_attr($instance['no_of_tweets']); ?>" type="text" size="3" />
		</p>
	<?php
	}
	
		/**
	 * Find links and create the hyperlinks
	 */
	private function hyperlinks($text) {
	    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
	    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
	    // match name@address
	    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
	        //mach #trendingtopics. Props to Michael Voigt
	    $text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
	    return $text;
	}
	/**
	 * Find twitter usernames and link to them
	 */
	private function twitter_users($text) {
	       $text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
	       return $text;
	}
	
}

/* ***************************************************** 
 * Plugin Name: PixTheme Blog Posts
 * Description: Retrieve and display latest blog posts.
 * Version: 1.0
 * ************************************************** */
class pix_blogposts_widget extends WP_Widget {

	// Widget setup.
	function pix_blogposts_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_pix_blogposts',
			'description' => __('Display latest blog posts on footer', 'PixTheme')
		);

		// Create the widget.
		$this->WP_Widget('pix-blogposts-widget', __('PixTheme Footer Blog Posts', 'PixTheme') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$post_count = $instance['post_count'];
		$post_category = $instance['post_category'];
		$post_thumbs = $instance['post_thumbs'];
		global $post;
		$args = array( 'numberposts' => $post_count);
		if (!empty($post_category))
		$args['category'] = $post_category;
		$myposts = get_posts( $args );
		
		if ($myposts):
			foreach( $myposts as $post ) :	setup_postdata($post);  ?>          
				<?php if ($post_thumbs == 1):?>
				<div class="media">
					<a href="<?php the_permalink()?>" class="pull-left">
						<?php if(has_post_thumbnail()):?>
							<?php the_post_thumbnail('blog-thumb', array('class'=>'media-object') ); ?>
						<?php else:?>
							<img src = "http://placehold.it/59x59" alt="No Image" />
						<?php endif?>
					</a>
					<div class="media-body">
						<h4 class="media-heading"><a href="<?php the_permalink()?>"><?php the_title()?></a></h4> 
						<small><?php the_date()?></small>
					</div>
				</div>
				<?php else:?>
				<ul class="post-widget">
					<li>
						<h4 class="media-heading"><a href="<?php the_permalink()?>"><?php the_title()?></a></h4> 
						<small><?php the_date()?></small>
					</li>
				</ul>
				<?php endif?>
			<?php endforeach; ?>
		<?php endif; ?>
        <?php echo $after_widget; 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['post_thumbs'] = strip_tags($new_instance['post_thumbs']);
		$instance['post_category'] = strip_tags($new_instance['post_category']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => 'Latest from the blog',
			'post_count' => '2',
			'post_category' => '',
			'post_thumbs' => ''
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('post_title')); ?>"><?php _e('Title', 'PixTheme'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('post_title')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_title')); ?>" value="<?php echo esc_attr($instance['post_title']); ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('post_count')); ?>"><?php _e('Number of Posts to show', 'PixTheme'); ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id('post_count')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_count')); ?>" value="<?php echo esc_attr($instance['post_count']); ?>" class="widefat" />
		</p>
        
         <p>
			<label for="<?php echo esc_attr($this->get_field_id('post_category')); ?>"><?php _e('Category (Leave Blank to show from all categories)', 'PixTheme'); ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id('post_category')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_category')); ?>" value="<?php echo esc_attr($instance['post_category']); ?>" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('post_thumbs')); ?>"><?php _e('Show thumbnails', 'PixTheme'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('post_thumbs')); ?>" name="<?php echo esc_attr($this->get_field_name('post_thumbs')); ?>" class="widefat">
				<option value="0" <?php if( $instance['post_thumbs'] == 0):?>selected="selected"<?php endif?>>No</option> 
				<option value="1" <?php if( $instance['post_thumbs'] == 1):?>selected="selected"<?php endif?>>Yes</option> 
			</select>
		</p>
	<?php
	}
}

register_widget('pix_blogposts_widget');



/* ***************************************************** 
 * Plugin Name: 3-in-1 Posts
 * Description: Retrieve and display popular/latest posts/latest comments.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class pix_totalposts_widget extends WP_Widget {

	// Widget setup.
	function pix_totalposts_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_pix_totalposts',
			'description' => __('Retrieve and display popular/latest posts/latest comments.', 'PixTheme')
		);

		// Create the widget.
		$this->WP_Widget('pix-totalposts-widget', __('PixTheme Popular/Latest posts/Last comments', 'PixTheme') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$post_count = $instance['post_count'];
		$post_category = $instance['post_category'];
		
		global $post;
		$args = array( 'numberposts' => $post_count);
		if (!empty($post_category))
		$args['category'] = $post_category;
		?>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#pop" data-toggle="tab"><?php _e('Popular', 'PixTheme')?></a></li>
			<li><a href="#rec" data-toggle="tab"><?php _e('Recent', 'PixTheme')?></a></li>
			<li><a href="#com" data-toggle="tab"><?php _e('Comments', 'PixTheme')?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="pop">
				
					<?php $myposts = get_posts( $args ); 
					if ($myposts):
						foreach( $myposts as $post ) :	setup_postdata($post);  ?>                 
							<div class="media">
								<a href="<?php the_permalink()?>" class="pull-left">
									<?php if(has_post_thumbnail()):?>
										<?php the_post_thumbnail('blog-thumb', array('class'=>'media-object') ); ?>
									<?php else:?>
										<img src = "http://placehold.it/59x59" alt="No Image" />
									<?php endif?>
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="<?php the_permalink()?>"><?php the_title()?></a></h4> 
									<p><?php echo pixtheme_limit_words( get_the_excerpt(), 9)?></p>
								</div>
							</div>
						<?php endforeach; 
					endif; ?>
				
			</div>
			<div class="tab-pane fade" id="rec">
				<?php wp_reset_query();
				$args ['orderby'] = 'comment_count';
				$myposts = get_posts( $args ); 
				
				if ($myposts):
					foreach( $myposts as $post ) :	setup_postdata($post);  ?>                 
						<div class="media">
							<a href="<?php the_permalink()?>" class="pull-left">
								<?php if(has_post_thumbnail()):?>
									<?php the_post_thumbnail('blog-thumb', array('class'=>'media-object') ); ?>
								<?php else:?>
									<img src = "http://placehold.it/59x59" alt="No Image" />
								<?php endif?>
							</a>
							<div class="media-body">
								<h4 class="media-heading"><a href="<?php the_permalink()?>"><?php the_title()?></a></h4> 
								<p><?php echo pixtheme_limit_words( get_the_excerpt(), 9)?></p>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="tab-pane fade" id="com">
				<?php 
				global $wpdb;	
				$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 5";
				$comments = $wpdb->get_results($sql);
				foreach ($comments as $comment) :?>
					<div class="media">
						<a href="<?php echo get_permalink($comment->ID).'#comment-'.$comment->comment_ID?>" title="<?php echo strip_tags($comment->comment_author).' '.__('on ', 'PixTheme').' '.$comment->post_title?>" class="pull-left">
							<?php echo get_avatar($comment, '60')?>
						</a>
						<div class="media-body">
							<a href="<?php echo get_permalink($comment->ID).'#comment-'.$comment->comment_ID?>" title="<?php echo strip_tags($comment->comment_author).' '.__('on', 'PixTheme').' '.$comment->post_title?>">
								<?php echo strip_tags($comment->comment_author)?>
							</a>
							<p><?php echo strip_tags($comment->com_excerpt)?></p>
							<time datetime="<?php echo get_the_time('Y-m-d'); ?>"><i class="icon-calendar"></i><?php echo get_the_time('F d, Y'); ?></time>
						</div>
					</div>
				<?php endforeach; wp_reset_query();?>
			</div>
		</div>
        <?php echo $after_widget; 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['post_category'] = strip_tags($new_instance['post_category']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => 'Blog posts',
			'post_count' => '3',
			'post_category' => ''
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('post_title')); ?>"><?php _e('Title', 'PixTheme'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('post_title')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_title')); ?>" value="<?php echo esc_attr($instance['post_title']); ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('post_count')); ?>"><?php _e('Number of Posts to show', 'PixTheme'); ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id('post_count')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_count')); ?>" value="<?php echo esc_attr($instance['post_count']); ?>" class="widefat" />
		</p>
        
         <p>
			<label for="<?php echo esc_attr($this->get_field_id('post_category')); ?>"><?php _e('Category (Leave Blank to show from all categories)', 'PixTheme'); ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id('post_category')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_category')); ?>" value="<?php echo esc_attr($instance['post_category']); ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('pix_totalposts_widget');


/* ***************************************************** 
 * Plugin Name: PixTheme Contact Widget
 * Description: Display contact widget on footer.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
/**
 * Contact Form Widget Class
 */
class pix_Contact_Form extends WP_Widget {
	
	function pix_Contact_Form() {
		$widget_ops = array('classname' => 'pix_contact_form_entries', 'description' => __("Contact widget", 'PixTheme') );
		$this->WP_Widget('pix_Contact_Form', __('PixTheme - Contact Form', 'PixTheme'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us', 'PixTheme') : $instance['title'], $instance);
		$email = apply_filters('widget_title', empty($instance['email']) ? __('', 'PixTheme') : $instance['email'], $instance);
		$success = apply_filters('widget_title', empty($instance['success']) ? __('Thank you, e-mail sent.', 'PixTheme') : $instance['success'], $instance);
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
        ?>                
			<form action="#" method="post" id="contactFormWidget">
            
            <ul>
			
					<li>	<input type="text" name="wname" id="wname" value="" size="22" placeholder="<?php _e('Name', 'PixTheme')?>"/> </li>
				
						<li>	<input type="text" name="wemail" id="wemail" value="" size="22" placeholder="<?php _e('Email', 'PixTheme')?>" /> </li>
						
					
					<li>		<textarea name="wmessage" id="wmessage" cols="60" rows="10" placeholder="<?php _e('Message', 'PixTheme')?>"></textarea> </li>
					
		
		
					
					<li class="text-right mini-btn-set">		<input type="submit" id="wformsend" value="<?php _e('Send', 'PixTheme')?>" class="btn" name="wsend" /> </li>
                        
                        </ul>
			
			
				<div class="loading"></div>
                
				<div>
					<input type="hidden" name="wcontactemail" id="wcontactemail" value="<?php echo esc_attr($email)?>" />
					<input type="hidden" value="<?php echo home_url()?>" id="wcontactwebsite" name="wcontactwebsite" />
					<input type="hidden" name="wcontacturl" id="wcontacturl" value="<?php echo get_template_directory_uri()?>/library/sendmail.php" />
				</div>
                
				<div class="clear"></div>
				<div class="widgeterror"></div>
				<div class="widgetinfo"><i class="icon-envelope"></i><?php echo $success?></div>
			</form>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['success'] = strip_tags($new_instance['success']);
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		$success = isset($instance['success']) ? esc_attr($instance['success']) : '';
	?>
	
		<div>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:<br />', 'PixTheme'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		</div>
        <div>
        	<label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('Email Address:<br />', 'PixTheme'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></label></p>
		</div>
        <div>
        	<label for="<?php echo esc_attr($this->get_field_id('success')); ?>"><?php _e('Success Message:<br />', 'PixTheme'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('success')); ?>" name="<?php echo esc_attr($this->get_field_name('success')); ?>" type="text" value="<?php echo esc_attr($success); ?>" /></label></p>
		</div>
		<div style="clear:both"></div>
<?php
	}
}

register_widget('pix_Contact_Form');



//////////////////////////////////////////
class pix_works_widget extends WP_Widget {

	// Widget setup.
	function pix_works_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_pix_works',
			'description' => __('Display latest works (Portoflio)', 'PixTheme')
		);

		// Create the widget.
		$this->WP_Widget('pix-works-widget', __('PixTheme - Latest Works', 'PixTheme') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$post_count = $instance['post_count'];
		$featured = $instance['featured'];
		
		$args = array('post_type' => 'portfolio', 'taxonomy'=> 'portfolio_category', 'posts_per_page' => $post_count);
		if ($featured)
		{
			$args['meta_key'] = '_portfolio_featured'; 
			$args['meta_value'] = '1';
		}
		$loop = new WP_Query($args);
		
		while ( $loop->have_posts() ) : $loop->the_post();?>
			<div class="media">
				<a href="<?php the_permalink()?>" class="pull-left">
					<?php if(has_post_thumbnail()):?>
						<?php the_post_thumbnail('blog-thumb', array('class'=>'media-object') ); ?>
					<?php else:?>
						<img src = "http://placehold.it/59x59" alt="No Image" />
					<?php endif?>
				</a>
				<div class="media-body">
					<h4 class="media-heading"><a href="<?php the_permalink()?>"><?php the_title()?></a></h4> 
					<p><?php echo pixtheme_limit_words(get_the_excerpt(), '12')?></p>
				</div>
			</div>
            <?php endwhile;?>
		<?php echo $after_widget; 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['featured'] = strip_tags($new_instance['featured']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => 'Recent works',
			'post_count' => '3',
			'featured' => '0',
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('post_title')); ?>"><?php _e('Title', 'PixTheme'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('post_title')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_title')); ?>" value="<?php echo esc_attr($instance['post_title']); ?>" class="widefat" />
		</p>
        
         <p>
			<label for="<?php echo esc_attr($this->get_field_id('featured')); ?>"><?php _e('Show only featured posts', 'PixTheme'); ?></label> 
			<select id="<?php echo esc_attr($this->get_field_id('featured')); ?>" name="<?php echo esc_attr($this->get_field_name('featured')); ?>" class="widefat">
				<option value="0" <?php if( $instance['featured'] == 0):?>selected="selected"<?php endif?>>No</option> 
				<option value="1" <?php if( $instance['featured'] == 1):?>selected="selected"<?php endif?>>Yes</option> 
			</select>
		</p>
        
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('post_count')); ?>"><?php _e('Number of Posts to show', 'PixTheme'); ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id('post_count')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('post_count')); ?>" value="<?php echo esc_attr($instance['post_count']); ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('pix_works_widget');
?>