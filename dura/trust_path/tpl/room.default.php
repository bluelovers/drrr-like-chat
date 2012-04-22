
	<?php if (!$_SERVER['HTTP_X_REQUESTED_WITH']) $this->extend('theme'); ?>

	<?php $this->set('html.title', $dura['room']['name'] .' | '.t(DURA_TITLE).' | '.t(DURA_SUBTITLE)) ?>

	<?php $this->set('html.header.script', $this->slot('room.default.header')) ?>

	<div data-role="page" id="page_room" data-theme="d" data-rel="dialog" data-title="<?php e($this->get('html.title')) ?>">
		<div data-role="header" data-theme="d" data-position="fixed">
			<a href="#page_default" data-icon="home"  data-iconpos="notext" data-direction="reverse"> Home </a>
			<h1><span id="room_name"><?php e($dura['room']['name']) ?></span> | <?php e(t(DURA_TITLE).' | '.t(DURA_SUBTITLE)) ?></h1>
			<a href="#page_logout" data-icon="back" data-iconpos="notext" data-rel="dialog"><?php e(t("EXIT")) ?></a>
		</div>
		<div data-role="content">
			<div class="ui-header ui-bar-d">
				<div class=" main-box" id="message">
					<form action="#" method="post">
						<div data-role="fieldcontain">
							<div class="menu">
								<div class="g-plusone" data-size="small" data-href="http://chat.in-here.us">
								</div>
							</div>
						</div>
						<fieldset class="ui-grid-a ">
							<div class="ui-block-e user">
								<div>
									<img src="<?php e(Dura_Class_Icon::getIconUrl($dura['user']['icon'])) ?>">
								</div>
								<div>
									<?php e($dura['user']['name']) ?>
								</div>
							</div>
							<div class="ui-block-b">
								<textarea name="message" data-theme="c"></textarea>
								<div data-role="fieldcontain" class="dura-btn-submit">
									<input type="submit" value="<?php e(t('POST!')); ?>" name="post" data-theme="d" data-mini="true">
								</div>
							</div>
						</fieldset>
						<ul style="display: none">
							<li id="user_id"><?php e($dura['user']['id']) ?></li>
							<li id="user_name"><?php e($dura['user']['name']) ?></li>
							<li id="user_icon"><?php e($dura['user']['icon']) ?></li>
							<li id="user_color"><?php e($dura['user']['color']) ?></li>
						</ul>
					</form>
				</div>
			</div>
			<div class="main-box" id="talks">

				<?php foreach ( $dura['room']['talks'] as $talk ) : ?>
					<?php if ( !$talk['uid'] ) : ?>
						<div class="talk system" id="<?php e($talk['id']) ?>">
							<?php e($talk['message']) ?>
						</div>
					<?php else: ?>
						<dl class="talk icon_<?php e($talk['icon']) ?>" id="<?php e($talk['id']) ?>">
							<dt class="avatar <?php e($talk['icon']) ?>"><?php e($talk['name']) ?></dt>
							<dd>
								<div class="bubble">
									<p class="body <?php e($talk['color']) ?>"><?php e($talk['message']) ?></p>
								</div>
							</dd>
						</dl>
					<?php endif ?>
				<?php endforeach ?>

			</div>
		</div>
		<?php e($this->slot('theme.footer'));?>
	</div>
	<?php e($this->slot('default.logout'));?>