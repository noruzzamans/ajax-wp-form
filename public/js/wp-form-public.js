(function ($) {
	'use strict';

	$(document).ready(function () {

		$('#Wp_Form').validate({
			rules: {
				fname: {
					required: true,
					minlength: 2
				},
				lname: {
					required: true,
					minlength: 2
				},
				email: {
					required: true,
					email: true,

				},
				subject: {
					required: true,
				},
				message: {
					required: true,
				}
			},
			messages: {
				fname: {
					required: wp_form.fname,
					minlength: wp_form.fname_min,
				},
				lname: {
					required: wp_form.lname,
					minlength: wp_form.lname_min,
				},
				email: {
					required: wp_form.email,
					email: wp_form.email_valid,
				},
				subject: {
					required: wp_form.subject,
				},
				message: {
					required: wp_form.message,
				}

			}

		});

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
				},
				success: function (data) {
					if (data.success === true) {
						$('#result_message').html(
							'<div>' + data.data.message + '</div>'
						);
						$('#wp_custom_form form').trigger('reset');
					} else if (data.success === false) {
						$('#result_message').html(
							'<div>' + data.data.message + '</div>'
						);
					}
				},
			});
		});
	})

})(jQuery);
