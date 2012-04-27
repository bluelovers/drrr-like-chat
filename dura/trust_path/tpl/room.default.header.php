
<script type="text/javascript">
duraUrl = "<?php e(DURA_URL) ?>";
GlobalMessageMaxLength = <?php e(DURA_MESSAGE_MAX_LENGTH) ?>;
useComet = <?php e(DURA_USE_COMET) ?>;
</script>

	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.corner.js"></script>
	<!--script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.chat.js"></script-->

	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.easing.1.3.js"></script>

<link rel="stylesheet" href="<?php e(DURA_URL) ?>/js/jquery.mobile.alert/jquery.mobile.alert.css" />
<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.mobile.alert/jquery.mobile.alert.js"></script>

<?php e($this->slot('room.default.js.sound'));?>

<script>

<?php e($this->slot('room.default.js.chat'));?>

</script>