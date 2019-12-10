<?php
define ( 'JS_PATH' , get_template_directory_uri().'/library/functions/shortcodes/shortcode.js');


add_action('admin_head','html_quicktags');
function html_quicktags() {

	$output = "<script type='text/javascript'>\n
	/* <![CDATA[ */ \n";
	wp_print_scripts( 'quicktags' );

	$buttons = array();
		
	$buttons[] = array(
		'name' => 'title_block',
		'options' => array(
			'display_name' => 'title_block',
			'open_tag' => '\n[title_block]',
			'close_tag' => '[/title_block]\n',
			'key' => ''
	));
	
	
	$buttons[] = array(
		'name' => 'content_block',
		'options' => array(
			'display_name' => 'content_block',
			'open_tag' => '\n[content_block]',
			'close_tag' => '[/content_block]\n',
			'key' => ''
	));
	
	
	
	
	$buttons[] = array(
		'name' => 'one_whole',
		'options' => array(
			'display_name' => 'Full width',
			'open_tag' => '\n[one_whole]',
			'close_tag' => '[/one_whole]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'one_third',
		'options' => array(
			'display_name' => 'one third',
			'open_tag' => '\n[one_third]',
			'close_tag' => '[/one_third]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'two_third',
		'options' => array(
			'display_name' => 'two third',
			'open_tag' => '\n[two_third]',
			'close_tag' => '[/two_third]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_half',
		'options' => array(
			'display_name' => 'one half',
			'open_tag' => '\n[one_half]',
			'close_tag' => '[/one_half]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_fourth',
		'options' => array(
			'display_name' => 'one fourth',
			'open_tag' => '\n[one_fourth]',
			'close_tag' => '[/one_fourth]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'three_fourth',
		'options' => array(
			'display_name' => 'three fourth',
			'open_tag' => '\n[three_fourth]',
			'close_tag' => '[/three_fourth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'one_sixth',
		'options' => array(
			'display_name' => 'one sixth',
			'open_tag' => '\n[one_sixth]',
			'close_tag' => '[/one_sixth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'five_twelveth',
		'options' => array(
			'display_name' => 'five twelveth',
			'open_tag' => '\n[five_twelveth]',
			'close_tag' => '[/five_twelveth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'seven_twelveth',
		'options' => array(
			'display_name' => 'seven twelveth',
			'open_tag' => '\n[seven_twelveth]',
			'close_tag' => '[/seven_twelveth]\n',
			'key' => ''
	));
        
        $buttons[] = array(
		'name' => 'one_twelveth',
		'options' => array(
			'display_name' => 'one twelveth',
			'open_tag' => '\n[one_twelveth]',
			'close_tag' => '[/one_twelveth]\n',
			'key' => ''
	));
        
        $buttons[] = array(
		'name' => 'eleven_twelveth',
		'options' => array(
			'display_name' => 'eleven twelveth',
			'open_tag' => '\n[eleven_twelveth]',
			'close_tag' => '[/eleven_twelveth]\n',
			'key' => ''
	));
        
        $buttons[] = array(
		'name' => 'five_sixth',
		'options' => array(
			'display_name' => 'five sixth',
			'open_tag' => '\n[five_sixth]',
			'close_tag' => '[/five_sixth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'row',
		'options' => array(
			'display_name' => 'Insert Row',
			'open_tag' => '\n[row]',
			'close_tag' => '[/row]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'div_carousel',
		'options' => array(
			'display_name' => 'Insert Div Carousel',
			'open_tag' => '\n[div_carousel]',
			'close_tag' => '[/div_carousel]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'clear',
		'options' => array(
			'display_name' => 'Clear Float',
			'open_tag' => '[clear /]',
			'close_tag' => '',
			'key' => ''
	));
			
	for ($i=0; $i <= (count($buttons)-1); $i++) {
		$output .= "edButtons[edButtons.length] = new edButton('ed_{$buttons[$i]['name']}'
			,'{$buttons[$i]['options']['display_name']}'
			,'{$buttons[$i]['options']['open_tag']}'
			,'{$buttons[$i]['options']['close_tag']}'
			,'{$buttons[$i]['options']['key']}'
		); \n";
	}
	
	$output .= "\n /* ]]> */ \n
	</script>";
	echo $output;
}

function PixTheme_addbuttons() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_pix_custom_tinymce_plugin");
		add_filter('mce_buttons_3', 'register_pix_custom_button');
	}
}
function register_pix_custom_button($buttons) {
	array_push(
		$buttons,
		"title_block",
		"content_block",
		"FeatServ",
		"DealPanel",
		"ReviewsPanel",
		"Animated",
		"Progress",
		"AddButton",
		"Dropdown",
		"Tabs",
		"fTabs",
		"AboutTabs",
		"Toggle",
		"Accordion",
		"Testimonial",
		"Alert",
		"Banner",
		"Carousel",
		"Contact",
		"Fblock",
		"Tblock",
		"Offerblock",
		"BrandBlock"
		); 
	return $buttons;
} 
function add_pix_custom_tinymce_plugin($plugin_array) {
	$plugin_array['PixThemeShortcodes'] = JS_PATH;
	return $plugin_array;
}
add_action('init', 'PixTheme_addbuttons');


/********************* TITLE BLOCK**********************/

function PixTheme_title_block( $atts, $content = null ) {
   return '<h4 class="title_block"><span>' . do_shortcode($content) . '</span></h4>';
}
add_shortcode('title_block', 'PixTheme_title_block');

function PixTheme_content_block( $atts, $content = null ) {
   return '<div class="content_block">' . do_shortcode($content) . '</div>';
}
add_shortcode('content_block', 'PixTheme_content_block');

 


/********************* PANEL **********************/

function pix_panel( $atts, $content = null ) {
 extract(shortcode_atts(array(
		"title" => '',
		"icon" => '',
		"type" => '3' 
	), $atts));	
	
	
	$out = '';
	$finaltitle = ($title == '') ? '': '<h5>'.$title.'</h5>';
	$finallicon = ($icon == '') ? '': '<div class="panel-icon"><i class="fa '.$icon.'  "></i></div>';
	
	
	if ($type == 'regular' || $type=='callout')
	{
		$out = '<div class="panel panel-icon-wrap '.$type.'">'.$finallicon.$finaltitle.do_shortcode($content). '</div>';
	}
	else
	{
		$out = '<div class="widgets  clearfix"><h3>'.$title.'</h3>'.do_shortcode($content). '</div>';
	}
    return $out;
}


add_shortcode('panel', 'pix_panel');

/**************************************************/

/********************* FEATURED SERVICES **********************/

function pix_featserv( $atts, $content = null ) {
 extract(shortcode_atts(array(
		"title" => '',
		"icon" => '' 
	), $atts));	
	
	$out = '';
	$finaltitle = ($title == '') ? '': '<h4>'.$title.'</h4>';
	$finallicon = ($icon == '') ? '': '<i class="fa '.$icon.'"></i>';
	
	$out = '<div class="featured-item animated"  data-animation="fadeInUp" >
	'.$finallicon.$finaltitle.'
	<div class="featcontent">'.do_shortcode($content).'</div>
	</div>'; 
		
    return $out;	
}

add_shortcode('featserv', 'pix_featserv');

/**************************************************/

/********************* DEAl PANEL **********************/

function pix_dealpan( $atts, $content = null ) {
 extract(shortcode_atts(array(
		"title" => '',
		//"icon" => '',
		"offers" => '', 
		"href" => '' 
	), $atts));	
	
	$out = '';
	$finaltitle = ($title == '') ? '': ''.$title.'';
	//$finallicon = ($icon == '') ? '': '<i class="'.$icon.'"></i>';
	$finalloffers = ($offers == '') ? '': ' <span class="chart" data-percent="'.$offers.'"> <span class="percent"></span></span>';
	$finallhref = ($href == '') ? '#': $href;
	
$out = '<div class="wrap-circle-item"><div class="wrap-circle"><span class="span-circle">'.$finalloffers.'</span></div> <span class="span-title">'.$finaltitle.'</span> </div> '; 
		
    return $out;	
}

add_shortcode('dealpan', 'pix_dealpan');

/**************************************************/

/********************* ANIMATED **********************/

function pix_animated( $atts, $content = null ) {
 extract(shortcode_atts(array(
		"animate" => '',		 
	), $atts));	
	
	$out = '<div class="animated" data-animation="'.$animate.'">'.do_shortcode($content).'</div>'; 
		
    return $out;	
}

add_shortcode('animated', 'pix_animated');

/**************************************************/

/********************* REVIEWS PANEL **********************/

function pix_review_group( $atts, $content ) {
	
	$GLOBALS['review_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['reviews'] ) ){
		$count = 1;
		foreach( $GLOBALS['reviews'] as $review ){
			
			$finalimage = ($review['image'] == '') ? '': '<div class="avatar-review"><img src="'.$review['image'].'" alt="Avatar"></div>';
			$finalname = ($review['name'] == '') ? '': '<h3 class="heading">'.$review['name'].'</h3>';
			$finaljob = ($review['job'] == '') ? '': '<h4 class="sub-heading">'.$review['job'].'</h4>';
			
			$out = '<li> <div data-animation="fadeIn" class="team-member-item animated  fadeIn ">';
			$out .= 	$finalimage;
			$out .= '	<div class="details-review">';
			$out .= '		<div class="desc-det">'.do_shortcode($review['content']).'</div>';
			$out .= '		<div class="review-autor">'.$finalname.$finaljob.'</div>';
			$out .= '	</div>';
			$out .= '</div> </li>';			
			
			$reviews[] = $out;
			
			$count ++;
		}
                
		$return = ' <div data-animation="bounceInRight" class="animated reviews-frame">
        				<ul class="review-slider" >
							'.implode( "\n", $reviews ).'
						</ul>
					</div>
					 <div class="sly_scrollbar">
      <div class="handle"></div>
    </div>';	
	}
	return $return;
			
}

add_shortcode('reviewgroup', 'pix_review_group');

/***********/

function pix_review( $atts, $content ){
	extract(shortcode_atts(array(
		"image" => '',
		"name" => '',
		"job" => '',
	), $atts));
	
	$x = $GLOBALS['review_count'];
	$GLOBALS['reviews'][$x] = array( 'image' => $image, 'name' => $name, 'job' => $job, 'content' => $content );
	
	$GLOBALS['review_count']++;
}
add_shortcode( 'review', 'pix_review' );

/**************************************************/

/***************** PROGRESS BAR *******************/

function pix_progressbar( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"type" => '',
		"meter" => '',
		"style" => '',
		"animated" => '',
		"class" => '',
	), $atts));	
	$out = '

	<div class="progress-bar '.$type.' '.$style.' '.$animated.' '.$class.'">
		<div class="progress-'.$meter.'" ></div>
	</div>';
    return $out;
}
add_shortcode('progressbar', 'pix_progressbar');

/************************************************/

/*************** Dropdown buttons ***************/

function pix_dropbutton_group( $atts, $content ){
	extract(shortcode_atts(array(
		'title' => '',
		'title' => '',
		'type'	=> ''
	), $atts));
	$GLOBALS['dropbutton_count'] = 0;
	$randomId = mt_rand(0, 100000);
	
	do_shortcode( $content );
	$counter = 1;
	if( is_array( $GLOBALS['dropbuttons'] ) ){
		foreach( $GLOBALS['dropbuttons'] as $dropbutton ){
			$dropbuttons[] = '<li><a href="'.$dropbutton['url'].'">'.do_shortcode($dropbutton['content']).'</a></li>';
			if ($dropbutton['divider'] == 1)
			{
				$dropbuttons[] = '<li class="divider"></li>';
			}
		}
		$return='<div class="btn-group">';
		if ($type == 'split')
		{
			$return.='<button class="btn '.$type.'" >'.$title.' '.'</button><button class="btn dropdown-togle" data-toggle="dropdown"><span class="caret"><span></button>';
		}
		else
		{	
			$return.= '<a class="btn btn-shorty '.$type.' dropdown-toggle" data-toggle="dropdown">'.$title.' '.'<span class="caret"><span></a>';
		}
		$return.= '<ul class="dropdown-menu" id="'.$randomId.'" style="top: 38px;">'.implode( "\n", $dropbuttons ).'</ul>';
                $return.='</div>';
	}
	return $return;
}
add_shortcode( 'dropbuttongroup', 'pix_dropbutton_group' );
/*****************/


function pix_dropbutton( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => '',
	'url' => '',
	'divider' => '',
	), $atts));
	
	$x = $GLOBALS['dropbutton_count'];
	$GLOBALS['dropbuttons'][$x] = array( 'title' => $title, 'url' => $url, 'divider' => $divider, 'content' =>  $content );
	
	$GLOBALS['dropbutton_count']++;
}

add_shortcode( 'dropbutton', 'pix_dropbutton' );
/************************************************/

/******************* BUTTONS ********************/

function pix_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'size' => 'medium',
		'link' => '#',

		'color' => '',

        'status'=>'',

		'target' => '',
        'icon'=>''
	), $atts));

	$target = ($target) ? ' target="_blank"' : '';
 
	$out = '<a href="'.$link.'"'.$target.' class="btn btn-shorty  '.$size.' '.$color.' '.$status.'"><i class="fa '.$icon.'"></i>'.do_shortcode($content).'</a>';
    return $out;
}
add_shortcode('button', 'pix_button');

