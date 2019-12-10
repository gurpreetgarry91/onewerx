jQuery(function($){

	var postType = $('#post-formats-select').children('input:checked').val();


	//$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').fadeIn();

	$('#post-formats-select').children('input').change( function() {

		var postType = $(this).val();
		if ( postType == 0 ) {
			$('#post_format_options .rwmb-field').fadeOut();
		}
		$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').siblings('.rwmb-field').hide();
		$( 'label[for*="' + postType + '"]' ).closest('.rwmb-field').fadeIn();


	});

});