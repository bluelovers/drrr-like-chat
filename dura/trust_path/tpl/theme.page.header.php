		<div data-role="header" data-position="fixed">
			<a href="<?php echo Dura::url(); ?>" data-icon="home"  data-iconpos="notext" data-direction="reverse"> Home </a>
			<h3><?php e($this->get('html.title', t(DURA_TITLE).' | '.t(DURA_SUBTITLE))) ?></h3>
			<a href="<?php echo Dura::url('page', 'about'); ?>" data-icon="info" data-iconpos="notext"><?php e(t("INFO")) ?></a>
			<a href="<?php echo Dura::url(Dura::$controller, Dura::$action); ?>#page_logout" data-icon="back" data-iconpos="notext" data-rel="dialog"><?php e(t("EXIT")) ?></a>
		</div>