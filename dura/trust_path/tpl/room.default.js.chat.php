(function($)
{

	$.extend($.Color.fn, {
		pctrgb : function(percentage)
		{
			if (!$.isArray(percentage)){
				percentage = [percentage, percentage, percentage];
			}

			percentage = $.extend([1, 1, 1, 1], percentage);

			this.rgba();

			return this
				.red(this._rgba[0] * percentage[0])
				.green(this._rgba[1] * percentage[1])
				.blue(this._rgba[2] * percentage[2])
				.alpha(this._rgba[3] * percentage[3])
			;
		},

		pcthsla : function(percentage)
		{
			if (!$.isArray(percentage)){
				percentage = [percentage, percentage, percentage];
			}

			percentage = $.extend([1, 1, 1, 1], percentage);

			this.hsla();

			return this
				.hue(this._hsla[0] * percentage[0])
				.saturation(this._hsla[1] * percentage[1])
				.lightness(this._hsla[2] * percentage[2])
				.alpha(this._hsla[3] * percentage[3])
			;
		},
	});

	var css3_bg_lineargradient = function(options)
	{
		var options = $.extend(true, {}, css3_bg_lineargradient.options_default, options);

		var makeColor = function(color)
		{
			if (color.length == 1 || !$.isArray(color))
			{
				color = $.isArray(color) ? color[0] : color;
				color = [$.Color(color).pctrgb([1.2, 2, 1.7]).toRgbaString(), color];
			}

			if (color.length <= 2)
			{
				color[0] = color[0] ? color[0] : color[1];
				color[1] = color[1] ? color[1] : color[0];

				var _color = [color[0], color[0], color[1], color[1]];

				color = _color;

				_color = null;
			}
			else
			{
				color[0] = color[0] ? color[0] : color[1];
				color[1] = color[1] ? color[1] : color[0];
				color[2] = color[2] ? color[2] : color[3];
				color[3] = color[3] ? color[3] : color[2];
			}

			return color;
		};

		var makeCss = function(color)
		{
			var css = "background-color: " + color[2] + ";";

			var _css = {
				'-moz-linear-gradient' : "background-image: -moz-linear-gradient(top,  " + color[0] + " 0%, " + color[1] + " 50%, " + color[2] + " 50%, " + color[3] + " 100%);"
				, '-webkit-gradient' : "background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%," + color[0] + "), color-stop(50%," + color[1] + "), color-stop(50%," + color[2] + "), color-stop(100%," + color[3] + "));"
				, '-webkit-linear-gradient' : "background-image: -webkit-linear-gradient(top,  " + color[0] + " 0%," + color[1] + " 50%," + color[2] + " 50%," + color[3] + " 100%);"
				, '-o-linear-gradient' : "background-image: -o-linear-gradient(top,  " + color[0] + " 0%," + color[1] + " 50%," + color[2] + " 50%," + color[3] + " 100%);"
				, '-ms-linear-gradient' : "background-image: -ms-linear-gradient(top,  " + color[0] + " 0%," + color[1] + " 50%," + color[2] + " 50%," + color[3] + " 100%);"
				, 'linear-gradient' : "background-image: linear-gradient(top,  " + color[0] + " 0%," + color[1] + " 50%," + color[2] + " 50%," + color[3] + " 100%);"
				, 'filter' : "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='" + color[0] + "', endColorstr='" + color[2] + "',GradientType=0 );"
			};

			var _ok = false;

			try
			{
				if ($.support.css.lineargradient && _css[$.support.css.lineargradient])
				{
					css += _css[$.support.css.lineargradient];

					_ok = true;
				}
			}
			catch(e)
			{

			}

			if (!_ok)
			{
				for(var i in _css)
				{
					css += _css[i];
				}
			}

			return css;
		};

		options.color = makeColor(options.color);
		var css = makeCss(options.color);

		return css;
	};

	css3_bg_lineargradient.options_default = {};

	var chk_css3_lineargradient = function()
	{
		var ret = false;
		var i = 0;

		css = css3_bg_lineargradient({

			color : ["#b46f88", '#fed900']

		});

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

		var div = css = _css = _chk = color = null;

		return ret;
	};

	$.extend($.support, {
		css : {
			lineargradient : chk_css3_lineargradient()
		}
	});

	window.css3_bg_lineargradient = css3_bg_lineargradient;

	var roundBaloon = function()
	{
		var _this = $(this);

		var width = _this.outerWidth();
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
				})
				/*
				.width(width)
				*/
				.corner("round 13px")
		;
		/*
		var _style = _this.attr('style');

		var _color = $.Color('#0066ff');

		_this.attr('style', _style + ';' + css3_bg_lineargradient({ color : [
			_color.saturation(0.4).lightness(0.7).toRgbaString(),
			_color.saturation(0.4).lightness(0.6).toRgbaString(),
			_color.saturation(0.5).lightness(0.4).toRgbaString(),
			_color.saturation(0.5).lightness(0.3).toRgbaString()
		]}));
		*/
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
			.addClass('clearfix')
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
					.end()
				.end()
			.children()
				.addClass('clearfix')
		;
	};

	var ringSound = function()
	{

	};

	var _do_construct = false;

	$(document).bind('orientationchange', function()
	{
		$('#talks').css('max-width', Math.min(620, $('.ui-page-active .ui-content[role="main"]').width(), $(window).width()));
	});

	$(document).bind('orientationchange', function()
	{
		var _this = $('#talks .body').first();

		var _w =
			$('#talks').width()
			- _this.parents('.talk').find('.avatar').outerWidth()
			- (_this.outerWidth() - _this.width())
			- 40
		;

		$('#talks .body')
			.css('max-width', _w)
		;
	});

	$(document).bind('pageshow, pageinit, ready', function()
	{
		var elem_talk = $('#talks .talk');

		elem_talk
			.filter('[dura-init!="1"]')
				.find('dd div.bubble')
					.each(addTail)
					.find('p.body')
						.each(roundBaloon)
					.end()
				.end()
				.attr('dura-init', 1)
		;

		$(document).triggerHandler('orientationchange');

		if (!_do_construct)
		{
			elem_talk
				.filter('[dura-show!="1"]')
				.hide()
			;

			function _show(who)
			{
				ringSound();

				who
					.attr('dura-show', 1)
				;

				var _body;

				if (who.is('dl'))
				{
					_body = who
						.find('.bubble')
							.hide()
								.find('.body')
									.hide()
					;
				}

				who
					.show(500, function(){

						if (_body)
						{
							var _text = $('<span style="word-break: keep-all; white-space: nowrap; overflow: hidden;  max-width: 90%"/>')
								.html(_body.html())
								.hide()
							;

							_body
								.html('')
								.show()
								.parents('.bubble')
									.fadeIn('slow')
								.end()
								.append(_text)
							;

							_text
								.animate(
									{
										width: 'toggle',
										height: 'toggle',
										display: 'toggle',
									},
									{
										duration: 1000,
										specialEasing : {
											width : 'easeInOutElastic',
											height : 'easeInOutElastic',
										},
										complete: function(){

											_text.removeAttr('style');

											_show(who.prev());
										},
									}
								)
							;
						}
						else
						{
							_show(who.prev());
						}
					})
				;
			};

			_show(elem_talk.filter('[dura-show!="1"]').last());

			_do_construct = true;
		}

	});

})(jQuery);