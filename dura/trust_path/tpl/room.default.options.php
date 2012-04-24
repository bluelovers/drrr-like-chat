	<div data-role="dialog" id="page_room_options" data-theme="c" data-rel="dialog" >
		<div data-role="header" data-theme="f">
			<h1><?php e(t("Room Password")) ?></h1>
		</div>
		<div data-role="content">
			<form action="<?php e($this->get('room.url')); ?>" method="post" data-ajax="false">
				<div data-role="fieldcontain">
					<label for="name"><?php e(t("Room Name")) ?></label>
					<h2 id="name"><?php e($dura['room']['name']) ?></h2>
				</div>

				<div data-role="collapsible">
					<h3><?php e(t('Members')); ?></h3>

					<fieldset data-role="controlgroup" data-type="horizontal" class="room_members">
						<?php foreach ( $dura['room']['users'] as $user  ) : ?>
							<label class="ui-corner-all">
								<h4>
									<img class="icon ui-corner-all" src="<?php echo Dura_Class_Icon::getIconUrl($user['icon']) ?>"/>
									<?php e($user['name']) ?>
								</h4>
								<?php if ( $user['id'] == $dura['room']['host'] ) :?><?php e(t("(host)")) ?><?php endif ?>
								<input type="checkbox" name="uid" value="<?php e($user['id']) ?>" />
							</label>
						<?php endforeach ?>
						<input type="hidden" name="token" value="<?php echo $dura['token'] ?>" />
					</fieldset>

				</div>

				<?php e($this->slot('theme.error'));?>
				<div data-role="fieldcontain">
					<input name="submit" value="<?php e(t("LOGIN")) ?>" type="submit" data-theme="d" />
					<a href="<?php echo Dura::url('room'); ?>" data-role="button" data-rel="back" data-theme="c"><?php e(t("Cancel")) ?></a>
					<input type="hidden" name="id" value="<?php e($dura['room']['id']) ?>" />
					<input type="hidden" name="action" value="login" />
				</div>
			</form>
		</div>
	</div>