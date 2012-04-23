
	<?php if (!$_SERVER['HTTP_X_REQUESTED_WITH']) $this->extend('theme'); ?>

	<?php $this->set('html.header.script', '<meta http-equiv="refresh" content="10;URL=' . $this->get('url') . '">') ?>

	<div data-role="dialog" data-theme="a" data-rel="dialog" data-ajax="false">
		<div data-role="header" data-theme="e">
			<h1><?php e(t("Alert")) ?></h1>
		</div>
		<div data-role="content">
			<p><?php e($dura['message']) ?></p>
			<p><?php e(t('If auto reload doesn\'t work,  please click <a href="{1}" data-ajax="false">here</a>.', $this->get('url'))) ?></p>
			<?php e($this->slot('theme.error'));?>
		</div>
	</div>
