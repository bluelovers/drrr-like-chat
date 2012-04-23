		<div data-role="header" data-position="fixed">
			<a href="<?php echo Dura::url(); ?>" data-icon="home"  data-iconpos="notext" data-direction="reverse" data-inline="true"> Home </a>
			<h3><?php e($this->get('html.title', t(DURA_TITLE).' | '.t(DURA_SUBTITLE))) ?></h3>
			<div data-role="controlgroup" data-type="horizontal" class="ui-btn-right" >
				<a href="<?php echo Dura::url('page', 'about'); ?>" data-icon="info" data-iconpos="notext" data-role="button"><?php e(t("INFO")) ?></a>
				<a href="<?php echo Dura::url(Dura::$controller, Dura::$action); ?>#page_logout" data-icon="back" data-iconpos="notext" data-rel="dialog" data-role="button"><?php e(t("EXIT")) ?></a>
			</div>
		</div>