/************************************************/

/******************TABS****************************/
function pix_tab_group( $atts, $content ){
	
	$GLOBALS['tab_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['tabs'] ) ){
		$count = 1;
		foreach( $GLOBALS['tabs'] as $tab ){
			$randomId = mt_rand(0, 100000);
			$active = $count == 1 ? ' active' : 'fade';
			$active2 = $count == 1 ? 'class="active"' : '';
			$tabs[] = '<li '.$active2.'><a href="#'.$randomId.'" data-toggle="tab">'.$tab['title'].'</a></li>';
			$cont[]='<div class="tab-pane '.$active.'" id="'.$randomId.'">'.do_shortcode($tab['content']).'</div>';
			$count ++;
		}
                
		$return = '<ul  class="nav nav-tabs">'.implode( "\n", $tabs ).'</ul><div class="tab-content">'.implode("\n", $cont).'</div>';

	}
	return $return;
}
add_shortcode( 'tabgroup', 'pix_tab_group' );

/***********/

function pix_tab( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'Tab %d',
	), $atts));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	
	$GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'pix_tab' );


/************************************************/

/******************FTABS****************************/
function pix_ftab_group( $atts, $content ){
	
	$GLOBALS['ftab_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['ftabs'] ) ){		
		$count = 1;
		foreach( $GLOBALS['ftabs'] as $tab ){
			$randomId = mt_rand(0, 100000);
			$active = $count == 1 ? ' active' : 'fade';
			$active2 = $count == 1 ? 'class="active"' : '';
			$tabs[] = '<li '.$active2.'>
			
			<i class="fa '.$tab['icon'].'"></i><a data-toggle="tab" href="#'.$randomId.'">'.$tab['title'].'</a>
			
			
			</li>';
			$ul = "";
			for($i=1; $i<=12; $i++){
				$kp = "kp".$i;
				if($tab[$kp]){
					$ul .= '<li><span aria-hidden="true" class="icon-check"></span>'.$tab[$kp].'</li>';
				}
			}
			if($ul)
				$ul = '<ul class="check-list">'.$ul.'</ul>';
			$cont[]='<div id="'.$randomId.'" class="tab-pane '.$active.'">
						<div class="col-xs-12 col-sm-5 col-lg-5  ">
							<article class="clearfix text-left"> 
								<i class="tab-content-icon fa  '.$tab['icon'].'"></i> 
								<h3>'.$tab['title'].'</h3>
								'.do_shortcode($tab['content']).'
							</article>
          				</div>
						<div class="col-xs-12 col-sm-4 col-lg-3">
            				<article class="clearfix text-left">
							
							
								'.$ul.'	
							</article>
			            </div>
					 </div>';
			$count ++;
		}
                
		$return = ' <div id="Services2" class="container list-service">
						<div class="row ">
							<div class="col-lg-3 col-md-3 col-sm-3 ">
								<article class=" clearfix text-left">
									<ul class="nav nav-tabs ">
										'.implode( "\n", $tabs ).'
									</ul>
								</article>
							</div>
							<div class="tab-content">
								'.implode("\n", $cont).'
							</div>
						</div>
					</div>';

	}
	return $return;
}
add_shortcode( 'ftabgroup', 'pix_ftab_group' );

