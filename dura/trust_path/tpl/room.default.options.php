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

				<div data-role="collapsible-set">

					<div data-role="collapsible">
						<h3><?php e(t('Room')); ?></h3>

						<div data-role="fieldcontain">
							<label for="room_name"><?php e(t("Room Name")) ?></label>
							<input name="room_name" id="room_name" type="text" value="<?php e($dura['room']['name']) ?>" placeholder="<?php e(t("Room Name")) ?>" />
						</div>

					</div>

					<div data-role="collapsible">
						<h3><?php e(t('Members')); ?></h3>

						<input type="submit" name="handover" value="<?php e(t("Handover host")) ?>" _disabled="disabled" />
						<input type="submit" name="ban" value="<?php e(t("Ban user")) ?>" _disabled="disabled" />

						<fieldset data-role="controlgroup" data-type="horizontal" class="room_members">
							<?php foreach ( $dura['room']['users'] as $user  ) : ?>
								<label class="ui-corner-all">
									<h4>
										<img class="icon ui-corner-all" src="<?php echo Dura_Class_Icon::getIconUrl($user['icon']) ?>"/>
										<?php e($user['name']) ?>
									</h4>
									<?php if ( $user['id'] == $dura['room']['host'] ) :?><?php e(t("(host)")) ?><?php endif ?>
									<input type="radio" name="uid" value="<?php e($user['id']) ?>" <?php if ( $user['id'] == $dura['room']['host'] ) :?> disabled="disabled"<?php endif ?> />
								</label>
							<?php endforeach ?>
						</fieldset>

					</div>

				</div>

				<?php e($this->slot('theme.error'));?>
				<div data-role="fieldcontain">
					<input name="save" value="<?php e(t("Change")) ?>" type="submit" data-theme="d" />
					<a href="<?php e($this->get('room.url')); ?>#page_room" data-role="button" data-rel="back" data-theme="c"><?php e(t("Cancel")) ?></a>
					<input type="hidden" name="id" value="<?php e($dura['room']['id']) ?>" />
					<input type="hidden" name="action" value="default" />
				</div>
			</form>
		</div>
	</div>