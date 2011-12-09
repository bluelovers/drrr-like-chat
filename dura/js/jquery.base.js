jQuery(function($) {
	$(document)
		.one('ready', function() {
			var fixgeometry = function() {
				/* Some orientation changes leave the scroll position at something
				* that isn't 0,0. This is annoying for user experience. */
				scroll(0, 0);

				/* Calculate the geometry that our content area should take */
				var header = $('div[data-role="header"]:visible');
				var footer = $('div[data-role="footer"]:visible');
				var content = $('div[data-role="content"]:visible');
				var viewport_height = $(window).height();

				var content_height = viewport_height - header.outerHeight() - footer.outerHeight();

				/* Trim margin/border/padding height */
				content_height -= (content.outerHeight() - content.height());
				content.height(content_height);
			}; /* fixgeometry */

			$(window).bind("resize", fixgeometry);

			$(window).bind("orientationchange pageshow", function() {
				$(window).triggerHandler('resize');
			});

			$('#login')
				.css({
					position : 'relative',
				})
				.find('> div')
					.andSelf()
						.addClass('clearfix')
			;

			$('#login').center({
				against : 'parent',
			});

			$(window).triggerHandler('resize');
		})
		.ready(function(){
			$('body').removeClass('nojqmobile');
		})
	;

	var testinput = document.createElement('input');
	$.extend($.support, { placeholder: !!('placeholder' in testinput) });

	if (!$.support.placeholder) {
		var _placeholder = 'input[placeholder], textarea[placeholder]';

		$(_placeholder)
			.live({
				'focus.placeholder' : function(){
					var input = $(this);
					if (input.val() == input.attr('placeholder')) {
						input.val('');
						input.removeClass('placeholder');
					}
				},
				'blur.placeholder' : function(){
					var input = $(this);
					if (input.val() == '' || input.val() == input.attr('placeholder')) {
						input.addClass('placeholder');
						input.val(input.attr('placeholder'));
					}
				},
			})
			.trigger('blur')
		;
		$(_placeholder)
			.parents('form')
				.live('submit.placeholder', function() {
					$(this).find(_placeholder).each(function() {
						var input = $(this);
						if (input.val() == input.attr('placeholder')) {
							input.val('');
						}
					});
				})
		;
	};

	$('[data-role="page"]').live('pageInit', function(){
		$(document).triggerHandler('ready');
	});
});