/***********/

function pix_ftab( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'Tab %d',
	'icon' => '',
	'kpname' => '',
	'kp1' => '',
	'kp2' => '',
	'kp3' => '',
	'kp4' => '',
	'kp5' => '',
	'kp6' => '',
	'kp7' => '',
	'kp8' => '',
	'kp9' => '',
	'kp10' => '',
	'kp11' => '',
	'kp12' => '',
	), $atts));
	
	$x = $GLOBALS['ftab_count'];
	$GLOBALS['ftabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['ftab_count'] ), 'icon' => $icon, 'kpname' => $kpname, 'kp1' => $kp1, 'kp2' => $kp2, 'kp3' => $kp3, 'kp4' => $kp4, 'kp5' => $kp5, 'kp6' => $kp6, 'kp7' => $kp7, 'kp8' => $kp8, 'kp9' => $kp9, 'kp10' => $kp10, 'kp11' => $kp11, 'kp12' => $kp12, 'content' =>  $content );
	
	$GLOBALS['ftab_count']++;
}
add_shortcode( 'ftab', 'pix_ftab' );


/************************************************/

/******************ABOUTTABS****************************/
function pix_atab_group( $atts, $content ){
	
	$GLOBALS['atab_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['atabs'] ) ){		
		$count = 1;
		foreach( $GLOBALS['atabs'] as $tab ){
			$randomId = mt_rand(0, 100000);
			$active = $count == 1 ? ' active' : 'fade';
			$active2 = $count == 1 ? 'class="active"' : '';
			$tabs[] = '<li '.$active2.'>
			
			<a data-toggle="tab" href="#'.$randomId.'"><i class="'.$tab['icon'].'"></i>
			
			<div class="ftitle-content">
			<h3 class="atab-title">'.$tab['title'].'</h3>
			
			'.do_shortcode($tab['content']).
			
			'</div>
			
			</a></li>';
			$cont[]='<div id="'.$randomId.'" class="tab-pane '.$active.'">
						<article class="clearfix animated text-left "> 
							<img src="'.$tab['image'].'" class="img-responsive" alt="about">
						</article>
          			</div>';
			$count ++;
		}
                
		$return = ' <div class="row animated" data-animation="bounceInRight">
						<div class="col-xs-12 col-sm-6 col-lg-6">
        					<article class="clearfix animated text-left animated" data-animation="fadeInDown">
								<ul class="nav nav-tabs atabs ">
									'.implode( "\n", $tabs ).'
								</ul>
							</article>
						</div>
						<div class="tab-content atabs atabs-img  col-xs-12 col-sm-6 col-lg-6">
						'.implode("\n", $cont).'
						</div>
					</div>';

	}
	return $return;
}
add_shortcode( 'atabgroup', 'pix_atab_group' );

