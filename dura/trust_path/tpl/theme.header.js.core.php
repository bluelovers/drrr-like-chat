

(function($){

	$.extend($, {
		log: function(data)
		{
			console.log(data);
			$('.dura-debug').append('<p>'+data.join(', ')+'</p>');
		},

		url_param : function(url, param)
		{
			var url = url + '';
			var param = $.extend({}, param);

			var _c = (url.indexOf('?')) ? '&' : '?';

			url += _c + $.param(param);

			return url;
		},
	});

	$.extend($, {}, {
		timerWait : function(event, timeout, loop, data)
		{
			var _this = $(window);

			var _data_key = '_sco-timer-timerWait';

			var _data = _this.data(_data_key);
			_data = $.extend({}, _data);

			if ($.type(timeout) == "undefined")
			{
				timeout = 1000;
			}

			if (_data[event])
			{
				clearTimeout(_data[event].id);
			}
			else
			{
				_data[event] = $.extend({}, {
					name : event,
					timeout : timeout,
					func : event,
					loop : loop,
				});
			}

			_data[event].data = $.extend({}, data);

			//$.log([_data_key, _data[event].name, _data[event].timeout, _this, _data[event]]);

			_data[event].id = setTimeout(_data[event].func, _data[event].timeout);
			_this.data(_data_key, _data);
		}
	});

	$.fn.triggerWait = function(event, timeout, data){
		var _this = $(this);

		var _data_key = 'triggerWait';

		var _data = _this.data(_data_key);
		_data = $.extend({}, _data);

		if ($.type(timeout) == "undefined")
		{
			timeout = 1000;
		}

		if (_data[event])
		{
			clearTimeout(_data[event].id);
		}
		else
		{
			_data[event] = $.extend({}, {
					name : event,
					timeout : timeout,
					func : function(){
						_this.trigger(event, _data[event].data);
					},
				});
		}

		_data[event].data = $.extend({}, data);

		//$.log([_data_key, _data[event].name, _data[event].timeout, _this, _data[event]]);

		_data[event].id = setTimeout(_data[event].func, _data[event].timeout);
		_this.data(_data_key, _data);

		return this;
	};

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

	/**
	 * @url http://api.jquery.com/serializeArray/
	 */
	$.fn.serializeJSON = function()
	{
		var json = {};

		$.map($(this).serializeArray(), function(n, i){
			json[n['name']] = n['value'];
		});

		return json;
	};

	$.extend($, {
		alert : function(message, fn)
		{
			var _msg = $("<div class='ui-loader ui-overlay-shadow ui-bar-f ui-corner-all ui-content' />")
				.css({
					display : "block",
					opacity : 0.96,
					top : '150%',
					left : '50%',
					'max-width' : '90%',
					'min-width' : '30%',
					'text-align' : 'center',
				})
				.html(message)
				.wrapInner('<h1/>')
			;

			_msg
				.appendTo('body')
				.css({
					left : ($('body, html').width() - _msg.width()) / 2,
				})
				.hide()
				.css({
					top : '50%',
				})
				.fadeIn('fast')
				//.appendTo( $.mobile.pageContainer )
			;

			if (fn)
			{
				fn(_msg);
			}
			else
			{
				_msg
					.delay(1500)
					.fadeOut('slow', function(){
						$(this).remove();
					})
				;
			}
		},
	});

})(jQuery);