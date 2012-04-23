
<?php if (!$_SERVER['HTTP_X_REQUESTED_WITH']) $this->extend('theme'); ?>

	<div data-role="page" id="page_default" data-theme="a">
		<?php e($this->slot('theme.page.header'));?>
		<div data-role="content">
			<div id="login" data-theme="c" class="main-box ui-body-c ui-corner-all">
				<form method="post" action="<?php echo Dura::url(Dura::$controller); ?>" data-ajax="false">
					<fieldset data-role="controlgroup">
						<select data-native-menu="false" name="language" data-mini="true">
							<?php foreach ( $dura['languages'] as $langcode => $language ) : ?>
								<option value="<?php e($langcode) ?>"<?php if ( $langcode == $dura['default_language']): ?> selected="selected"<?php endif ?>><?php e($language) ?></option>
							<?php endforeach ?>
						</select>
					</fieldset>
					<fieldset data-role="controlgroup" data-type="horizontal" id="icons">
						<?php foreach ( $dura['icons'] as $icon => $file ) : ?>
							<label class="ui-corner-all"> <img class="icon ui-corner-all" src="<?php echo Dura_Class_Icon::getIconUrl($icon) ?>"/>
								<input type="radio" name="icon" value="<?php echo $icon ?>" <?php if ( $icon == $dura['input']['icon']): ?> checked="checked"<?php endif ?> />
							</label>
						<?php endforeach ?>
						<input type="hidden" name="token" value="<?php echo $dura['token'] ?>" />
					</fieldset>
					<fieldset data-role="controlgroup">
						<input name="name" placeholder="<?php e(t('YOUR NAME')); ?>" value="<?php e($dura['input']['name']); ?>" type="text" />
					</fieldset>
					<fieldset data-role="fieldcontain" class="dura-btn-submit">
						<input name="submit" value="<?php e(t("ENTER")) ?>" type="submit" data-theme="d" />
						<input name="action" value="login" type="hidden" />
					</fieldset>

					<?php e($this->slot('theme.error'));?>
				</form>
				<div>
					<?php echo t('Welcome to Durarara-like-chat!'); ?>
				</div>
			</div>
			<?php e($this->slot('theme.copyright'));?>
		</div>
		<?php e($this->slot('theme.footer'));?>
	</div>
	<?php e($this->slot('admin.default'));?>
