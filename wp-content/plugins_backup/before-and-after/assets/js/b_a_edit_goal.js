jQuery(function () {
	
	// for the targeted field, find its parent section (before or after), 
	// and see if that that section already has a value selected. 
	// if not, set the radio's value to this field
	var possibly_select_radio = function() {
		var me = jQuery(this);
		
		// init variables based on being in the before or after section
		if ( me.parents('#goal_before').length > 0) {
			var radio_to_check = 'before-action';
			var section_selector = '#goal_before .b_a_options';
		} else {
			var radio_to_check = 'after-action';
			var section_selector = '#goal_after .b_a_options';
		}
		
		// if the radio button doesn't have a value, but this field does,
		// select the corresponding radio button
		var radio_val = jQuery('input[name=' + radio_to_check + ']:checked').val();
		if ( !radio_val && me.val() ) {
			// select my associated radio button
			jQuery(this).parents('li:first')
					   .find('input[name=' + radio_to_check + ']')
					   .attr('checked', 'checked');
					   
			// unbind this function so we don't keep firing it needlessly
			jQuery(section_selector).off('.b_a');
		}
	};
	
	jQuery('#goal_before .b_a_options').on('change.b_a mouseup.b_a', 'select', possibly_select_radio);
	jQuery('#goal_before .b_a_options').on('keyup.b_a', 'input,textarea', possibly_select_radio);
	jQuery('#goal_after .b_a_options').on('change.b_a mouseup.b_a', 'select', possibly_select_radio);
	jQuery('#goal_after .b_a_options').on('keyup.b_a', 'input,textarea', possibly_select_radio);
});