
			<?php if (DURA_DEBUG && $this->get('dura-debug', true)): ?>
				<div class="dura-debug ui-bar-e" data-theme="e">

					<p><?php e($_SERVER['HTTP_USER_AGENT']) ?></p>

					<div><?php e($this->get('dura-debug-msg')) ?></div>

					<pre><?php 0 && var_dump(get_included_files()) ?></pre>

				</div>
			<?php endif ?>

			<div class="copyright" data-theme="a" data-role="fieldcontain">

				<p>

				<?php if (Dura::$controller == 'default'): ?>
					<a href="#page_admin" data-rel="dialog"><?php e("Admin") ?></a> |
				<?php endif ?>

				Durarara-like-chat Copyright (c) 2010 <a href="http://suin.asia/" target="_blank" rel="external">Suin</a> | Fork (c) <?php echo gmdate('Y', time()); ?> <a href="http://bluelovers.net/" target="_blank" rel="external">bluelovers</a>
				<?php if ( Dura::$controller != 'room' && (!defined('DURA_HIDE_FORK' ) || !DURA_HIDE_FORK) ) : ?>
				 | <a href="https://github.com/bluelovers/drrr-like-chat" target="_blank" rel="external">get this chat?</a>
				<?php endif ?>

				</p>

			</div>