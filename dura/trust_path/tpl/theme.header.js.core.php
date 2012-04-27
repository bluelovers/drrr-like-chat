(function($){

	$.extend($, {
		log: function(data)
		{
			console.log(data);
			$('.dura-debug').append('<p>'+data.join(', ')+'</p>');
		}
	});

	$.extend($, {}, {
		timerWait : function(event, timeout, loop)
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

			//$.log([_data_key, _data[event].name, _data[event].timeout, _this, _data[event]]);

			_data[event].id = setTimeout(_data[event].func, _data[event].timeout);
			_this.data(_data_key, _data);
		}
	});

	$.fn.triggerWait = function(event, timeout){
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
			_data[event] = event;
			_data[event] = {
				name : event,
				timeout : timeout,
				func : function(){
					_this.trigger(event);
				},
			};
		}

		//$.log([_data_key, _data[event].name, _data[event].timeout, _this, _data[event]]);

		_data[event].id = setTimeout(_data[event].func, _data[event].timeout);
		_this.data(_data_key, _data);

		return this;
	};

})(jQuery);