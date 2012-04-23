			<?php if ( $dura['error'] ) : ?>
				<fieldset class="ui-header ui-bar-e dura-error">
					<?php $dura['error'] = is_array($dura['error']) ? $dura['error'] : array($dura['error']); ?>
					<?php foreach($dura['error'] as $_v): ?>
						<p>
							<?php e(t($_v)) ?>
						</p>
					<?php endforeach; ?>
				</fieldset>
			<?php endif ?>