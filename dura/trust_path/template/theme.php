<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!-- seo -->
<meta http-equiv="Content-Language" content="<?php echo Dura::user()->getLanguage(); ?>" />
<meta name="author" content="Bluelovers" />
<meta name="copyright" content="Bluelovers Net." />
<meta name="robots" content="INDEX,FOLLOW" />
<meta name="keywords" content="<?php e(t(DURA_TITLE)) ?>, <?php e(t(DURA_SUBTITLE)) ?>, Durarara, Chat, デュラララ, チャット, 듀라라라!!, 채팅방, 聊天室, Чат, как в, 無頭騎士異聞錄, 成田良悟, DOLLARS, 罪歌, 甘樂, 賽頓, 田中太郎, 巴裘拉, 墮落聊天室, bluelovers" />
<meta name="description" content="<?php e(t(DURA_TITLE)) ?> | <?php e(t(DURA_SUBTITLE)) ?>" />
<!-- seo - End -->
<meta http-equiv="imagetoolbar" content="no">
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<meta name="msapplication-tooltip" content="<?php e(t(DURA_TITLE)) ?> | <?php e(t(DURA_SUBTITLE)) ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo DURA_URL; ?>/favicon.ico" type="image/x-icon" />
<link rel="Bookmark" href="<?php echo DURA_URL; ?>/favicon.ico" />
<title><?php e(t(DURA_TITLE)) ?> | <?php e(t(DURA_SUBTITLE)) ?></title>
<link rel="apple-touch-icon-precomposed" href="<?php echo DURA_URL; ?>/images/apple-touch-icon-precomposed.png" />
<link href="<?php echo DURA_URL; ?>/css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
google.load("language", "1");
google.load("jquery", "1");
google.load("jqueryui", "1");
duraUrl = "<?php e(DURA_URL) ?>";
GlobalMessageMaxLength = <?php e(DURA_MESSAGE_MAX_LENGTH) ?>;
useComet = <?php e(DURA_USE_COMET) ?>;
// bluelovers
user = {
	language : '<?php echo Dura::user()->getLanguage(); ?>',
};
// bluelovers
//-->
</script>

<link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>

<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/translator.js"></script>
<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/language/<?php e(Dura::$language) ?>.js"></script>

<?php if ( Dura::$controller == 'room' && Dura::$action == 'default' ) : ?>
<!--script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.sound.js"></script-->
<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/SoundManager2/script/soundmanager2-nodebug-jsmin.js"></script>

<script>
soundManager.url = '<?php e(DURA_URL) ?>/js/SoundManager2/swf/';
soundManager.onready(function() {
	messageSound = soundManager.createSound({
	  id: 'messageSound',
	  url: '<?php e(DURA_URL) ?>/js/sound.mp3',
	  volume: 100
	});
});
</script>

<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.corner.js"></script>
<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.chat.js"></script>
<?php endif ?>
<?php if ( file_exists(DURA_TEMPLATE_PATH.'/header.html') ) require(DURA_TEMPLATE_PATH.'/header.html'); ?>
</head>
<body>
<div id="body" data-theme="a">
<?php e($content) ?>
</div>
</body>
</html>