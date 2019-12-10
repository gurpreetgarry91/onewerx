jQuery(function($){

	// post type toogle
	var postType = $('#post-formats-select').children('input:checked').val();
	if( postType == 0 ){
		$('#post_format .rwmb-meta-box .rwmb-field').not(':eq(0)').hide();
	}
	else{
		$('#post_format .rwmb-meta-box .rwmb-field').hide();
		$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
		$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').fadeIn();
	}
	$('#post-formats-select').children('input').change( function() {

		var postType = $(this).val();
		
		if ( postType == 0 ) {
			$('#post_format .rwmb-meta-box .rwmb-field').not(':eq(0)').hide();
			$('#post_format .rwmb-meta-box .rwmb-field').eq(0).show();
		}
		else{
			$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
			$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').fadeIn();
		}

	});
	

	// portfolio type toogle
	var portfolioType = $("#post_types_select :selected").val();
	$('#post_types .rwmb-meta-box .rwmb-field').not(':eq(0)').hide();
	if(portfolioType != "link"){
		$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
		$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').fadeIn();	
		$('#post_types .rwmb-meta-box .rwmb-field').eq(0).show();
	}
	$('#post_types_select').change( function() {

		var portfolioType = $(this).val();
		if(portfolioType == "link"){
			$('#post_types .rwmb-meta-box .rwmb-field').not(':eq(0)').hide();	
		}
		else{
			$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
			$( 'label[for*="' + portfolioType + '"]' ).closest('.rwmb-field').fadeIn();
			$('#post_types .rwmb-meta-box .rwmb-field').eq(0).show();
		}
	});
	

	// meta box toogle for page
	elem = $('#homepage .rwmb-meta-box .rwmb-field');
	elem.eq(1).hide();
	$('#homepage_slider').change(function(){
		var _value = $(this).find('option:selected').val();
		if(_value == 'slider2') {
			elem.eq(1).show();
		} else { elem.eq(1).hide(); }
	});
});