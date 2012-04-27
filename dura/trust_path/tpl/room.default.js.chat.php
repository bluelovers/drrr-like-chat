
<?php e($this->slot('theme.js.dura')) ?>

(function($)
{

	var _dura_chat = {};

	_dura_chat = {

		data : {
			page : $('#page_room'),
		},

		page_is_active : function()
		{
			return _dura_chat.data.page.is('.ui-page-active');
		},

		ui : {
			talks : function()
			{
				_dura_chat.data.page
					.find('.talk[dura-init!="1"]')
						.find('dd div.bubble')
							.each(addTail)
							.find('.body')
								.each(roundBaloon)
							.end()
						.end()
						.attr('dura-init', 1)
				;
			},

			talk : function()
			{

			},
		},

		log : function(data)
		{
			var data = $.extend([], {_name : '$.Dura.chat', _obj : _dura_chat}, data);
			$.log(data);
		},

		events : {

			_key : 'dura.chat.',

			_init : function()
			{
				for (var event in _dura_chat.events.map)
				{
					_dura_chat.log(['Init: events:' + event]);

					$(window).bind('page.' + event, _dura_chat.events.map[event]);
				}
			},

			map : {

				resize : function()
				{
					_dura_chat.log(['Call: events:' + 'resize']);

					$(_dura_chat).triggerWait(_dura_chat.events._key + 'resize', 100);
				},

				ready : function()
				{
					_dura_chat.log(['Call: events:' + 'ready']);

					$(_dura_chat).trigger(_dura_chat.events._key + 'ready', 100);
				},

				show : function()
				{
					_dura_chat.log(['Call: events:' + 'show']);

					$(_dura_chat).triggerWait(_dura_chat.events._key + 'show', 100);
				},

			},
		},

		init : function()
		{
			this.log(['Init']);

			this.events._init();

			$.extend(this.data, {}, {
				form : _dura_chat.data.page.find('#message form:first'),

				talk_box : _dura_chat.data.page.find('#talks'),
			});

		},

		on : function(event, fn)
		{
			_dura_chat.log(['Bind: events:' + event, fn]);

			$(_dura_chat).bind(_dura_chat.events._key + event, fn);
		},

		trigger : function(event)
		{
			_dura_chat.log(['Trigger: events:' + event]);

			$(_dura_chat).trigger(_dura_chat.events._key + event);
		},

		triggerWait : function(event, timeout)
		{
			_dura_chat.log(['TriggerWait: events:' + event, timeout]);

			$(_dura_chat).triggerWait(_dura_chat.events._key + event, timeout);
		},
	};

	$.extend($.Dura, {chat: _dura_chat});

	$.Dura.chat.init();

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
				.children("div:first").css({
					"position":"relative",
					"float":"left",
					"margin":"0 0 0 0",
					"top": "39px",
					"left": "-3px",
					"width":"22px",
					"height":"16px",
					"background":"transparent "+bgimg+" left "+top+"px repeat-x"
				})
					.children("div:first").css({
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
		if ( !isUseSound )
		{
			return;
		}

		//$.log(['ringSound', ringSound.count]);
		$.Dura.sound.play();
		//$.log(['ringSound end', ringSound.count]);

		ringSound.count++;
	};

	ringSound.count = 1;

	var isUseSound = true;
	var _do_construct = false;

	$(window).bind('dura.mobile.resize', function()
	{
		$(window).trigger('page.resize');
	});

	$(window).bind('dura.mobile.ready', function()
	{
		$(window).trigger('page.ready');
	});

	$.Dura.chat.on('resize', function()
	{
		$('.ui-page-active #talks').css('max-width', Math.min(620, $('.ui-page-active .ui-content[role="main"]').width(), $(window).width()));
	});

	$.Dura.chat.on('resize', function()
	{
		var _this = $('.ui-page-active #talks .body').first();

		var _w =
			$('.ui-page-active #talks').width()
			- _this.parents('.talk').find('.avatar').outerWidth()
			- (_this.outerWidth() - _this.width())
			- 40
		;

		$('.ui-page-active #talks .body')
			.css('max-width', _w)
		;
	});

	$.Dura.chat.on('ready', function()
	{
		var elem_talk = $('.ui-page-active #talks');

		elem_talk
			.find('.talk[dura-init!="1"]')
				.find('dd div.bubble')
					.each(addTail)
					.find('.body')
						.each(roundBaloon)
					.end()
				.end()
				.attr('dura-init', 1)
		;

		$.Dura.chat.trigger('resize');

		$.Dura.sound.load();

		$.Dura.chat.triggerWait('show', 200);
	});

	$.Dura.chat.on('resize', function()
	{
		var elem_talk = $('.ui-page-active #talks');

			elem_talk
				.find('.talk[dura-show!="1"]')
					.find('.body:visible')
						.each(function(){
							var _this = $(this);

							_this
								.attr({
									'data-width' : _this.width(),
									'data-height' : _this.height(),
								})
							;
						})
					.end()
				.hide()
			;
	});

	$.Dura.chat.on('show', function()
	{
		var elem_talk = $('.ui-page-active #talks');

		$.log(['do show', _do_construct, elem_talk.find('.talk[dura-show!="1"]').size()]);

		$.Dura.sound.load();

		if (!_do_construct && elem_talk.find('.talk[dura-show!="1"]').size())
		{
			_do_construct = true;

				function _show(who)
				{
					if (!who.size())
					{
						_do_construct = false;

						$.log(['do show end', _do_construct, elem_talk.find('.talk[dura-show!="1"]').size()]);

						return;
					}

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
								/*
								var _text = $('<span _style="word-break: keep-all; white-space: nowrap; overflow: hidden;  max-width: 90%"/>')
									.html(_body.html())
									.hide()
								;
								*/

								var _text = _body
									.wrapInner(
										$('<div/>')
											.css({
												//overflow: 'hidden',
												//'word-break': 'keep-all',
												//'white-space': 'nowrap',
												opacity: 0.1,
											})
											.width(30)
											.height(25)
									)
									.children(':first')
									.hide()
								;

								_body
									//.html('')
									.show()
									.parents('.bubble')
										.fadeIn('slow')
									.end()
									//.append(_text)
								;

								var _w = _body.attr('data-width');
								var _h = _body.attr('data-height');

								if (!_w || !_h)
								{
									_w = _h = 'auto';
								}

								_text
									.show()
									.css({
										opacity: 0.1,
									})
									.animate(
										{
											width: _w,
											height: _h,
											opacity: 0.6,
										},
										{
											duration: 1000,
											specialEasing : {
												width : 'easeInOutElastic',
												height : 'easeInOutElastic',
												opacity : 'easeInOutElastic',
											},
											complete: function()
											{
												_body.html(_text.html());

												_show(who.prev());
											},
											/*
											step: function( now, fx )
											{
												if (fx.prop == 'opacity')
												{
													_text.css(fx.prop, (fx.state === fx.end) ? fx.state : (fx.state > 0.5 ? fx.state * 0.6 - 0.1 : fx.state * 0.25));
												}
												else
												{
													_text.css(fx.prop, now);
												}
											},
											*/
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

				_show(elem_talk.find('.talk[dura-show!="1"]').last());


		};

	});

})(jQuery);