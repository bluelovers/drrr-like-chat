
	<?php if (!$_SERVER['HTTP_X_REQUESTED_WITH']) $this->extend('theme'); ?>

	<?php $this->set('html.header.script', '<meta http-equiv="refresh" content="3;URL=' . $this->get('url') . '">') ?>

	<div data-role="page" data-theme="a">
		<div data-role="header" data-theme="e">
			<h1><?php e(t("EXIT")) ?></h1>
		</div>
		<div data-role="content">
			<p><?php e($this->get('message')) ?></p>
			<p><?php e(t('If auto reload doesn\'t work,  please click <a href="{1}">here</a>.', $this->get('url'))) ?></p>
		</div>
	</div>
