
	<?php if (!$_SERVER['HTTP_X_REQUESTED_WITH']) $this->extend('theme'); ?>

	<?php $this->set('tpl.page.header.back', true); ?>

	<div data-role="page" id="page_lounge" data-theme="a">
		<?php e($this->slot('theme.page.header'));?>
		<div data-role="content">
			<div class="main-box ui-corner-top ui-header ui-bar-a">
				<fieldset class="ui-grid-a" id="profile">
					<div class="ui-block-a">
						<img src="<?php echo $dura['profile']['icon'] ?>"> <span><?php echo $dura['profile']['name'] ?></span>
					</div>
					<div class="ui-block-e">
						<?php e($this->slot('lounge.default.btn')) ?>
					</div>
					<div class="ui-block-e">

						<?php e($this->slot('lounge.default.btn.admin')) ?>

						<?php if ( Dura::user()->isAdmin() ) : ?>
							<a href="<?php e(Dura::url('admin_announce')) ?>" data-url="<?php e(Dura::url('admin_announce')) ?>" data-icon="gear" data-role="button"><?php e(t("Announce")) ?></a>
						<?php endif ?>
					</div>
				</fieldset>
			</div>
			<div data-theme="c" class="main-box ui-body-c ui-corner-bottom">

				<?php e($this->slot('theme.error'));?>

				<h3><?php e(t("Lounge")) ?></h3>
				<p><?php e(t("{1} users online!", $dura['active_user'])) ?></p>
				<fieldset data-role="fieldcontain">
					<a href="<?php e($dura['create_room_url']) ?>" data-rel="dialog" data-role="button"><?php e(t("CREATE ROOM")) ?></a>
				</fieldset>

				<?php if ($dura['rooms']) : ?>

				<ul data-theme="c" data-divider-theme="f" data-role="listview" data-filter="true" data-inset="true" data-filter-placeholder="Search room...">

					<?php $_languages = Dura_Model_Lang::getInstance()->getList()->toArray(); ?>

					<?php foreach ( $dura['rooms'] as $rooms ) : ?>
						<?php foreach ( $rooms as $room ) : ?>

							<?php if ($_last['language'] != $room['language']) : ?>

								<li data-role="list-divider" title="<?php e($room['language']); ?>">
									<span><img src="<?php echo DURA_URL; ?>/static/image/lang/<?php echo $room['language']; ?>.png" alt="<?php e($_languages[$room['language']]); ?>" class="ui-icon"> <?php e($_languages[$room['language']]); ?></span>
								</li>

							<?php endif ?>

							<li>
								<a href="<?php echo Dura::url('room', 'login', array('id' => $room['id'],)); ?>" data-ajax="false"> <img src="<?php echo DURA_URL; ?>/static/image/lang/<?php echo $room['language']; ?>.png" alt="<?php e(t($room['language'])); ?>" class="ui-li-icon">
								<h3><?php e($room['name']) ?></h3>
								<p><?php echo $room['creater'] ?></p>
								</a> <span class="ui-li-count"><?php e($room['total']) ?> / <?php e($room['limit']) ?></span>
							</li>

							<?php $_last = $room; ?>

						<?php endforeach ?>
					<?php endforeach ?>
				</ul>

				<?php endif ?>

			</div>
			<?php e($this->slot('theme.copyright'));?>
		</div>
		<?php e($this->slot('theme.footer'));?>
	</div>
	<?php e($this->slot('default.logout'));?>