/***********/

function pix_atab( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'Tab %d',
	'icon' => '',
	'image' => '',
	), $atts));
	
	$x = $GLOBALS['atab_count'];
	$GLOBALS['atabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['atab_count'] ), 'icon' => $icon, 'image' => $image, 'content' =>  $content );
	
	$GLOBALS['atab_count']++;
}
add_shortcode( 'atab', 'pix_atab' );


/************************************************/

/****************** TOGGLES *********************/

function pix_toggle_group( $atts, $content ){
	
	$GLOBALS['toggle_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['toggles'] ) ){
		foreach( $GLOBALS['toggles'] as $toggle ){
			$toggles[] = '
			<div class="toggle-wrapper">
				<a href="#" class="toggle-trigger">'.$toggle['title'].'</a>                  
				<div class="toggle-container">
					'.do_shortcode($toggle['content']).'
				</div>                  
			</div>';	
		}
		$return = implode( "\n", $toggles );
	}
	return $return;

}
add_shortcode( 'togglegroup', 'pix_toggle_group' );


function pix_toggle( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'toggle %d',
	), $atts));
	
	$x = $GLOBALS['toggle_count'];
	$GLOBALS['toggles'][$x] = array( 'title' => sprintf( $title, $GLOBALS['toggle_count'] ), 'content' =>  $content );
	
	$GLOBALS['toggle_count']++;
}
add_shortcode( 'toggle', 'pix_toggle' );
/************************************************/



/***************** ACCORDION ********************/

function pix_accordion_group( $atts, $content ){
	
	$GLOBALS['accordion_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['accordions'] ) ){
		$count = 1;
		foreach( $GLOBALS['accordions'] as $accordion ){
            $randomId = mt_rand(0, 100000);
			$active = $count == 1 ? ' in' : '';
			$accordions[] = ' 
				<div class="panel panel-default">
    				<div class="panel-heading">
     					<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$randomId.'">'.$accordion['title'].'</a>
						</h4>
    				</div>                  
					<div id="collapse'.$randomId.'" class="panel-collapse collapse '.$active.'">
      					<div class="panel-body">
							'.do_shortcode($accordion['content']).'
						</div>
					</div>
				</div>                                
			';	
			$count ++;
		}
		$return = '<div class="panel-group" id="accordion">'.implode( "\n", $accordions ).'</div>';
	}
	return $return;
}



add_shortcode( 'accordiongroup', 'pix_accordion_group' );
/***************/

function pix_accordion( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'accordion %d',
	), $atts));
	
	$x = $GLOBALS['accordion_count'];
	$GLOBALS['accordions'][$x] = array( 'title' => sprintf( $title, $GLOBALS['accordion_count'] ), 'content' =>  $content );
	
	$GLOBALS['accordion_count']++;
}

add_shortcode( 'accordion', 'pix_accordion' );
/************************************************/


/*************** TESTIMONIALS ********************/
function pix_testimonial( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"authorname"	=> '', 
		"authorposition"	=> ''
	), $atts));

	$out = '<div class="testimonial-block"><div class="testimonial-content"><p>'.do_shortcode($content).'</p></div><cite>'.$authorname.'</cite><p class="test_author">'.$authorposition.'</p></div>';
    return $out;
}
add_shortcode('testimonial', 'pix_testimonial');

/************************************************/



/******************* Alertbox *******************/

function pix_alert( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"type"=>'',
		"title" => ''
	), $atts));	
	$out = '
	<div class="alert '.$type.'">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4 class="alert-heading">'.$title.'</h4>
		'.do_shortcode($content).'
	</div>';
   return $out;
}
add_shortcode('alert', 'pix_alert');




/******************* Bannerbox *******************/

function pix_banner( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"type"=>'',
		"alertbg"=>'',
		"alerturl"=>'',
		"title" => ''
	), $atts));	
	$out = '
	<a href="'.$alerturl.'">
	
	<div class="short-banner page-img"  '.$type.'" style="background-image:url('.$alertbg.')">				<h3 class="alert-heading">'.$title.'</h3>	
	<div class="content-banner">	'.do_shortcode($content).' </div> 	</div></a>';
   return $out;
}
add_shortcode('banner', 'pix_banner');



/************************************************/


/***********  VIDEOS  ****************/

