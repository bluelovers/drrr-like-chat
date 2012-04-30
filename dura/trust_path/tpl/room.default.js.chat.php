<?php if (0): ?><script><?php endif; ?>

<?php e($this->slot('theme.js.dura')) ?>

(function($, undefined)
{

	var _dura_chat = {};

	_dura_chat = {

		data_cache : {
			page : $('#page_room'),

			sync : {
				in_sync : false,
				dataType : 'json',
				in_ajax : {},
			},
		},

		page_is_active : function()
		{
			return _dura_chat.data_cache.page.is('.ui-page-active');
		},

		ui : {
			talks : function()
			{
				_dura_chat.data_cache.page
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
				var event;

				for (event in _dura_chat.events.map)
				{
					_dura_chat.log(['Init: events:' + event]);

					$(window)
						.unbind('page.' + event, _dura_chat.events.map[event])
						.bind('page.' + event, _dura_chat.events.map[event])
					;
				}

				event = 'submit';
				_dura_chat.log(['Init: events:' + event]);
				_dura_chat.data_cache.form
					.unbind(event, _dura_chat.events.map[event])
					.live(event, _dura_chat.events.map[event])
				;
			},

			map : {

				resize : function(e)
				{
					var event = 'resize';

					_dura_chat.data('Event:' + event, e);
					_dura_chat.data('Event.last', event);
					_dura_chat.log(['Call: events:' + event, e]);

					$(_dura_chat).triggerWait(_dura_chat.events._key + event, 100, e.data, e);
				},

				ready : function(e)
				{
					var event = 'ready';

					_dura_chat.data('Event:' + event, e);
					_dura_chat.data('Event.last', event);
					_dura_chat.log(['Call: events:' + event, e]);

					$(_dura_chat).trigger(_dura_chat.events._key + event, e.data, e);
				},

				show : function(e)
				{
					var event = 'show';

					_dura_chat.data('Event:' + event, e);
					_dura_chat.data('Event.last', event);
					_dura_chat.log(['Call: events:' + event, e]);

					$(_dura_chat).triggerWait(_dura_chat.events._key + event, 100, e.data, e);
				},

				submit : function(e)
				{
					var event = 'submit';

					_dura_chat.data('Event:' + event, e);
					_dura_chat.data('Event.last', event);
					_dura_chat.log(['Call: events:' + event, e]);

					$(_dura_chat).trigger(_dura_chat.events._key + event, e.data, e);
				},

				ajax : function(e)
				{
					var event = 'ajax';

					_dura_chat.data('Event:' + event, e);
					_dura_chat.data('Event.last', event);
					_dura_chat.log(['Call: events:' + event, e]);

					$(_dura_chat).trigger(_dura_chat.events._key + event, e.data, e);
				},

				sync : function(e)
				{
					var event = 'sync';

					_dura_chat.data('Event:' + event, e);
					_dura_chat.data('Event.last', event);
					_dura_chat.log(['Call: events:' + event, e]);

					$(_dura_chat).trigger(_dura_chat.events._key + event, e.data, e);
				},

			},
		},

		data : function(k, v)
		{
			if (undefined === v)
			{
				return $(_dura_chat).data(k);
			}
			else
			{
				return $(_dura_chat).data(k, v);
			}
		},

		init : function()
		{
			_dura_chat = this;

			this.log(['Init']);

			this._init();

			$(document).one('pageinit, ready', function(){
				_dura_chat._init();
			});

		},

		_init : function()
		{
			this.log(['_Init']);

			_dura_chat = this;

			this.data_cache.page = $(this.data_cache.page.selector);

			$.extend(this.data_cache, {}, {
				form : this.data_cache.page.find('#message form:first'),

				talk_box : this.data_cache.page.find('#talks'),
			});

			this.events._init();
		},

		on : function(event, fn, data)
		{
			this.log(['Bind: events:' + event, fn, data]);

			$(this).bind(this.events._key + event, data, fn);
		},

		trigger : function(event, data)
		{
			this.log(['Trigger: events:' + event, data]);

			$(this).trigger(this.events._key + event, data);
		},

		triggerWait : function(event, timeout, data)
		{
			this.log(['TriggerWait: events:' + event, timeout, data]);

			$(this).triggerWait(this.events._key + event, timeout, data);
		},

		sync : function(options)
		{
			this.log(['sync', this.data_cache.sync.in_sync]);

			if (!this.data_cache.sync.in_sync)
			{
				this.data_cache.sync.in_sync = true;

				this.data_cache.form = $(this.data_cache.form.selector);

				var param = $.extend({}, this.data_cache.form.serializeJSON(), {
					fast : 1,
					ajax : 1,
					dataType : this.data_cache.sync.dataType,
				});

				$
					.ajax(
						{
							type : 'POST',
							url : $.url_param(this.data_cache.form.attr('action'), param),
							data : param,
							dataType : this.data_cache.sync.dataType,
						}
					)
					.success(function(data, textStatus, jqXHR){
						var event = 'sync.success';
						_dura_chat.trigger(_dura_chat.events._key + event, data);
					})
					.error(function(jqXHR, textStatus, errorThrown){
						var event = 'sync.error';
						_dura_chat.trigger(_dura_chat.events._key + event);
					})
					.complete(function(jqXHR, textStatus){
						_dura_chat.data_cache.sync.in_sync = false;

						var event = 'sync.complete';
						_dura_chat.trigger(_dura_chat.events._key + event);
					})
				;
			}
		},

		ajax : function(options)
		{
			var options = $.extend({}, {
				_ajax_key_ : 'ajax',
				settings : {
					type : 'GET',
					dataType : this.data_cache.sync.dataType,

					//ifModified : true,
				},
				param : {},
			}, options);

			this.log([options._ajax_key_, this.data_cache.sync.in_ajax[options._ajax_key_]]);

			if (!this.data_cache.sync.in_ajax[options._ajax_key_])
			{
				this.data_cache.sync.in_ajax[options._ajax_key_] = true;

				this.data_cache.form = $(this.data_cache.form.selector);

				var param = $.extend({}, {
					dataType : options.settings.dataType,
				}, options.param);

				options.settings = $.extend({
					url : $.url_param(this.data_cache.form.attr('action'), param),
					data : param,
				}, options.settings);

				$
					.ajax(
						options.settings
					)
					.success(function(data, textStatus, jqXHR){
						var event = options._ajax_key_ + '.success';
						_dura_chat.trigger(_dura_chat.events._key + event, data);
					})
					.error(function(jqXHR, textStatus, errorThrown){
						var event = options._ajax_key_ + '.error';
						_dura_chat.trigger(_dura_chat.events._key + event);
					})
					.complete(function(jqXHR, textStatus){
						_dura_chat.data_cache.sync.in_ajax[options._ajax_key_] = false;

						var event = options._ajax_key_ + '.complete';
						_dura_chat.trigger(_dura_chat.events._key + event);
					})
				;
			}
		},

		alert : function(message, title, fn)
		{

			if (!fn && $(_dura_chat.data_cache.page.selector).is('.ui-page-active'))
			{
				fn = function (who){

					$.Dura.sound.play();

					who
						.animate({
							top : $('#message [name="message"]').offset().top,
							left : $('#message [name="message"]').offset().left,
							width: $('#message [name="message"]').outerWidth() + $('#message [name="message"]').css('border-size'),
							padding : $('#message [name="message"]').css('padding'),
							'min-width' : '10%',
						}, 1500, 'easeInOutElastic')
						.delay(2000)
						.fadeOut('slow', function(){
							who.remove();
						})
					;

				};
			}

			$.alert(message, fn);
		},

		getEvent : function(event)
		{
			if (event === undefined)
			{
				event = _dura_chat.data('Event.last');
			}

			return _dura_chat.data('Event:' + event);
		},

		doane : function(e, event)
		{
			if (e)
			{
				e.preventDefault();
			}

			_dura_chat.getEvent(event).preventDefault();

			return false;
		},
	};

	$.extend($.Dura, {chat: _dura_chat});

	$.Dura.chat.init();

	$.Dura.chat.on('sync.success', function(e, data){
		$.log(['dura.chat.sync.success', e, data]);

		if (data.error)
		{
			$.Dura.chat.alert(data.error_msg);
		}
	});

	$.Dura.chat.on('submit', function(e, data){
		var event = 'submit';

		$.log(['dura.chat.submit', e, data]);

		$.Dura.chat.doane(e, event);

		$.Dura.chat.sync();

		$($.Dura.chat.data_cache.form.selector).find('[name="message"]').val('');

		$.timerWait(_getMessages, 100);

		return false;
	});

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

	var _ui_talks = function()
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
	};

	$.Dura.chat.on('ready', function()
	{
		_ui_talks();

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

					$.timerWait(_getMessages, 1000);

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

							$.timerWait(_getMessages, 1150);

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

	var _getMessages = function ()
	{
		$.Dura.chat.ajax({
			param : {
				controller : 'room_ajax',
			},
			settings : {
				success : function(data, textStatus, jqXHR)
				{
					data = $.parseJSON(data);

     				var _talks = $($.Dura.chat.data_cache.page.selector).find('#talks');
     				var _talks_new = _talks.find('div.ajaxnew');

     				var _old_talks_h = _talks.height();
     				var _old_talks_w = _talks.width();

     				if (_talks_new.size() == 0)
     				{
     					_talks_new = _talks
     						.clone()
     						.removeClass()
     						.addClass('ajaxnew')
     						.css({
     							top : '200%',
     							right : '200%',
     							position: 'fixed',
     						})
     						.removeAttr('id')
     						.empty()
     						.appendTo(_talks)
    					;
     				}
     				else if (_talks_new.size() > 1)
     				{
     					_talks_new
     						.filter('not(:first)')
							 	.detach()
							.end()
     						.appendTo(_talks)
    					;
     				}

     				_talks_new
     					.width(_old_talks_w)
     				;

     				var is_added = false;

					for (var _k in data.talks)
     				{
     					is_added = true;

						var talk = data.talks[_k];

						if ($('#' + talk.id).size() == 0)
						{
							var _talk;

							if (!talk.uid)
							{
								_talk = $('<div/>')
									.addClass('system')
									.html(talk.message)
								;
							}
							else
							{
								_talk = $('<dl/>')
									.addClass('icon_' + talk.icon)
									.append(
										$('<dt/>')
											.addClass('avatar')
											.addClass(talk.icon)
											.attr({
												title : talk.name,
											})
											.append(
												$('<div/>')
													.addClass('name')
														.html(talk.name)
											)
									)
									.append(
										$('<dd/>')
											.append(
												$('<div/>')
													.addClass('bubble')
													.append(
														$('<div/>')
															.addClass('body')
															.addClass(talk.color)
															.html(talk.message)
													)
											)
									)
								;
							}

							_talk
								.addClass('talk')
								.attr({
									id : talk.id,
								})
							;

							_talks_new
								.append(_talk)
							;
						}
     				}

     				if (is_added)
     				{
						 _ui_talks();

						$.Dura.chat.trigger('resize');

						var _first_talk = _talks.find('> .talk:first');

						_talks_new
							.find('.talk')
								.each(function(){
									var _this = $(this);

									_talks.prepend(_this);
								})
						;

						$.Dura.chat.triggerWait('show', 200);
					}

				},
			},
		});

		$.timerWait(_getMessages, 5000);
	};

	$.Dura.chat.on('ready', function()
	{
		$.timerWait(_getMessages, 1500);
	});

})(jQuery);