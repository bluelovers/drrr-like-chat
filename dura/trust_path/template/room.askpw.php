<div class="header">
<h2><?php e(t("Room Password")) ?></h2>

<?php if ( $dura['error'] ) : ?>
<div>
<?php echo $dura['error'] ?>
</div>
<?php endif ?>

<form action="<?php e($dura['room']['url']) ?>" method="post">
<table>

<tr>
<td>
<?php e(t("Password")) ?>
</td>
<td>
<input type="textbox" name="login_password" value="" size="20" maxlength="48" />
</td>
</tr>

<tr>
<td></td>
<td>
<span class="button">
<input type="submit" name="login" value="<?php e(t("LOGIN")) ?>" class="input" />
</span>
<input type="hidden" name="id" value="<?php e($dura['room']['id']) ?>" />
</td>
</tr>
</table>

</form>
</div><!-- /#header -->
