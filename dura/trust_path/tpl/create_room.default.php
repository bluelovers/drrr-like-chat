
	<?php if (!$_SERVER['HTTP_X_REQUESTED_WITH']) $this->extend('theme'); ?>

	<div data-role="dialog" id="page_create_room" data-theme="c" data-rel="dialog" >
		<div data-role="header" data-theme="f">
			<h1><?php e(t("Create Room")) ?></h1>
		</div>
		<div data-role="content">
			<form method="post" action="<?php echo Dura::url(Dura::$controller, Dura::$action); ?>" data-ajax="false">
				<div data-role="fieldcontain">
					<label for="name"><?php e(t("Room Name")) ?></label>
					<input name="name" id="name" placeholder="<?php e(t("Room Name")) ?>" value="<?php echo $dura['input']['name'] ?>" type="text" />
				</div>
				<div data-role="fieldcontain">
					<label for="limit"><?php e(t("Max Members")) ?></label>
					<select data-native-menu="false" name="limit" id="limit" data-mini="true">
						<?php for ( $i = $dura['user_min']; $i <= $dura['user_max']; $i++ ): ?>
							<option value="<?php echo $i ?>"<?php if ($dura['input']['limit'] == $i ) : ?> selected="selected"<?php endif ?>><?php echo $i ?></option>
						<?php endfor ?>
					</select>
					<?php e(t("{1} members", '')) ?>
				</div>
				<div data-role="fieldcontain">
					<label for="language"><?php e(t("Language")) ?></label>
					<select data-native-menu="false" name="language" id="language" data-mini="true">
						<?php foreach ( $dura['languages'] as $langcode => $language ): ?>
							<option value="<?php e($langcode) ?>"<?php if ($langcode == Dura::user()->getLanguage() ) : ?> selected="selected"<?php endif ?>><?php e(t($language)) ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div data-role="fieldcontain">
					<label for="password"><?php e(t("Password")) ?></label>
					<input name="password" id="password" type="password" />
				</div>
				<div data-role="fieldcontain">
					<input name="submit" value="<?php e(t("CREATE!")) ?>" type="submit" data-theme="d" />
					<a href="<?php echo Dura::url('lounge'); ?>" data-role="button" data-rel="back"><?php e(t("Cancel")) ?></a>
				</div>
			</form>
		</div>
	</div>