
	<script type="text/javascript" src="<?php e(DURA_URL) ?>/static/js/jquery.color.js"></script>

	<script>

	<?php e($this->slot('theme.header.js.core')) ?>

(function($){

	var _e_last = {};

	/*
	var _event = function(e)
	{
		if (!_e_last.e || _e_last.e.target != e.target)
		{
			$.log(['_event', e.target]);
		}

		_e_last.e = e;

		if (!_e_last.page || ($('.ui-page-active').size() && _e_last.page && _e_last.page != $('.ui-page-active')))
		{
			$.log(['.ui-page-active', $('.ui-page-active').size(), $('.ui-page-active')]);

			_e_last.page = $('.ui-page-active');
		}

		if (!_e_last.e.data || _e_last.e.data.who != e.data.who)
		{
			$.log(['_event who', e.data.who]);
		}

		$.log({
			bind: e.data.bind,

			type: e.type,
			namespace: e.namespace,
			timeStamp: e.timeStamp,
			data: e.data,
			handleObj: e.handleObj,
			target: e.target,

			e: e,

			'_this': this,
		});
	};

	$(window)
		.bind('pageshow.dura', {bind: 'pageshow.dura', who: window}, _event)
		.bind('pageresize.dura', {bind: 'pageresize.dura', who: window}, _event)
		.bind('dura.chat', {bind: 'dura.chat', who: window}, _event)
		.bind('dura.mobile', {bind: 'dura.mobile', who: window}, _event)
		.bind('dura', {bind: 'dura', who: window}, _event)
		.bind('pagechange', {bind: 'pagechange', who: window}, _event)
		.bind('pageload', {bind: 'pageload', who: window}, _event)
		.bind('pageinit', {bind: 'pageinit', who: window}, _event)
		.bind('popstate', {bind: 'popstate', who: window}, _event)
		.bind('pageshow', {bind: 'pageshow', who: window}, _event)
		.bind('ready', {bind: 'ready', who: window}, _event)
		.bind('resize', {bind: 'resize', who: window}, _event)
		.bind('orientationchange', {bind: 'orientationchange', who: window}, _event)
	;

	$(document)
		.bind('pageshow.dura', {bind: 'pageshow.dura', who: document}, _event)
		.bind('pageresize.dura', {bind: 'pageresize.dura', who: document}, _event)
		.bind('dura.chat', {bind: 'dura.chat', who: document}, _event)
		.bind('dura.mobile', {bind: 'dura.mobile', who: document}, _event)
		.bind('dura', {bind: 'dura', who: document}, _event)
		.bind('pagechange', {bind: 'pagechange', who: document}, _event)
		.bind('pageload', {bind: 'pageload', who: document}, _event)
		.bind('pageinit', {bind: 'pageinit', who: document}, _event)
		.bind('popstate', {bind: 'popstate', who: document}, _event)
		.bind('pageshow', {bind: 'pageshow', who: document}, _event)
		.bind('ready', {bind: 'ready', who: document}, _event)
		.bind('resize', {bind: 'resize', who: document}, _event)
		.bind('orientationchange', {bind: 'orientationchange', who: document}, _event)
	;

	$('.ui-page, [data-role="page"]')
		.live('pageshow.dura', {bind: 'pageshow.dura', who: '.ui-page'}, _event)
		.live('pageresize.dura', {bind: 'pageresize.dura', who: '.ui-page'}, _event)
		.live('dura.chat', {bind: 'dura.chat', who: '.ui-page'}, _event)
		.live('dura.mobile', {bind: 'dura.mobile', who: '.ui-page'}, _event)
		.live('dura', {bind: 'dura', who: '.ui-page'}, _event)
		.live('pagechange', {bind: 'pagechange', who: '.ui-page'}, _event)
		.live('pageload', {bind: 'pageload', who: '.ui-page'}, _event)
		.live('pageinit', {bind: 'pageinit', who: '.ui-page'}, _event)
		.live('popstate', {bind: 'popstate', who: '.ui-page'}, _event)
		.live('pageshow', {bind: 'pageshow', who: '.ui-page'}, _event)
		.live('ready', {bind: 'ready', who: '.ui-page'}, _event)
		.live('resize', {bind: 'resize', who: '.ui-page'}, _event)
		.live('orientationchange', {bind: 'orientationchange', who: '.ui-page'}, _event)
	;
	*/

})(jQuery);

