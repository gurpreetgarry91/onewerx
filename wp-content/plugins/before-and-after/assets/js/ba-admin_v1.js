jQuery(function ()
{
	jQuery('#b_a_help .gp_code_example, #goal_shortcodes .gp_code_example').bind('click', function () {
		jQuery(this).trigger('focus').select();
	});
});

var clear_conversion_cookies = function (btn)
{
	btn = jQuery(btn);
	btn.attr('disabled', 'disabled');

	var icon = btn.find('.fa');
	icon.addClass('fa-spin');

	var data = { 
		'action': 'b_a_clear_cookies',
		'b_a_clear_cookies' : 'go',
		'is_ajax': 1
	};

	var handle_response = function (data, testData, jqXHR) {
		var throttle = 500; // small throttle, in ms
		setTimeout(
			function () 
			{
				if (data.msg) {
					// display the message
					msg_box = jQuery('#conversion_cookies_message');
					msg_box.html(data.msg).fadeOut(0).fadeIn();
					
					// clear any previous fade effects before applying a new one
					if ( typeof(msg_box.data('fade_timer') !== 'undefined') ) {
						clearTimeout( msg_box.data('fade_timer') );
					}
					
					// fade the message out after 15 seconds
					msg_box.data( 'fade_timer', setTimeout(function () {
						msg_box.fadeOut();
					}, 15000) );
				}
				
				// remove the spinning effect and re-enable the button
				icon.removeClass('fa-spin');
				btn.removeAttr('disabled');
			},
			throttle
		); 
	};
	
	jQuery.post(
		ajaxurl,
		data,
		handle_response,
		'json'
	);
};

var b_a_export_conversions = function()
{
	var loc = location.href;        
    loc += loc.indexOf("?") === -1 ? "?" : "&";
    location.href = loc + "b_a_export_conversions=1";	
	
}