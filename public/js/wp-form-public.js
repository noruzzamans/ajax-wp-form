(function ($) {
	'use strict';

	$(document).ready(function () {
		$('#wp_custom_form form').on('submit', function (e) {
			e.preventDefault();

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
						regex:"[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}"

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
						required: "Please enter your first name",
						minlength: jQuery.validator.format("At least {0} characters required!")
					},
					lname: {
						required: "Please enter your last name",
						minlength: jQuery.validator.format("At least {0} characters required!")
					},
					email: {
						required: "Please enter your email address",
						email: "Your email address must be in the format of name@domain.com"
					},
					subject: {
						required: "Please enter your subject",
					},
					message: {
						required: "Please enter your message",
					}

				},

			})

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
