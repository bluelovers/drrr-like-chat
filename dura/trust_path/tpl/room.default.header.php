
	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/SoundManager2/script/soundmanager2-nodebug-jsmin.js"></script>
	<script type="text/javascript">

var messageSound;

soundManager.url = '<?php e(DURA_URL) ?>/js/SoundManager2/swf/';

soundManager.preferFlash = false;
soundManager.useHTML5Audio = true;

soundManager.onload = function() {
	messageSound = soundManager.createSound({
		id: 'messageSound',
		url: '<?php e(DURA_URL) ?>/js/sound.mp3',
		volume: 100
	});
};

soundManager.debugMode = true;
soundManager.useFlashBlock = true;
soundManager.useConsole = true;
soundManager.useHighPerformance = true;
soundManager.useHTML5Audio = true;

/*
soundManager.audioFormats = {
	'mp3': {
		'type': ['audio/mpeg; codecs="mp3"', 'audio/mpeg', 'audio/mp3', 'audio/MPA', 'audio/mpa-robust'],
		'required': true //必须支持，false可不支持
	}
};
*/

soundManager.onready(function() {
	soundManager.onload();
});
</script>

<script type="text/javascript">
duraUrl = "<?php e(DURA_URL) ?>";
GlobalMessageMaxLength = <?php e(DURA_MESSAGE_MAX_LENGTH) ?>;
useComet = <?php e(DURA_USE_COMET) ?>;
</script>

	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.corner.js"></script>
	<!--script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.chat.js"></script-->

	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.color.js"></script>
	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.easing.1.3.js"></script>

<script>

<?php e($this->slot('room.default.js.chat'));?>

</script>