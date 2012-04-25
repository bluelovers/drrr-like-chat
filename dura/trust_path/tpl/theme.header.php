
	<!-- seo -->
	<meta http-equiv="Content-Language" content="<?php e(Dura::user()->getLanguage() ? Dura::user()->getLanguage() : DURA_LANGUAGE); ?>" />
	<meta name="author" content="Bluelovers" />
	<meta name="copyright" content="Bluelovers Net." />
	<meta name="robots" content="INDEX,FOLLOW" />
	<meta name="keywords" content="<?php e(t(DURA_TITLE)) ?>, <?php e(t(DURA_SUBTITLE)) ?>, Durarara, Chat, デュラララ, チャット, 듀라라라!!, 채팅방, 聊天室, Чат, как в, 無頭騎士異聞錄, 成田良悟, DOLLARS, 罪歌, 甘樂, 賽頓, 田中太郎, 巴裘拉, 墮落聊天室, bluelovers" />
	<meta name="description" content="<?php e(t(DURA_TITLE)) ?> | <?php e(t(DURA_SUBTITLE)) ?>" />
	<!-- seo - End -->
	<meta http-equiv="imagetoolbar" content="no" />
	<meta name="MSSmartTagsPreventParsing" content="True" />
	<meta http-equiv="MSThemeCompatible" content="Yes" />
	<meta name="msapplication-tooltip" content="<?php e(t(DURA_TITLE)) ?> | <?php e(t(DURA_SUBTITLE)) ?>" />
	<link rel="shortcut icon" href="<?php echo DURA_URL; ?>/favicon.ico" type="image/x-icon" />
	<link rel="Bookmark" href="<?php echo DURA_URL; ?>/favicon.ico" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo DURA_URL; ?>/images/apple-touch-icon-precomposed.png" />

	<meta property="og:title" content="<?php e($this->get('html.title', t(DURA_TITLE).' | '.t(DURA_SUBTITLE))) ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php e($this->get('tpl.header.canonical', DURA_URL)); ?>" />
	<meta property="og:image" content="<?php echo DURA_URL; ?>/css/icon/lolita.png" />
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



$(document)
	.bind("ready, pageinit, pageshow", preventDefaultScroll)
	.bind("updatelayout, pageshow, orientationchange", _resize)
;

$(window).bind('resize', _resize);

$('a#scrolltop')
	.live('click', preventDefaultScroll)
;
})($);
</script>

	<!-- 將此標記放在標頭中，或是結尾內文標記前方 -->
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
