    
   <?php if(is_front_page() ) { ?>

   

<?php } ?>
   






<?php $pix_options = isset($_POST['options']) ? $_POST['options'] : get_option('pix_general_settings');?>
<!-- FOOTER -->
<div class="section-footer">


        <div class="col-xs-12 col-sm-12 col-md-12">
   
        <div class="navbar-inner container_9">
            <!--FOOTER NAV-->
          </div>
          
           </div>   
          
  <div class="container">
    <footer class="page-footer">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        
     
          <nav class="bottom-menu"> 
            <?php
         
            wp_nav_menu(array( 
                'theme_location' => 'footer_nav',
                'menu' =>'footer_nav', 
                'container'=>'', 
                'depth' => 1,
                'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>', // HTML-шаблон 
                'menu_class' => ''
                ));
            ?> 
        </nav>
        
        
        
          
         
          <div class="copyright">
          
          <div class="social-icons">  
        
                 <?php if($pix_options['pix_facebook']){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_facebook']); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
            <?php } ?>
            <?php if($pix_options['pix_vk']){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_vk']); ?>" target="_blank"><i class="fa fa-vk"></i></a>
            <?php } ?>
            <?php if($pix_options['pix_youtube']){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_youtube']); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
            <?php } ?>
            <?php if($pix_options['pix_vimeo']){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_vimeo']); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a>
            <?php } ?>
            <?php if($pix_options['pix_twitter']){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_twitter']); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
            <?php } ?>
            <?php if($pix_options['pix_google']){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_google']); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
            <?php } ?>
            <?php if($pix_options['pix_tumblr']){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_tumblr']); ?>" target="_blank"><i class="fa fa-tumblr"></i></a>
            <?php } ?>
           	<?php if(!empty($pix_options['pix_linkedin'])){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_linkedin']); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
            <?php } ?>     
            <?php if($pix_options['pix_instagram']){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_instagram']); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
            <?php } ?>
            <?php if($pix_options['pix_pinterest']){ ?>
            	<a href="<?php echo esc_url($pix_options['pix_pinterest']); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
            <?php } ?>
            
            	</div>
		  <?php echo $pix_options['pix_copyright']?></div>
          
          
    
          
        </div>
      </div>
    </footer>
  </div>
</div>
<!-- FOOTER -->

<?php if (isset($pix_options['pix_custom_js'])) echo $pix_options['pix_custom_js']; ?>
<?php wp_footer()?>



    
</div>


<?php
   /* Always have wp_footer() just before the closing </body>
    * tag of your theme, or you will break many plugins, which
    * generally use this hook to reference JavaScript files.
    */
    wp_footer();
?>

</body>
</html>