</script>

	<!-- seo -->

	<meta name="author" content="Bluelovers" />
	<meta name="copyright" content="Bluelovers Net." />
	<meta name="robots" content="INDEX,FOLLOW" />
	<meta name="keywords" content="<?php e(t(DURA_TITLE)) ?>, <?php e(t(DURA_SUBTITLE)) ?>, Durarara, Chat, デュラララ, チャット, 듀라라라!!, 채팅방, 聊天室, Чат, как в, 無頭騎士異聞錄, 成田良悟, DOLLARS, 罪歌, 甘樂, 賽頓, 田中太郎, 巴裘拉, 墮落聊天室, bluelovers />
	<meta name="description" content="<?php e(t(DURA_TITLE)) ?> | <?php e(t(DURA_SUBTITLE)) ?>" />
	<!-- seo - End -->
	<meta http-equiv="imagetoolbar" content="no" />
	<meta name="MSSmartTagsPreventParsing" content="True" />
	<meta http-equiv="MSThemeCompatible" content="Yes" />
	<meta name="msapplication-tooltip" content="<?php e(t(DURA_TITLE)) ?> | <?php e(t(DURA_SUBTITLE)) ?>" />
	<link rel="shortcut icon" href="<?php echo DURA_URL; ?>/favicon.ico" type="image/x-icon" />
	<link rel="Bookmark" href="<?php echo DURA_URL; ?>/favicon.ico" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo DURA_URL; ?>/static/img/apple-touch-icon-precomposed.png" />

	<meta property="og:title" content="<?php e($this->get('html.title', t(DURA_TITLE).' | '.t(DURA_SUBTITLE))) ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php e($this->get('tpl.header.canonical', DURA_URL)); ?>" />
	<meta property="og:image" content="<?php echo DURA_URL; ?>/static/style/icon/lolita.png" />
	<meta property="og:site_name" content="bluelovers" />
	<meta property="og:description" content="<?php e(t(DURA_TITLE)) ?> | <?php e(t(DURA_SUBTITLE)) ?>" />

	<style>
<?php e($this->slot('theme.css')) ?>
</style>
	<script type="text/javascript">

(function($){
	var preventDefaultScroll = function(event) {

		if (event) event.preventDefault();

		var _who = $([window, 'html, body']);

		_who
			.scrollTop(0)
			.scrollLeft(0)
		;

		$('#page_default #icons label').addClass('ui-corner-all');

		$.mobile.silentScroll (0) ;
	};

	var _resize = function(event) {
		try{
		$('.ui-page-active div.ui-footer-fixed').css('margin-top', $('.ui-page-active div.ui-footer-fixed').height());
		}catch(e){}
	};

	$(window)
		.bind("dura.mobile.ready", preventDefaultScroll)
		.bind("dura.mobile.resize", _resize)
		.bind("dura.mobile.ready", function()
		{
			$('a#scrolltop')
				.bind('click', preventDefaultScroll)
			;
		})
	;

	$(window).bind('dura.mobile.resize', function()
	{

		var _c = $('.ui-page-active .ui-content[role="main"]');
		var _a = _c.find('.content-primary');
		var _b = _c.find('.content-secondary');

		var height = _c.innerHeight();
		var width = _c.innerWidth();
		var width = $('html, body').innerWidth();

		if (1 && _a.size() && _b.size())
		{
			var _c_w = Math.min(130, _b.outerWidth()) + 30;
			var _a_w = _a.outerWidth() + _c_w;

			//var _cc = ['content-float-left', 'content-float-right'];
			var _cc = ['content-float-right', 'content-float-left'];

			$(_a)
				.removeClass(_cc[0])
				.removeClass(_cc[1])
			;
			$(_b)
				.removeClass(_cc[0])
				.removeClass(_cc[1])
			;

			if (width >= _a_w)
			{
				_b.addClass(_cc[0]);

				if (width <= _a_w + _c_w)
				{
					_a.addClass(_cc[1]);
				}
				else
				{
					_a.removeClass(_cc[1]);
				}

				_a
					.before(_b)
				;
			}
			else
			{
				_a
					.after(_b)
				;
			}
		}
	});

	$(window)
		.bind('pagechange', function()
		{
			$(window)
				.trigger('dura.mobile.ready');
			$(window)
				.trigger('dura.mobile.resize')
			;
		})
		.bind('orientationchange, pagechange, resize', function()
		{
			$(window).trigger('dura.mobile.resize');
		})
	;
})(jQuery);
</script>

	<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{parsetags: 'explicit'}</script>
	<script>

/*
(function($) {

	if (!$.support.pushState) {
		return;
	}

	$(window).bind( "pagechange", function(e, triggered) {
		var pathname = $.mobile.activePage.attr('data-url');

		if (pathname != $.mobile.activePage.attr('id'))
		{
			history.replaceState({
				hash: location.hash || "#" + $.mobile.activePage.attr('id'),
				title: document.title,

				// persist across refresh
				initialHref: pathname
			}, document.title, pathname);
		}
	});

	$(window).bind( "popstate", function(e) {
		$.mobile.changePage(location);
	});

})(jQuery);
*/
</script>
	<?php e($this->get('html.header.script')) ?>

	<script type="text/javascript" src="<?php e(DURA_URL) ?>/static/js/tipTipv13/jquery.tipTip.minified.js"></script>
	<link rel="stylesheet" href="<?php e(DURA_URL) ?>/static/js/tipTipv13/tipTip.css" />

	<script>

	$(document).bind('pageinit, changepage, ready', function(){
		$(".ui-page [title], .ui-page [alt]")
			.each(function(){
				var _this = $(this);

				if (!_this.attr('title'))
				{
					_this.attr('title', _this.attr('alt'));
				}
			})
			.tipTip();
	});

	</script>

<style>

#tiptip_content
{
	font-size: 1.5em;
}

</style>

<script>

/*
jQuery(function(){
	$(window).trigger('dura.mobile.ready');
});
*/

</script>