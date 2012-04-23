
	<?php if (!$_SERVER['HTTP_X_REQUESTED_WITH']) $this->extend('theme'); ?>

	<div data-role="page" id="page_about" data-theme="c">
		<?php e($this->slot('theme.page.header'));?>
		<div data-role="content">

			<?php e($this->slot('page.about.header')) ?>

			<div class="top">
				<div class="topContent">
					<h1>デュラララ!!チャットとは？<span class="subtitle">| みんなが楽しめるチャット</span></h1>
				</div>
			</div>
			<div class="clear">
			</div>
			<div class="header">
				<div class="content">
					<h2 class="tanaka"><img src="<?php echo DURA_URL;?>/css/icon/tanaka.png" />アニメ『デュラララ!!』に登場するチャットを再現！</h2>
					<p>デュラララ!!チャット、通称デュラちゃは、アニメ『デュラララ！！』の作中に出てくるチャットを再現したサイトです。チャットを発表した当初から大きな反響があり、今でも多くの方が遊びに来ています。このチャット制作段階の動画はニコニコ動画からご覧になれます^^</p>
					<div style="text-align:center; margin: 20px 0;">
						<p><strong>デュラララ！に登場するチャットを再現してみた</strong></p>
						<script type="text/javascript" src="http://ext.nicovideo.jp/thumb_watch/sm10152002"></script>
						<noscript>
						<a href="http://www.nicovideo.jp/watch/sm10152002">【ニコニコ動画】デュラララ！に登場するチャットを再現してみた</a>
						</noscript>
					</div>
					<h2 class="kanra"><img src="<?php echo DURA_URL;?>/css/icon/kanra.png" />誰でも参加することができます！</h2>
					<p>このチャットは、デュラララ！！が好きな人、デュラララ！！の世界観を楽しみたい人はもちろん、作品自体は見たいことがないんだけど、面白そうだから！と興味をもってくれた人、みんながチャットに加わることができます。もちろん、<strong>無料</strong>で楽しむことができます！</p>
					<h2 class="zawa"><img src="<?php echo DURA_URL;?>/css/icon/zawa.png" />参加は名前を決めてログインするだけ！</h2>
					<p>デュラララ！！チャットでは、アカウント登録の必要はありません！チャットに参加するには、自分のハンドルネームを入力してログインするだけです。ログインするとチャットルーム一覧が現れます。そこから自分が、参加したいなぁと思う部屋を選んで入室してみてください^-^)b</p>
					<p style="text-align:center; margin: 20px 0;"><img src="http://lh5.googleusercontent.com/-WE7pIbnMzqo/TlT8I9O5m5I/AAAAAAAABho/HGhMg2f-6jY/s640/Colors.jpg" /></p>
					<h2 class="gg"><img src="<?php echo DURA_URL;?>/css/icon/gg.png" />ゆっくり楽しんでいってね</h2>
					<p>それでは、デュラララ！！チャットの世界をゆっくり楽しんで行ってください〜！</p>
					<p style="text-align:center; margin: 30px 0;"><a href="<?php echo DURA_URL;?>" class="super button pink">参加はこちらから</a></p>
				</div>
			</div>
		</div>
		<?php e($this->slot('theme.footer'));?>
	</div>

