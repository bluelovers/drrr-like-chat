
	<div class="language_switch" data-role="fieldcontain">

		<?php foreach (Dura_Model_Lang::getInstance()->getList()->toArray() as $langcode => $language): ?>

			<a href="?language=<?php e($langcode) ?>" data-ajax="false" title="<?php e($langcode) ?> <?php e(t($language)) ?>"><?php e(t($language)) ?></a>

		<?php endforeach ?>

	</div>