function pix_video($atts, $content=null) {
	extract(
		shortcode_atts(array(
			'site' => 'youtube',
			'id' => '',
			'width' => '',
			'height' => '',
			'autoplay' => '0'
		), $atts)
	);
	if ( $site == "youtube" ) { $src = 'http://www.youtube.com/embed/'.$id.'?autoplay='.$autoplay; }
	else if ( $site == "vimeo" ) { $src = 'http://player.vimeo.com/video/'.$id.'?autoplay='.$autoplay; }
	else if ( $site == "dailymotion" ) { $src = 'http://www.dailymotion.com/embed/video/'.$id.'?autoplay='.$autoplay; }
	else if ( $site == "veoh" ) { $src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay='.$autoplay.'&permalinkId='.$id; }
	else if ( $site == "bliptv" ) { $src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id; }
	else if ( $site == "viddler" ) { $src = 'http://www.viddler.com/embed/'.$id.'e/?f=1&offset=0&autoplay='.$autoplay; }
	
	if ( $id != '' ) {
		return '<div class="flex-video"><iframe width="'.$width.'" height="'.$height.'" src="'.$src.'" class="vid iframe-'.$site.'"></iframe></div>';
	}
}
add_shortcode('video','pix_video');

/************************************************/


/************************************************/


/****************** SLIDER ********************/


function pix_slider( $atts, $content ){
	$GLOBALS['slideritem_count'] = 0;
	extract(shortcode_atts(array(
		'interval' => '500'
	), $atts));
	do_shortcode( $content );
		
	if( is_array( $GLOBALS['sitems'] ) ){
		$icount = 0;
		foreach( $GLOBALS['sitems'] as $item ){
			$itemlink = empty ($item['link']) ? '#' : $item['link'];
			$panes[] = '
			<div class="slides">
				<a href="'.$itemlink.'"><img src="'.$item['image'].'" alt="" /></a>
				<div class="overlay">'.do_shortcode($item['content']).'</div>
			</div>';   		
			$icount ++ ;
		}
		$randomId = mt_rand(0, 100000);
		$return ='
		
		<div class="slider">
			<div class="slider-slides">'.implode( "\n", $panes ).'</div>
			<a href="#" class="next"></a>
			<a href="#" class="prev"></a>
			<div class="slider-btn"></div>
		</div>';
			
	}
	return $return;
}
add_shortcode('slider', 'pix_slider' );

/****/



function pix_slideritem( $atts, $content ){
	extract(shortcode_atts(array(
		'image' => '',
		'link' => '',
	), $atts));
	
	$x = $GLOBALS['slideritem_count'];
	$GLOBALS['sitems'][$x] = array( 'image' => $image, 'link' => $link, 'content' =>  $content );
	
	$GLOBALS['slideritem_count']++;
	
}
add_shortcode( 'slideritem', 'pix_slideritem' );

/************************************************/

/****************Orbit Slider********************/
function pix_oslider( $atts, $content ){
	$GLOBALS['oslideritem_count'] = 0;
	extract(shortcode_atts(array(
		'interval' => '500'
	), $atts));
	do_shortcode( $content );
		
	if( is_array( $GLOBALS['ositems'] ) ){
		$icount = 0;
		foreach( $GLOBALS['ositems'] as $item ){
			$panes[] = '<li><img src="'.$item['image'].'" alt="'.$item['title'].'" title="'.$item['title'].'" />
                                    <div class="orbit-caption">'.do_shortcode($item['title']).'</div></li>';   		
			$icount ++ ;
		}
		
		$return ='<div class="orbit-container orbit-stack-on-small"><ul class="orbit-slides-conainer" data-orbit="">'.implode( "\n", $panes ).'</ul></div>
                    <script type=text/javascript>
                        jQuery(document).foundation("orbit", {
                        container_class: "orbit-container",
                         next_class: "orbit-next",
                          next_class: "orbit-next",
                          timer_speed: '.$interval.',
                        })
                    </script>';	
	}
	return $return;
}
add_shortcode('oslider', 'pix_oslider' );

/****/

function pix_oslideritem( $atts, $content ){
	extract(shortcode_atts(array(
		'image' => '',
		'title' => '',
	), $atts));
	
	$x = $GLOBALS['oslideritem_count'];
	$GLOBALS['ositems'][$x] = array( 'image' => $image, 'title' => $title, 'content' =>  $content );
	
	$GLOBALS['oslideritem_count']++;
	
}
add_shortcode( 'oslideritem', 'pix_oslideritem' );


/************************************************/


/*************** Carousel Slider ****************/

function pix_carousel( $atts, $content ){
	$GLOBALS['caritem_count'] = 0;
	extract(shortcode_atts(array(
		'title' => '',
		'type' => 'custom',
		'automatic' => 'false',
		'min' => '1',
		'max' => '6'
	), $atts));
	$randomId = mt_rand(0, 100000);
	$panes = array();	
	$return = '';
	do_shortcode ($content);
	if(isset( $GLOBALS['caritems']) && is_array( $GLOBALS['caritems'] ) ){
		$return.='
		<div class="clients-carousel">
	
					
				<header class="section-header animated " data-animation="bounceInLeft">
        
          <div class="heading-wrap">
            <h2 class="heading"><span>'.$title.'</span></h2>
          </div>

        </header>
		
				</div>
				
				
				
		
		
				<div class="work_slide">
			
					
				
					<ul class="work_slide'.$randomId.'"  id="'.$type.'">';
						foreach( $GLOBALS['caritems'] as $item ){
							$panes[] = '<li>'.$item['content'].'</li>';   		
						}		
						$return.=implode( "\n", $panes ).'
					</ul>
				
		</div>';
		$return.="
		<script type=\"text/javascript\">
		jQuery(function($) {
				
				 var windowHeight = $(window).height();
     var windowWidth = $(window).width();
	 
	 
	    if (windowWidth >  1000 ) {
				
                $('.work_slide".$randomId."').bxSlider({
                    slideWidth: 270,
                    minSlides:".$min." ,
                    maxSlides: ".$min.",
                    slideMargin: 0,
                    auto: ".$automatic."
                });
				
		}
		
		
		else{
			
			
			 if (windowWidth >  800 ) {
				 
				 
				 
			   $('.work_slide".$randomId."').bxSlider({
                    slideWidth: 270,
                    minSlides:2,
                    maxSlides: 2,
                    slideMargin: 0,
                    auto: ".$automatic."
                });
				 
				 
				 }
				 
				 else{
					 
					 	 
				 
			   $('.work_slide".$randomId."').bxSlider({
                    slideWidth: 270,
                    minSlides:1,
                    maxSlides: 1,
                    slideMargin: 0,
                    auto: ".$automatic."
                });
				
				
				 }
			
			
			
			
			
			}
				
				
	
				
				
				
				
			
			});
		</script>";
	}
	return $return;
}

add_shortcode('carousel', 'pix_carousel' );
/***/

function pix_caritem( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => '',
	), $atts));
	$x = $GLOBALS['caritem_count'];
	$GLOBALS['caritems'][$x] = array('title' => $title, 'content' =>  do_shortcode ($content) );
	$GLOBALS['caritem_count']++;	
}
add_shortcode( 'caritem', 'pix_caritem' );

