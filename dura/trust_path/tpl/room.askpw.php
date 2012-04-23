
	<?php if (!$_SERVER['HTTP_X_REQUESTED_WITH']) $this->extend('theme'); ?>

	<div data-role="dialog" id="page_room_askpw" data-theme="c" data-rel="dialog" >
		<div data-role="header" data-theme="f">
			<h1><?php e(t("Room Password")) ?></h1>
		</div>
		<div data-role="content">
			<form method="post" action="<?php e($dura['room']['url']) ?>" data-ajax="false">
				<div data-role="fieldcontain">
					<label for="name"><?php e(t("Room Name")) ?></label>
					<h2 id="name"><?php e($dura['room']['name']) ?></h2>
				</div>
				<div data-role="fieldcontain">
					<label for="login_password"><?php e(t("Password")) ?></label>
					<input name="login_password" id="login_password" type="password" />
				</div>
				<?php e($this->slot('theme.error'));?>
				<div data-role="fieldcontain">
					<input name="submit" value="<?php e(t("LOGIN")) ?>" type="submit" data-theme="d" />
					<a href="<?php echo Dura::url('lounge'); ?>" data-role="button" data-rel="back" data-theme="c"><?php e(t("Cancel")) ?></a>
					<input type="hidden" name="id" value="<?php e($dura['room']['id']) ?>" />
					<input type="hidden" name="action" value="login" />
				</div>
			</form>
		</div>
	</div>