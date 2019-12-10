<?php /* Template Name: Contact Form */ ?>

<?php get_header(); ?>



<?php 

	$pix_options = get_option('pix_general_settings'); 

	$options = array(

		$pix_options['pix_contact_error_message'], 

		$pix_options['pix_contact_success_message'],

		$pix_options['pix_subject'],

		$pix_options['pix_email_address']

	);

	

	$custom =  get_post_custom($post->ID);

	$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';

	//$breadcrumbs = $alc_options['alc_show_breadcrumbs'];

	$titles = 0; //$alc_options['alc_show_page_titles'];

?>









<div class="container">





  <?php the_content(); ?>

 

  <div class="row contact-row">

    <div class="col-xs-12 col-sm-12 col-lg-12">

      <form method="POST"  class="form-full-width contact-form contactForm col-xs-12 col-sm-12 col-lg-8 col-lg-offset-2" id="contact-form">

        <div id="status"></div>

        <div class="row">

          <div class="col-xs-12 col-sm-12 col-md-12 ">

            <?php if(isset($nameError) && $nameError != ''): ?>

            <span class="errorarr"><?php echo $nameError;?></span>

            <?php endif;?>

            <div class="form-group">

              <input type="text"  name="contactname" id="contactname" value="" placeholder="<?php _e('Name', 'PixTheme')?>*" />

            </div>

          </div>

  <div class="col-xs-12 col-sm-12 col-md-12 ">

            <?php if(isset($emailError) && $emailError != ''): ?>

            <span class="errorarr"><?php echo $emailError;?></span>

            <?php endif;?>

            <div class="form-group">

              <input type="text" name="contactemail" id="contactemail" value="" placeholder="<?php _e('E-mail', 'PixTheme')?>*" />

            </div>

          </div>

  <div class="col-xs-12 col-sm-12 col-md-12 ">

            <div class="form-group">

              <input type="text" value="" name="contactwebsite" id="contactwebsite" placeholder="<?php _e('Website', 'PixTheme')?>" />

            </div>

          </div>

    

                    <div class="col-xs-12 col-sm-12 col-md-12 ">

            <?php if(isset($messageError) && $messageError != ''): ?>

            <span class="errorarr"><?php echo $messageError;?></span>

            <?php endif;?>

            <div class="form-group">

              <textarea cols="30" rows="10" name="contactmessage" id="contactmessage" ></textarea>

            </div>

          </div>

    

            <div class="col-xs-12 col-sm-12 col-md-12  text-center">

            <div class="wrap-main text-center">

            

              <input name="send" value="<?php _e('Send message', 'PixTheme')?>" type="submit" class="btn btn-main btn-primary btn-lg uppercase" id="contact-submit">

              <input type="hidden" style="display:none !important;" name = "options" value="<?php echo esc_attr(implode('|', $options)) ?>" />

            </div>

          </div>

        </div>

      </form>

    </div>

    

  </div>

</div>



<script type="text/javascript">

<!-- Contact form validation-->

jQuery(document).ready(function(){



  jQuery(".contactForm").validate({

	submitHandler: function() {

	

		var postvalues =  jQuery(".contactForm").serialize();

		

		jQuery.ajax

		 ({

		   type: "POST",

		   url: "<?php echo get_template_directory_uri() ?>/contact-form.php",

		   data: postvalues,

		   success: function(response)

		   {			

		 	 jQuery("#status").html(response).show('normal');

		     jQuery('#contactmessage, #contactemail, #contactname, #contactwebsite').val("Ok");

		   }

		 });

		return false;

		

    },

	focusInvalid: true,

	focusCleanup: false,

	//errorLabelContainer: jQuery("#registerErrors"),

  	rules: 

	{

		contactname: {required: true},

		contactemail: {required: true, minlength: 6,maxlength: 50, email:true},

		contactmessage: {required: true, minlength: 6}

	},

	

	messages: 

	{	

		contactname: {required: "<?php _e( 'Name is required', 'PixTheme' ); ?>"},

		contactemail: {required: "<?php _e( 'E-mail is required', 'PixTheme' ); ?>", email: "<?php _e( 'Please provide a valid e-mail', 'PixTheme' ); ?>", minlength:"<?php _e( 'E-mail address should contain at least 6 characters', 'PixTheme' ); ?>"},

		contactmessage: {required: "<?php _e( 'Message is required', 'PixTheme' ); ?>"}

	},

	

	errorPlacement: function(error, element) 

	{

		error.insertBefore(element);

		jQuery('<span class="errorarr"></span>').insertBefore(element);

	},

	invalidHandler: function()

	{

		//jQuery("body").animate({ scrollTop: 0 }, "slow");

	}

	

});

});



</script>




<?php if (!empty($pix_options['pix_contact_address'])):?>

<div class="map">





<script type="text/javascript">   

  jQuery(function(){

	jQuery('#map_canvas').gmap3(

	  {

		action: 'addMarker',

		address: "<?php echo esc_attr(($pix_options['pix_contact_address']))?>",

		map:{

		  center: true,

		  zoom: 14

		}

		

	  },

	  {action: 'setOptions', args:[{scrollwheel:true}]}

	);

	  

  });

</script> 




<div id="map_canvas" class="gmap3 map_location" style="height:300px;"></div>



</div>




<?php endif?> 