/************************************************/


/*************** Contact details ****************/

function pix_contact_group( $atts, $content = null ) {
     	
	$GLOBALS['contact_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['contacts'] ) ){
		$count = 1;
		foreach( $GLOBALS['contacts'] as $contact ){
			
			$out = '<li>
			<div data-animation="fadeIn" class="team-member  animated  fadeIn">
					  <div class="avatar-team"> <img src="'.$contact['avatar'].'" alt="Avatar" ></div>
					  <div class="details">    
					 ';
			
				if ($contact['name']) $out.='<h3 class="heading heading-name">'.$contact['name'].'</h3>';
				if ($contact['postition']) $out.='<h3 class="sub-heading heading-position">'.$contact['postition'].'</h3>';
			$out.='				
						<div class="desc-det"> 		
							<p>'.do_shortcode($contact['content']).'</p>
						  <section class="progress-section active">
							<div class="level-skill">Skill Level:</div>
							<div class="progress-bar">
							  <div class="progress-'.$contact['skill'].'"></div>
							</div>
						  </section>
						</div>                
			';
			
			if($contact['fb'] || $contact['twitter'] || $contact['google'] || $contact['linkedin']){
				$out .= '<ul class="unstyled clearfix social-team">';
					if ($contact['fb']) $out.='<li><a href="'.$contact['fb'].'" target="_blank"><i class="icomoon-facebook"></i></a></li>';
					if ($contact['twitter']) $out.='<li><a href="'.$contact['twitter'].'" target="_blank"><i class="icomoon-twitter"></i></a></li>';
					if ($contact['google']) $out.='<li><a href="'.$contact['google'].'" target="_blank"><i class="icomoon-googleplus"></i></a></li>';
					if ($contact['linkedin']) $out.='<li><a href="'.$contact['linkedin'].'" target="_blank"><i class="icomoon-linkedin"></i></a></li>';
				$out .= '</ul>';
			}
			$out.='                
					  </div>
					</div>
			</li>';
			
			$contacts[] = $out;
			
			$count ++;
		}
                
		$return = ' 
							<div data-animation="bounceInRight" class="animated team-frame">
								<ul class="team-slider" >
									'.implode( "\n", $contacts ).'
								</ul>
							</div>
				 <div class="sly_scrollbar">
      <div class="handle"></div>
    </div>
						';	
	}
	return $return;
	
   
}
add_shortcode('contactgroup', 'pix_contact_group');


/***********/

function pix_contact( $atts, $content ){
	extract(shortcode_atts(array(
	 	"avatar" => '',
	 	"name" => '',
		"postition" => '',
		"skill" => '',
		"fb" => '',
		"twitter" => '',
		"google" => '',
		"linkedin" => ''
	), $atts));
	
	$x = $GLOBALS['contact_count'];
	$GLOBALS['contacts'][$x] = array( 'avatar' => $avatar, 'name' => $name, 'postition' => $postition, 'skill' => $skill, 'fb' => $fb, 'twitter' => $twitter, 'google' => $google, 'linkedin' => $linkedin, 'content' => $content );
	
	$GLOBALS['contact_count']++;
}
add_shortcode( 'contact', 'pix_contact' );


/************************************************/


/**************************FEATURED BLOCK****************/
function pix_fblock($atts, $content=NULL){
    extract(shortcode_atts(array(
		'icon'=>'', 
        'link'=>''
    ), $atts));
    
   
    $out='<div class="offers"><figure>';
    $out.='<a href="'.$link.'"><img src="'.$icon.'" alt="" /></a>';
    $out.='<div class="overlay">'.do_shortcode($content).'</div>';
    $out.='</figure></div>';
    return $out;
}
add_shortcode('fblock', 'pix_fblock');


/*********************************************************/

/***************TITLE BLOCK***************************/
function pix_tblock($atts, $content=NULL){
    extract(shortcode_atts(array(
        'title'=>'',
    ), $atts));
    
    $out='<div class="container">
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
	  <header class="section-header animated " data-animation="bounceInLeft">
     
        <div class="heading-wrap">
          <h2 class="heading"><span>'.$title.'</span></h2>
        </div>
		<p>'.do_shortcode($content).'</p>
      </header></div></div></div>'; 
    
    return $out;
}

add_shortcode('tblock', 'pix_tblock');

/******************************************************/

/***************TITLE BLOCK SIMPLE***************************/
function pix_oblock($atts, $content=NULL){
    extract(shortcode_atts(array(
        'title'=>'',
    ), $atts));
    
	$out='<div class="container">
		<div class="row ">
		  <div class="col-md-offset-3 col-md-6">
			<header class="section-header section-header-type2 animated " data-animation="bounceInRight">
			  <div class="heading-wrap">
				<h2 class="heading heading-type2"><span>'.$title.'</span></h2>
			  </div>
			  <p>'.do_shortcode($content).'</p>
			</header>
		  </div>
		</div>
	  </div>';
	    
    return $out;
}

