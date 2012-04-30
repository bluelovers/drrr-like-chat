		<div data-role="footer" data-position="fixed" data-theme="a">


			<div data-role="controlgroup" data-type="horizontal" class="ui-btn" >

				<a href="#" data-icon="arrow-u"  data-iconpos="notext" data-direction="reverse" id="scrolltop" data-role="button"> Top </a>

				<?php e($this->get('tpl.page.footer.btn.left')); ?>

			</div>

			<?php e($this->get('tpl.page.footer.btn.center')); ?>

			<?php e($this->slot('theme.default.btn.share')); ?>

			<!-- 將此顯示呼叫 (render call) 放在適當位置 -->
			<script type="text/javascript">gapi.plusone.go();</script>

			<div data-role="controlgroup" data-type="horizontal" class="ui-btn-right" >

				<?php e($this->get('tpl.page.footer.btn.right')); ?>

			</div>

		</div>