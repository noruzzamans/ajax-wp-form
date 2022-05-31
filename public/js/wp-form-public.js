(function ($) {
	'use strict';

	$(document).ready(function () {
		$('#wp_custom_form form').on('submit', function (e) {
			e.preventDefault();

			var data = $(this).serialize();

			$.ajax({
				url: wp_form.ajaxurl,
				type: 'POST',
				data: {
					action: wp_form.action,
					data: data,
					nonce: wp_form.nonce,

				}
			});
		});
	})	

})(jQuery);