add_shortcode('oblock', 'pix_oblock');

/******************************************************/

/***************BRAND BLOCK***************************/
function pix_brandblock($atts, $content=NULL){
    extract(shortcode_atts(array(
        'url'=>'',
		'image'=>'',
    ), $atts));
    
    $out='<div class="brand-logo col-xs-3 col-sm-3 col-lg-3"><a href="'.$url.'"><img alt="img" src="'.$image.'" class=""></a></div>';
    
    return $out;
}

add_shortcode('brandblock', 'pix_brandblock');

/******************************************************/

/****************************REVEAL Modal BOX****************/

function pix_reveal($atts, $content=NULL){
    extract(shortcode_atts(array(
        'size'=>'',
        'color'=>'',
        'button'=>'',

        'revtitle'=>'',
    ), $atts));
    $randomId=  mt_rand(0, 100000);
    
    $out='<a data-toggle="modal" href="#'.$randomId.'" class="btn '.$color.' '.$size.'">'.$button.'</a>';
    $out.='<div id="'.$randomId.'" class="modal fade">
            <div class="modal-header">'.$revtitle.'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            <div class="modal-body">'.do_shortcode($content).'</div>
	</div>';
return $out;
}

add_shortcode('reveal', 'pix_reveal');

/*****************************************************/





/****************************Popover Modal BOX****************/

function pix_popover($atts, $content=NULL){
    extract(shortcode_atts(array(        
        'icon'=>'',
        'title'=>'',
    ), $atts));
    $randomId=  mt_rand(0, 100000);
    
    $out='
	
	<div class="popover-button"  id="'.$randomId.'">
        
	<a  href="#'.$randomId.'" class="btn">
	
	<i class="'.$icon.'"></i></a>'; 
	
	/***** Тут нада вместо статичной иконки подрубить revicon  *******/
	
    $out.='
	
	 <div class="popover bottom">
      <div class="arrow"></div>
      <h3 class="popover-title">'.$title.'</h3>

      <div class="popover-content">
           '.do_shortcode($content).'
      </div>
      
    </div>
    
    
    </div>
	';
return $out;
}

add_shortcode('popover', 'pix_popover');

/*****************************************************/




/*********************TOOLTIP*********************/

function pix_tooltip($atts, $content=NULL){
    extract(shortcode_atts(array(
        'text'=>'',
        
    ),$atts));

    $out = '<span class="tooltip" title="'.do_shortcode($content).'">'.do_shortcode($text).'</button>';

    return $out;
}

add_shortcode('tooltip', 'pix_tooltip');
/************************************************/

/****** SHOW POSTS BY CATEGORY AND COUNT **********/

