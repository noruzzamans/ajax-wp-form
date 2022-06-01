(function ($) {
	'use strict';

	$(document).ready(function () {
		$('#wp_custom_form form').on('submit', function (e) {
			e.preventDefault();

			var fname = $(this).find('input[name="fname"]').val();
			var lname = $(this).find('input[name="lname"]').val();
			var email = $(this).find('input[name="email"]').val();
			var subject = $(this).find('input[name="subject"]').val();
			var message = $(this).find('textarea[name="message"]').val();

			$.ajax({
				url: wp_form.ajaxurl,
				type: 'POST',
				data: {
					action: wp_form.action,
					data: {
						fname: fname,
						lname: lname,
						email: email,
						subject: subject,
						message: message
					},
					nonce: wp_form.nonce,
				}
			});
		});
	})

})(jQuery);
