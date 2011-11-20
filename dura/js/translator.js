var Translator = function()
{
	this.catalog = {};

	this.translate = function(message)
	{
		try
		{
			if ( Translator.catalog[message] )
			{
				return Translator.catalog[message];
			}
		}
		catch(e)
		{
		}

		return message;
	};

	return this;
}

translator = new Translator();

function t(message)
{
	return translator.translate(message);
}

jQuery(function($){

	user = typeof user == 'undefined' ? {
		language : 'zh-TW',
	} : user;

	var _translate_func = function(event) {
		var _this = $(this);

		if (_this.prop('data-toggle') == -1) return;

		if (_this.prop('data-source')) {

			switch(event.type) {
				case 'mouseleave':
					_this.prop('data-toggle', 1);
					break;
				case 'mouseenter':
					_this.prop('data-toggle', 0);
					break;
			}

			_this
				.html(_this.prop('data-toggle') ? _this.prop('data-source') : _this.prop('data-translate'))
				.prop('data-toggle', _this.prop('data-toggle') ? 0 : 1)
			;
		} else {
			_this
				.prop({
					'data-source' : _this.html(),
					'title' : _this.text()
				})
				.prop('data-toggle', -1)
			;

			google.language.translate({text: _this.html(), type: 'html'}, '', user.language, function(result) {
				_this.prop('data-translate', result.translation);

				if (!_this.prop('data-translate') || result.translation == _this.prop('data-source')) {
					_this.prop('data-toggle', -1);
				} else if (_this.prop('data-toggle')) {
					_this.html(_this.prop('data-translate'));
					_this.prop('data-toggle', 1);
				}
			})
		}
	};

	$('#talks_box').delegate('.talk .body', {
		'mouseenter' : _translate_func,
		'mouseleave' : _translate_func
	});
	/*
	$('.rooms').delegate('.name', {
		'mouseenter' : _translate_func,
		'mouseleave' : _translate_func
	});
	*/
});
