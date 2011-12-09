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
<!--link href="<?php echo DURA_URL; ?>/css/style.css" rel="stylesheet" type="text/css" media="screen" /-->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript"><!--
google.load("language", "1");
google.load("jquery", "1");
//google.load("jqueryui", "1");
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

<style>
* {
	margin: 0;
	padding: 0;
}

input, textarea{
	font-family: "lucida grande","Meiryo",tahoma,verdana,arial,sans-serif;
	outline: none;
}

.clear {
	clear: both;
}

.right {
	float: right;
}

.hide {
	display: none;
}

.transparent {
	opacity: 0.8;
}

#login {
	max-width: 620px;
}

	#login ul.icons {
		list-style-type: none;
	}

		#login ul.icons li {
			display: block;
			float: left;
			width: 60px;
			margin: 5px 5px;
			text-align: center;
		}

		#login ul.icons .icon {
			display: block;
			width: 53px;
			height: 53px;
			background-position: -3px -2px;
			border: #fff 2px solid;
			cursor: pointer;
		}

		#login ul.icons .icon:hover {
			opacity: 1;
			filter: alpha(opacity=100); zoom:1;
		}

		#login ul.icons .selected,
		#login ul.icons .notselected {
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			-o-border-radius: 10px;
		}

		#login ul.icons .selected {
			border: #0a0a0a 2px solid;
			opacity: 1;
			filter: alpha(opacity=100); zoom:1;
		}

		#login ul.icons .notselected {
			border: #fff 2px solid;
			opacity: 0.5;
			filter: alpha(opacity=50); zoom:1;
		}

	#login form {
		text-align: center;
		max-width: 280px;
		float: right;
	}

		#login form .textbox {
			width: 240px;
			font-size: 20px;
			letter-spacing: 1px;
			text-align: center;
			padding: 5px;
			border: 1px solid #cccccc;
			margin: 20px 0 20px 0;
		}

	.clearfix{display:inline-block;}
	* html .clearfix{height:1%;}
	.clearfix{display:block;}
	.clearfix:after{content:".";display:block;clear:both;visibility:hidden;line-height:0;height:0;}
	.clearfix{display:inline-block;}
	html[xmlns] .clearfix{display:block;}
	* html .clearfix{height:1%;}

	@media screen {
        html, body {
          width: 100%;
        }
	}
</style>

<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/translator.js"></script>
<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/language/<?php e(Dura::$language) ?>.js"></script>

<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.center.js"></script>
<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.base.js"></script>

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
<div id="body" data-role="page" data-theme="a" data-content-theme="a">

	<div data-role="header">

		<h1>
			<?php e(t(DURA_TITLE)) ?> | <?php e(t(DURA_SUBTITLE)) ?>
		</h1>

	</div>

<div data-role="content">
<?php e($content) ?>
</div>
</div>
</body>
</html>