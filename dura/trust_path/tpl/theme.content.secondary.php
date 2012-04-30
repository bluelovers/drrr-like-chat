
			<div class="content-secondary" data-theme="a" data-role="fieldcontain">
				<p>
					<a href="http://www.facebook.com/sharer.php?u=<?php e(rawurlencode($this->get('tpl.header.canonical', DURA_URL))); ?>" target="_blank">
						<img src="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=<?php e(rawurlencode($this->get('tpl.header.canonical', DURA_URL))); ?>&chld=H|0" alt="<?php e($this->get('html.title', t(DURA_TITLE).' | '.t(DURA_SUBTITLE))) ?>"/>
					</a>
				</p>
			</div>