function pix_list_posts( $atts )
{
	extract( shortcode_atts( array(
		'category' => '',
        'type' => '',
		'limit' => '5',
		'order' => 'DESC',
		'orderby' => 'date',
	), $atts) );

	$return = '';

	$query = array();

	if ( $category != '' )
		$query[] = 'category=' . $category;

	if ( $limit )
		$query[] = 'numberposts=' . $limit;

	if ( $order )
		$query[] = 'order=' . $order;

	if ( $orderby )
		$query[] = 'orderby=' . $orderby;

	$posts_to_show = get_posts( implode( '&', $query ) );
        
    if ($type == 1)
	{
		$counter = 1;
		$return.='
		<h3>'.$title.'</h3>
		<div class="work_slide2">
			<ul id="work_slide2">';
				foreach ($posts_to_show as $ps) 
				{
					$day = get_the_time('d', $ps->ID);
					$month = get_the_time('M', $ps->ID);
					if ($counter ==1) $return.='<li>';
						$return.='
						<article class="row collapse"><div class="small-5 columns"><div class="mod_con_img">';
							$thumbnail = get_the_post_thumbnail($ps->ID, 'blog-thumb3'); $postmeta = get_post_custom($ps->ID); 
						if(!empty($thumbnail) && !isset($postmeta['_post_video'])):
							$return.='<a href="'.get_permalink( $ps->ID ).'" class="post-image">'.$thumbnail.'</a>';
							elseif (isset($postmeta['_post_video'])):
							$return.='<iframe src="http://player.vimeo.com/video/'.$postmeta['_post_video'][0].'" width="146" height="96" class="post-image"></iframe>';
						else: 
							$return.='
							<a href="'.get_permalink( $ps->ID ).'" class="post-image">
								<img src = "http://placehold.it/155x112" alt="'.__('No image', 'PixTheme').'" />
							</a>';
						endif;
					$return.='<ul class="meta">
								<li>
									<span class="icon-time"></span>
									<time datetime="'.get_the_time('Y-m-d').'">'.get_the_time('M d, Y').'</time>
								</li>
							  </ul>
							</div>
						 </div>';
					$return.='<div class="small-7 columns">
								<div class="mod_con_text">
									<h5>'.$ps->post_title.'</h5>
								<p>'.pixtheme_limit_words(pixtheme_getPageContent($ps->ID), 15).'</p>
								<a href="'.get_permalink( $ps->ID ).'">'.__('Read More', 'PixTheme').'</a>
							  </div>
						 </div>
					</article>';
					
				}
			$return.='</li> </ul>
                        <div class="clearfix"></div>
                        <a class="prev2" id="slide_prev2" href="#"><img src="'. get_template_directory_uri().'/images/arrow_left.png" alt="'.__('Prev', 'PixTheme').'"></a>
                        <a class="next2" id="slide_next2" href="#"><img src="'. get_template_directory_uri().'/images/arrow_right.png" alt="'.__('Next', 'PixTheme').'"></a>                            
                       </div></div></div>';
                        $return.="<script type=\"text/javascript\">
			jQuery(window).load(function(){
				jQuery('#work_slide2').carouFredSel({
					responsive: true,
					width: '100%',
					auto: false,
					circular	: true,
					infinite	: true,
                                        scroll: {items:1, pauseOnHover: true},
					prev : {button: \"#slide_prev2\", key	: \"left\"},
					next : {button	: \"#slide_next2\", key : \"right\"},
					swipe: {onMouse: true, onTouch: true},
					items: {visible: {min: 1,max: 6}
					}
				});
			});
		</script>";
	}
	else
	{
		$return = '<ul class="no-bullet recent-posts m0 p0">';		
		foreach ($posts_to_show as $ps) 
		{
			$day = get_the_time('d', $ps->ID);
			$month = get_the_time('M', $ps->ID);
			$return.='
			<li>
				<article class="row collapse">
					<div class="small-5 columns">
						<div class="mod_con_img">';
							$thumbnail = get_the_post_thumbnail($ps->ID, 'blog-thumb3'); $postmeta = get_post_custom($ps->ID); 
							if(!empty($thumbnail) && !isset($postmeta['_post_video'])):
								$return.='<a href="'.get_permalink( $ps->ID ).'" class="post-image">'.$thumbnail.'</a>';
							elseif (isset($postmeta['_post_video'])):
								$return.='<iframe src="http://player.vimeo.com/video/'.$postmeta['_post_video'][0].'" width="146" height="96" class="post-image"></iframe>';
							else: 
								$return.='<a href="'.get_permalink( $ps->ID ).'" class="post-image">
									<img src = "http://placehold.it/155x112" alt="'.__('No image', 'PixTheme').'" />
								</a>';
							endif;
							$return.='
							<ul class="meta">
								<li>
									<span class="icon-time"></span>
									<time datetime="'.get_the_time('Y-m-d', $ps->ID).'">'.get_the_time('M d, Y', $ps->ID).'</time>
								</li>
							</ul>
						</div>
					</div>';
					$return.='
					<div class="small-7 columns">
						<div class="mod_con_text">
							<h5>'.$ps->post_title.'</h5>
							<p>'.pixtheme_limit_words(pixtheme_getPageContent($ps->ID), 15).'</p>
							<a href="'.get_permalink( $ps->ID ).'">'.__('Read More', 'PixTheme').'</a>
						</div>
					</div>
				</article>
			</li>';
		}
		$return.='</ul>';                
	}
	
	return $return;
}

add_shortcode('list_posts', 'pix_list_posts');

/************************************************/

/*************** SOCIAL BUTTONS *****************/
function pix_social($atts, $content=NULL){
    $GLOBALS['soc_button_count']=0;
    if(is_array($GLOBALS['soc_buttons'])){
        foreach ($GLOBALS['soc_buttons'] as $soc){
            $soc_buttons[]='<a href="'.$soc['link'].'" class="'.$soc['icon'].'" target="_blank"><i ></i></a>';
        }
        $out='<div class="social-icon">'.implode("\n", $soc_buttons).'</div>';
    }
    return $out;
}

add_shortcode('social', 'pix_social');

/*********************/
function pix_soc_button($atts, $content=NULL){
    extract(shortcode_atts(array(
        'icon'=>'',
        'link'=>''
    ), $atts));
    
    $x= $GLOBALS['soc_button_count'];
    $GLOBALS['soc_buttons'][$x]=array('icon'=> $icon, 'link'=>$link);
    $GLOBALS['soc_button_count']++;

} 

add_shortcode('soc_button', 'pix_soc_button');
/**************************************************/


/******************* COLUMNS ********************/

function PixTheme_one_whole( $atts, $content = null ) {
   return '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_whole', 'PixTheme_one_whole');

function PixTheme_one_half( $atts, $content = null ) {
   return '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'PixTheme_one_half');

function PixTheme_one_third( $atts, $content = null ) {
   return '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'PixTheme_one_third');

function PixTheme_two_third( $atts, $content = null ) {
   return '<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'PixTheme_two_third');

function PixTheme_one_fourth( $atts, $content = null ) {
   return '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'PixTheme_one_fourth');

function PixTheme_three_fourth( $atts, $content = null ) {
   return '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'PixTheme_three_fourth');

function PixTheme_one_sixth( $atts, $content = null ) {
   return '<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'PixTheme_one_sixth');

function PixTheme_five_twelveth( $atts, $content = null ) {
   return '<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_twelveth', 'PixTheme_five_twelveth');

function PixTheme_seven_twelveth( $atts, $content = null ) {
   return '<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">' . do_shortcode($content) . '</div>';
}
add_shortcode('seven_twelveth', 'PixTheme_seven_twelveth');


function PixTheme_one_twelveth( $atts, $content = null ) {
   return '<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_twelveth', 'PixTheme_one_twelveth');

function PixTheme_eleven_twelveth( $atts, $content = null ) {
   return '<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">' . do_shortcode($content) . '</div>';
}
add_shortcode('eleven_twelveth', 'PixTheme_eleven_twelveth');

function PixTheme_five_sixth( $atts, $content = null ) {
   return '<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'PixTheme_five_sixth');

function PixTheme_row( $atts, $content = null ) {
   return '<div class="row">' . do_shortcode($content) . '</div>';
}
add_shortcode('row', 'PixTheme_row');

function PixTheme_div_carousel( $atts, $content = null ) {
   return '<div class="width-carousel">' . do_shortcode($content) . '</div>';
}
add_shortcode('div_carousel', 'PixTheme_div_carousel');


/************************************************/



/***************** CLEAR ************************/

function pix_clear($atts, $content = null) {	
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'pix_clear');


/******** SHORTCODE SUPPORT FOR WIDGETS *********/

if (function_exists ('shortcode_unautop')) {
	add_filter ('widget_text', 'shortcode_unautop');
}
add_filter ('widget_text', 'do_shortcode');

/************************************************/
?>