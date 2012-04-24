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
		;
	};

	var addTail = function()
	{

		var _this = $(this);

		var _body = _this.find(".body");

		var height = _body.height() + 30 + 8;
		var top = (Math.round((180 - height) / 2) + 23) * -1;
		var bgimg  = _body.css("background-image");
		var rand = Math.floor(Math.random()*2);
		var tailTop = "0px";

		if ( rand == 1 )
		{
			tailTop = "-17px";
		}

		top = top + 1;

		_body.css({"margin": "0 0 0 15px"});

		_this
			.css({"margin":"-16px 0 0 0"})
			.prepend('<div><div></div></div>')
				.children("div").css({
					"position":"relative",
					"float":"left",
					"margin":"0 0 0 0",
					"top": "39px",
					"left": "-3px",
					"width":"22px",
					"height":"16px",
					"background":"transparent "+bgimg+" left "+top+"px repeat-x"
				})
				.children("div").css({
					"width":"100%",
					"height":"100%",
					"background":"transparent url('"+duraUrl+"/css/tail.png') left "+tailTop+" no-repeat"
				})
		;
	};

	$(function()
	{
		$('#talks dl.talk')
			.filter('[dura-init!="1"]')
				.find('dd div.bubble')
					.each(addTail)
					.find('p.body')
						.each(roundBaloon)
					.end()
				.end()
				.attr('dura-init', 1)
		;
	});

})(jQuery);