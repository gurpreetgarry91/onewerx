<?php /* Template Name: Under Construction */ ?>

<?php get_header(); 
   $pix_options = get_option('pix_general_settings'); 
   $date = explode('/', $pix_options['pix_uc_ldate']);
?>
<script type="text/javascript">
	jQuery(document).ready(function(){ 			
		jQuery('div#clock').countdown("<?php echo esc_attr($date[0])?>/<?php echo esc_attr($date[1])?>/<?php echo esc_attr($date[2])?>", function(event) {
			var $this = jQuery(this);
			switch(event.type) {
				case "seconds":
				case "minutes":
				case "hours":
				case "days":
				case "weeks":
				case "daysLeft":
					$this.find('span#'+event.type).html(event.value);
				break;
				case "finished":
				$this.hide();
					break;
			}
		});
	}); 
</script> 

<div class="container">
	<div class="row-fluid content-top">
		<div class="span12 text-center uc-header">
			<img src="<?php echo esc_url($pix_options['pix_logo']) ?>" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" id="logo-image" />
			<h1 class="construction_title"><?php echo $pix_options['pix_uc_maincaption'] ?></h1>
		</div>
	</div>

	<div class="row-fluid maincontent"> 
		<div class="span12 construction">
			
			<h4 class="construction_description text-center">
				<?php echo $pix_options['pix_uc_pr_head_text'] ?>
			</h4>
			<div class="nice primaprogry progress progress-striped active top-spacing">
				<h4 class="text-center"><?php echo $pix_options['pix_uc_progress'] ?>%</h4>
				<div class="bar bar-danger" role="progressbar" aria-valuenow="<?php echo esc_attr($pix_options['pix_uc_progress']) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo esc_attr($pix_options['pix_uc_progress']) ?>%"></div>
			</div>
			  
			<div id="clock" class="top-spacing">
				<div class="row-fluid">
					<div class="span2">
						<p><span id="weeks"></span><?php _e('Weeks', 'Straight')?></p>
					</div>
					<div class="span2">
						<p><span id="daysLeft"></span><?php _e('Days', 'Straight')?></p>
					</div>                    
					<div class="span2">
						<p><span id="hours"></span><?php _e('Hours', 'Straight')?></p>
					</div>
					<div class="span2">
						<p><span id="minutes"></span><?php _e('Minutes', 'Straight')?></p>
					</div>
					<div class="span2">
						<p><span id="seconds"></span><?php _e('Seconds', 'Straight')?></p>
					</div>
				</div>
			</div>
						
						
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php the_content() ?>
			<?php endwhile; ?>	
		</div>
	</div>
</div>    
<?php get_footer(); ?>