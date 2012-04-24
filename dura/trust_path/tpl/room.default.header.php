
	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/SoundManager2/script/soundmanager2-nodebug-jsmin.js"></script>
	<script type="text/javascript">
soundManager.url = '<?php e(DURA_URL) ?>/js/SoundManager2/swf/';
soundManager.useHTML5Audio = true;
soundManager.preferFlash = false;

soundManager.onready(function() {
	messageSound = soundManager.createSound({
	  id: 'messageSound',
	  url: '<?php e(DURA_URL) ?>/js/sound.mp3',
	  volume: 100
	});
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