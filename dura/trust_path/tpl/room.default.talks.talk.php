				<?php foreach ( $dura['room']['talks'] as $talk ) : ?>
					<?php if ( !$talk['uid'] ) : ?>
						<div class="talk system" id="<?php e($talk['id']) ?>" <?php e($talk['time'] <= $dura['input']['last_talk_time'] ? ' dura-show="1"' : ''); ?> data-time="<?php e($talk['time']) ?>" >
							<?php e($talk['message']) ?>
						</div>
					<?php else: ?>
						<dl class="talk icon_<?php e($talk['icon']) ?> <?php if ( $talk['uid'] == $dura['room']['host'] ) :?> dura-ishost <?php endif; ?>" data-uid="<?php e($talk['uid']) ?>" data-time="<?php e($talk['time']) ?>" id="<?php e($talk['id']) ?>" <?php e($talk['time'] <= $dura['input']['last_talk_time'] ? ' dura-show="1"' : ''); ?> >
							<dt class="avatar <?php e($talk['icon']) ?>" title="<?php e($talk['name']) ?>">
								<div class="avatar_icon"><img src="<?php e(Dura_Class_Icon::getIconUrl($dura['user']['icon'])) ?>" title="<?php e($talk['name']) ?>"></div>
								<div class="name"><?php e($talk['name']) ?></div>
							</dt>
							<dd>
								<div class="bubble">
									<div class="body <?php e($talk['color']) ?>"><?php e(nl2br($talk['message'])) ?></div>
								</div>
							</dd>
						</dl>
					<?php endif ?>
				<?php endforeach ?>