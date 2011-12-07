jQuery(function($)
{
	var LOGIN_DIALOG = '#login';
	var AVATAR_RADIO = '#login .icons input[type=radio]';
	var AVATAR_ICON  = '#login .icons .icon';

	var main = function()
	{
		moveToMiddle();
		hideAvatarRadio();
		updateIconView();
		registerEventToIcons();
	};

	var moveToMiddle = function()
	{
		var positionTop = getMarginTop();

		$(LOGIN_DIALOG).css({
			'position': 'absolute',
			'top':'50%',
			'margin-top': positionTop+'px'
		});
	}

	var getMarginTop = function()
	{
		return Math.round($(LOGIN_DIALOG).height() / 2) * -1;
	}

	var hideAvatarRadio = function()
	{
		// bluelovers
		$(AVATAR_ICON)
			.each(function(){
				var _this = $(this);

				_this
					.after(
						$('<div/>')
							.attr('class', _this.attr('class'))
							.css('background-image', 'url(' + _this.attr('src') + ')')
					)
					.remove()
				;
			})
		;
		// bluelovers

		$(AVATAR_RADIO).hide();
	}

	var registerEventToIcons = function()
	{
		$(AVATAR_ICON).click(function()
		{
			addCheckToIconRadio(this);
			updateIconView();
		});
	}

	var updateIconView = function()
	{
		$(AVATAR_ICON).removeClass('selected').addClass('notselected');

		$(AVATAR_ICON).each(function()
		{
			var checked = $(this).parent().find('[name=icon]').is(':checked');

			if ( checked )
			{
				$(this).removeClass('notselected').addClass('selected');
			}
		});
	}

	var addCheckToIconRadio = function(icon)
	{
		$(AVATAR_ICON).find('[name=icon]').removeAttr('checked');
		$(icon).parent().find('[name=icon]').attr('checked', 'checked');
	}

	main();
});