(function($)
{

	var roundBaloon = function()
	{
		var _this = $(this);

		var width = _this.width();
		var borderWidth = _this.css('border-width');
		var padding = _this.css('padding-left');
		var color = _this.css('border-color');
		width = width + padding.replace(/px/, '') * 2;

		_this
			.corner("round 10px cc:" + color)
			.parent()
				.css(
				{
					"background": color,
					"padding": borderWidth,
					"width": width
				})
				.corner("round 13px")
				.parents('dl.talk')
					.prop({
						'data-dura-ui-init' : 1
					})
		;
	};

	$(function()
	{

		$('#talks dl.talk')
			.filter('[init!="1"]')
				.find('dd div.bubble p.body')
					.each(roundBaloon)
		;

	});

})(jQuery);