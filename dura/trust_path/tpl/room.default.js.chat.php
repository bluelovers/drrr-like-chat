(function($)
{
	var chk_css3_lineargradient = function()
	{
		var ret = false;
		var i = 0;

		var color = [
			"#b46f88", "#b46f88", "#9a3b4d", "#9a3b4d"
		];

		var _css = [
			"background-color: " + color[2] + ";"
			, "background-image: -moz-linear-gradient(top,  " + color[0] + " 0%, " + color[1] + " 50%, " + color[2] + " 50%, " + color[3] + " 100%);"
			, "background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%," + color[0] + "), color-stop(50%," + color[1] + "), color-stop(50%," + color[2] + "), color-stop(100%," + color[3] + "));"
			, "background-image: -webkit-linear-gradient(top,  " + color[0] + " 0%," + color[1] + " 50%," + color[2] + " 50%," + color[3] + " 100%);"
			, "background-image: -o-linear-gradient(top,  " + color[0] + " 0%," + color[1] + " 50%," + color[2] + " 50%," + color[3] + " 100%);"
			, "background-image: -ms-linear-gradient(top,  " + color[0] + " 0%," + color[1] + " 50%," + color[2] + " 50%," + color[3] + " 100%);"
			, "background-image: linear-gradient(top,  " + color[0] + " 0%," + color[1] + " 50%," + color[2] + " 50%," + color[3] + " 100%);"
			, "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='" + color[0] + "', endColorstr='" + color[2] + "',GradientType=0 );"
		];

		var css = "";

		for( i=1; i<_css.length; i++)
		{
			css += _css[i];
		}

		if (0)
		{
			var div = document.createElement( "div" );
			div.style.cssText = css;

			var _style = div.style.cssText;
		}
		else{
			var div = $( '<div style="' + css + '" />' );
			var _style = div.css('background-image');
		}

		var _chk = [
			"-moz-linear-gradient"
			, "-webkit-gradient"

			, "-webkit-linear-gradient"
			, "-o-linear-gradient"
			, "-ms-linear-gradient"

			, "linear-gradient"

			, "gradient"
		];

		ret = _style;

		for(i=0; i<_chk.length; i++)
		{
			if (_style.indexOf(_chk[i]) > -1)
			{
				ret = _chk[i];
				break;
			}
		}

		div = css = _css = _chk = color = null;

		return ret;
	};

	$.extend($.support, {
		css : {
			lineargradient : chk_css3_lineargradient()
		}
	});

	var roundBaloon = function()
	{
		var _this = $(this);

		var width = _this.width();
		var borderWidth = _this.css('border-width');
		var padding = _this.css('padding-left');
		var color = _this.css('border-color');

		if (width > 620)
		{
			width = 620;
		}

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