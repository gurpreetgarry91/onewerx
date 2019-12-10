(function () {
	
	var show_hide_required_field_message = function( field, show_message ) {
		var required_field_message = 'This field is required.';

		// find and destroy pre-existing error messages
		jQuery(field).parents('.field_wrapper:first')
					 .find('.error_message')
					 .remove();

		if ( show_message ) {
			// show the "required fields" error message
			err_msg = jQuery('<p class="error_message required_field_error_message">' + required_field_message + '</p>');
			jQuery(field).parents('.field_wrapper:first')
						 .append(err_msg);
		}
	};
	
	var setup_form = function(frm) {
		frm = jQuery(frm);
		
		frm.on('submit', function (ev) {
			
			// look for required fields, then make sure they are all completed
			var required_fields = frm.find('[data-required="1"]'),
				all_complete = true,
				field,
				find_checked;

			required_fields.each(function() {
				field = jQuery(this);
				if ( field.hasClass('radio_wrapper') ) {
					// radio button
					find_checked = field.find('input[type=radio]:checked');
					if ( find_checked.length = 0 ) {
						all_complete = false;
						jQuery(this).addClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), true );
					} else {
						jQuery(this).removeClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), false );						
					}
				}
				else if ( field.is('[type=checkbox]') ) {
					// checkbox
					if ( !jQuery(this).is(':checked') ) {
						all_complete = false;
						jQuery(this).parents('.field_wrapper:first')
									.addClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), true );
					} else {
						jQuery(this).parents('.field_wrapper:first')
									.removeClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), false );						
					}
				}
				else if ( field.is('[type=phone]') ) {
					// phone
					if ( jQuery(this).val() == '' ) {
						all_complete = false;
						jQuery(this).parents('.field_wrapper:first')
									.addClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), true );
					} else {
						jQuery(this).parents('.field_wrapper:first')
									.removeClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), false );						
					}
				}
				else if ( field.is('[type=email]') ) {
					// email
					if ( jQuery(this).val() == '' ) {
						all_complete = false;
						jQuery(this).parents('.field_wrapper:first')
									.addClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), true );
					} else {
						jQuery(this).parents('.field_wrapper:first')
									.removeClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), false );						
					}
				}
				else if ( field.is('[type=text]') ) {
					// text
					if ( jQuery(this).val() == '' ) {
						all_complete = false;
						jQuery(this).parents('.field_wrapper:first')
									.addClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), true );
					} else {
						jQuery(this).parents('.field_wrapper:first')
									.removeClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), false );						
					}
				}
				else if ( field.is('textarea') ) {
					// textarea
					if ( jQuery(this).val() == '' ) {
						all_complete = false;
						jQuery(this).parents('.field_wrapper:first')
									.addClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), true );
					} else {
						jQuery(this).parents('.field_wrapper:first')
									.removeClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), false );						
					}
				}
				else {
					// default
					if ( !jQuery(this).val() == '' ) {
						all_complete = false;
						jQuery(this).parents('.field_wrapper:first')
									.addClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), true );
					} else {
						jQuery(this).parents('.field_wrapper:first')
									.removeClass('has_validation_error');
						show_hide_required_field_message( jQuery(this), false );						
					}
				}
				//i++;
			});
			
			return all_complete;
		});
		
		
		
		
	};
	
	jQuery('.gp_custom_form').each(function () {
		setup_form(this);
	});
	
})();