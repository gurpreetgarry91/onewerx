<?php header("Content-type: text/css; charset: UTF-8"); 
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
$pix_options = get_option('pix_general_settings');
?>


<?php if($pix_options['pix_global_color'] != ''):?>

 
 .main-menu .current-menu-item > a, .current-menu-parent > a ,
 .main-menu > li.current > a ,
 .tab-content-icon ,
 #Services2 .nav-tabs .active a, .list-service .nav-tabs li.active i ,
 #Services2 .nav-tabs .active a, .list-service .nav-tabs li.active i ,
 .social-team a:hover i ,
 .main-menu > li > a:hover, 
 .main-menu > .hover > a ,
 .post .entry-meta i, .post .entry-meta span[class*="icon-"] ,
 aside .block-content li a:hover ,
 .post-details span[class*="icon-"],
  .post-details i ,
  [id^="pix-totalposts-widget-"] .icon-calendar:before
  
  
  
  {
color:<?php echo esc_attr($pix_options['pix_global_color'])?> !important;

}


html .portfolio-filter > li .btn-primary , 
.detail-item .btn-icon, 
.detail-item .btn-icon-link ,
.sly_scrollbar .handle ,
.team-member .details , 
input[type="submit"] ,
[id^="pix-totalposts-widget-"] .nav-tabs li.active ,
.post .entry-footer .readmore ,
.pagination ul > li a:hover, .pagination ul > li.current a ,
.btn-primary ,
mark ,
.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus , html .dl-menuwrapper button , .no-touch .dl-menuwrapper li a:hover, .dl-menu .active a

 {
 
background-color:<?php echo esc_attr($pix_options['pix_global_color'])?> !important;

}



.wrap-circle  ,
.post .entry-format > a

 {
 
background:<?php echo esc_attr($pix_options['pix_global_color'])?> !important;

}

.page-footer .copyright ,
.post .entry-meta ,
.entry-media .blockquote ,
blockquote.pull-right ,
blockquote ,
.btn.btn-shorty
{
    border-color: <?php echo esc_attr($pix_options['pix_global_color'])?> !important;
}



.bubble-float-bottom:before {
    border-color: <?php echo esc_attr($pix_options['pix_global_color'])?>  transparent transparent !important;
    }
    

.ip-header .ip-loader svg path.ip-loader-circle {
    stroke:<?php echo esc_attr($pix_options['pix_global_color'])?> !important;
    }
    
    
   html .outline-outward:before{
   
   
	 border-color: <?php echo esc_attr($pix_options['pix_global_color'])?>  !important; 
 }
 
 
  html .btn-slider:hover{
	background-color:<?php echo esc_attr($pix_options['pix_global_color'])?> !important;
	
	 
 }
 
 
 
 

<?php endif?>




<?php if($pix_options['pix_header_color'] != ''){?>


.page-img{
   background-color:<?php echo esc_attr($pix_options['pix_header_color'])?> !important;
   border-color:<?php echo esc_attr($pix_options['pix_header_color'])?> !important;
    }
    

    
<?php } ?>    
    

<?php if($pix_options['pix_footer_color'] != ''){?>


 .section-footer , .page-footer .copyright{
   background-color:<?php echo esc_attr($pix_options['pix_footer_color'])?> !important;
   border-color:<?php echo esc_attr($pix_options['pix_footer_color'])?> !important;
    }
    

    
<?php } ?>  


<?php if($pix_options['pix_loader_bg'] != ''){?>
.ip-header{
  background-color:<?php echo esc_attr($pix_options['pix_loader_bg'])?> !important;
   
}
  
 <?php } ?> 

<?php if($pix_options['pix_custom_css']):?>
	<?php echo $pix_options['pix_custom_css'] ?>
<?php endif?>