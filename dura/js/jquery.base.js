(function() {
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

	$(document).ready(function() {
		$(window).bind("orientationchange resize pageshow", fixgeometry);
	});
})();