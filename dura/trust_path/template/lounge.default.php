<div id="bodyLounge">

<ul id="profile">
<li class="icon"><img src="<?php echo $dura['profile']['icon'] ?>" /></li>
<li class="name"><?php echo $dura['profile']['name'] ?></li>
<li>
<!-- google plus -->
<!-- 請將這組標籤置於 <head> 標籤之後或 </body> 標籤之前。 -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	{lang: '<?php echo $dura['default_language'];?>'}
</script>

<!-- 請將這組標籤置於 +1 按鈕該出現的位置。 -->
<g:plusone size="tall" href="<?php echo DURA_URL;?>"></g:plusone>
<!-- google plus -->
</li>
<li class="logout">
<form action="<?php echo Dura::url('logout') ?>" method="post">

<?php if ( Dura::user()->isAdmin() ) : ?>
<a href="<?php e(Dura::url('admin_announce')) ?>"><?php e(t("Announce")) ?></a>
<?php endif ?>
<input type="submit" class="input" value="<?php e(t("LOGOUT")) ?>" />
</form>
</li>
</ul>

<div class="clear"></div>


<div class="header">
<h2><?php e(t("Lounge")) ?></h2>

<div class="right"><?php e(t("{1} users online!", $dura['active_user'])) ?></div>

<div class="clear"></div>


<div id="create_room">
<form action="<?php echo $dura['create_room_url'] ?>" method="post">
<span href="#" class="button"><input type="submit" class="input" value="<?php e(t("CREATE ROOM")) ?>" /></span>
</form>
</div>

<div class="clear"></div>

<ul data-role="listview" data-filter="true" data-inset="true">
<?php foreach ( $dura['rooms'] as $rooms ) : ?>
<li>
<?php foreach ( $rooms as $room ) : ?>
<ul class="rooms">
<li class="name">
	<?php e($room['name']) ?>
	<img src="<?php echo DURA_URL; ?>/static/image/lang/<?php echo $room['language']; ?>.png" alt="<?php echo $room['language']; ?>" class="icon_lang ui-li-icon"/>
	<?php echo $room['creater'] ?>
	<span class="ui-li-count"><?php e($room['total']) ?> / <?php e($room['limit']) ?></span>
<?php if ( $room['total'] >= $room['limit'] ) : ?>
<?php e(t("full")) ?>
<?php else : ?>
<form action="<?php e($room['url']) ?>" method="post">
<span class="button">
<input type="submit" name="login" value="<?php e(t("LOGIN")) ?>" class="input" />
</span>
<input type="hidden" name="id" value="<?php e($room['id']) ?>" />
</form>
<?php endif ?>
</li>
</ul>
<?php endforeach ?>
</li>
<?php endforeach ?>
</ul>

<div class="clear"></div>

</div>

</div>