	<div data-role="dialog" id="page_logout" data-theme="a" data-rel="dialog">
		<div data-role="header" data-theme="e">
			<h1><?php e(t("EXIT")) ?></h1>
		</div>
		<div data-role="content">
			<form method="post" action="" data-ajax="false">
				<fieldset data-role="fieldcontain" class="ui-btn-active">
					<input name="submit" value="<?php e(t("EXIT")) ?>" type="submit" class="ui-btn-active" />
				</fieldset>
				<input type="hidden" name="action" value="logout" />
				<input type="hidden" name="controller" value="<?php e(Dura::$controller) ?>" />

				<a href="<?php echo Dura::url(Dura::$controller, 'logout'); ?>" data-role="button" data-rel="back"><?php e(t("Cancel")) ?></a>
			</form>
		</div>
	</div>