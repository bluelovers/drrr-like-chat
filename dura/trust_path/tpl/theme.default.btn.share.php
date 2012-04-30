
	<div class="display_inline">

		<div class="g-plusone" data-size="small" data-href="<?php e(DURA_URL) ?>"></div>

		<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo DURA_URL ?>" data-text="<?php e(htmlspecialchars(t("I'm now chatting at room '{1}'!", $dura['room']['name']))) ?>" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

		<iframe src="http://www.facebook.com/plugins/like.php?app_id=154452591321345&amp;href=<?php echo rawurlencode(DURA_URL); ?>&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=trebuchet+ms&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe>

	</div>
