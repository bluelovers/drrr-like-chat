	<div data-role="page" id="page_admin" data-theme="a">
		<div data-role="header">
			<h1>Admin</h1>
		</div>
		<div data-role="content">
			<form method="post" action="">
				<fieldset data-role="controlgroup">
					<label for="name">管理者ID</label>
					<input name="name" placeholder="YOUR NAME" value="" type="text" />
				</fieldset>
				<fieldset data-role="controlgroup">
					<label for="pass">パスワード</label>
					<input name="pass" type="password" />
				</fieldset>
				<fieldset data-role="fieldcontain">
					<input name="login" value="入室" type="submit" />
				</fieldset>
			</form>
		</div>
	</div>