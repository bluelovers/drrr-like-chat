		<div data-role="header" data-position="fixed" <?php e($this->get('tpl.page.header.attr')) ?>>

			<div data-role="controlgroup" data-type="horizontal" class="ui-btn-left" >

				<?php if ($this->get('tpl.page.header.home', true)): ?>
					<a href="<?php e($this->get('tpl.page.header.home.url', Dura::url())) ?>" data-icon="home"  data-iconpos="notext" data-direction="reverse" data-role="button"> Home </a>
				<?php endif ?>

				<?php e($this->get('tpl.page.header.btn.left')); ?>

			</div>

			<h3><?php e($this->get('html.title', t(DURA_TITLE).' | '.t(DURA_SUBTITLE))) ?></h3>

			<div data-role="controlgroup" data-type="horizontal" class="ui-btn-right" >

				<?php e($this->get('tpl.page.header.btn.right')); ?>

				<?php if (Dura::$controller != 'page' && Dura::$action != 'about'): ?>
					<a href="<?php echo Dura::url('page', 'about'); ?>" data-icon="info" data-iconpos="notext" data-role="button" data-ajax="false"><?php e(t("INFO")) ?></a>
				<?php endif ?>
				<?php if ($this->get('tpl.page.header.back')): ?>
					<a href="<?php e($this->get('tpl.page.header.back.url', Dura::url(Dura::$controller, Dura::$action).'#page_logout')); ?>" data-icon="back" data-iconpos="notext" data-rel="dialog" data-role="button"><?php e(t("EXIT")) ?></a>
				<?php endif ?>
			</div>

		</div>