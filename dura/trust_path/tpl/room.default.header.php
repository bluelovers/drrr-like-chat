
<script type="text/javascript">
duraUrl = "<?php e(DURA_URL) ?>";
GlobalMessageMaxLength = <?php e(DURA_MESSAGE_MAX_LENGTH) ?>;
useComet = <?php e(DURA_USE_COMET) ?>;
</script>

	<script type="text/javascript" src="<?php e(DURA_URL) ?>/static/js/jquery.corner.js"></script>
	<!--script type="text/javascript" src="<?php e(DURA_URL) ?>/static/js/jquery.chat.js"></script-->

	<script type="text/javascript" src="<?php e(DURA_URL) ?>/static/js/jquery.easing.1.3.js"></script>

<?php e($this->slot('room.default.js.sound'));?>

<script>

<?php e($this->slot('room.default.js.chat'));?>

</script>