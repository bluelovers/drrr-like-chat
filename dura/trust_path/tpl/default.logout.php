	<div data-role="page" id="page_logout" data-theme="a">
		<div data-role="header" data-theme="e">
			<h1><?php e(t("EXIT")) ?></h1>
		</div>
		<div data-role="content">
			<form method="post" action="" data-ajax="false">
				<fieldset data-role="fieldcontain">
					<input name="submit" value="<?php e(t("EXIT")) ?>" type="submit" />
				</fieldset>
				<input type="hidden" name="action" value="logout" />
				<input type="hidden" name="controller" value="<?php e(Dura::$controller) ?>" />
			</form>
		</div>
	</div>