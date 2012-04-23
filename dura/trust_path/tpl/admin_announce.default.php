	<div data-role="dialog" id="page_<?php e(Dura::$controller) ?>" data-theme="a" data-rel="dialog" data-url="<?php echo Dura::url(Dura::$controller); ?>">
		<div data-role="header">
			<h1><?php e(t("Admin Announce")) ?></h1>
		</div>
		<div data-role="content">
			<form action="<?php echo Dura::url(Dura::$controller); ?>" method="post" id="message">
				<textarea name="message" data-theme="c"></textarea>
				<div data-role="fieldcontain">
					<input type="submit" value="<?php e(t('POST!')); ?>" name="post">
				</div>
				<a href="<?php echo Dura::url('lounge'); ?>" data-role="button" data-rel="back" data-theme="c"><?php e(t("Cancel")) ?></a>
			</form>

			<div class="main-box" id="talks">

				<?php foreach ( $dura['talks'] as $time ) foreach ( $time as $talk ) : ?>
					<?php if ( !$talk['uid'] ) : ?>
						<div class="talk system" id="<?php e($talk['id']) ?>">
							<?php e($talk['message']) ?>
						</div>
					<?php else: ?>
						<dl class="talk icon_<?php e($talk['icon']) ?>" id="<?php e($talk['id']) ?>">
							<dt class="avatar <?php e($talk['icon']) ?>"><?php e($talk['name']) ?></dt>
							<dd>
								<div class="bubble">
									<p class="body <?php e($talk['color']) ?>"><?php e($talk['message']) ?></p>
								</div>
							</dd>
						</dl>
					<?php endif ?>
				<?php endforeach ?>

			</div>
		</div>
	</div>