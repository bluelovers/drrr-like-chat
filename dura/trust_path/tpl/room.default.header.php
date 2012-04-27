
	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/SoundManager2/script/soundmanager2-nodebug-jsmin.js"></script>
	<script type="text/javascript">

	(function($, soundManager, undefined){

		var messageSound;

		soundManager.url = '<?php e(DURA_URL) ?>/js/SoundManager2/swf/';
		soundManager.preferFlash = false;
		soundManager.useHTML5Audio = true;
		soundManager.debugMode = true;
		soundManager.useFlashBlock = true;
		soundManager.useConsole = true;
		soundManager.useHighPerformance = true;
		soundManager.useHTML5Audio = true;

		soundManager.defaultOptions.volume = 100;
		soundManager.defaultOptions.autoLoad = true;

		$.Dura = $.extend({}, $.Dura, {});
		$.Dura.sound = $.extend({}, $.Dura.sound, {});

		var sound =
		{
			data : {
				_sound: null,
				_class: soundManager,
			},

			log : function(data)
			{
				//$.extend(data, {}, { sound: $.Dura.sound });
				//$.log(data);

				return this;
			},

			create : function()
			{
				if (!$.Dura.sound.data.do_create)
				{
					$.Dura.sound.data.do_create = true;

					$.Dura.sound.log(['Dura.sound -> create']);

					$.Dura.sound.data._sound = soundManager.createSound({
						id: 'messageSound',
						url: '<?php e(DURA_URL) ?>/js/sound.mp3',
						volume: 100,
						autoLoad: true,

						onload: function(){
							$.Dura.sound._load();
						},
					});
				}

				return this;
			},

			onready : function(fn)
			{
				$.Dura.sound.log(['Dura.sound -> onready']);

				if (fn != undefined) $.Dura.sound.data.onready = fn;

				return this;
			},

			_ready : function()
			{
				if (!$.Dura.sound.data.do_ready)
				{
					$.Dura.sound.data.do_ready = true;

					$.Dura.sound.log(['Dura.sound -> _ready']);

					if ($.Dura.sound.data.onready)
					{
						$.Dura.sound.data.onready();
					}

					$.Dura.sound.create();
				}
			},

			_play : function()
			{
				try
				{
					//soundManager.getSoundById('messageSound').play();
					$.Dura.sound.data._sound.play();
					$.Dura.sound.log(['Dura.sound -> _play -> ok']);
				}
				catch(e)
				{
					$.Dura.sound.log(['Dura.sound -> _play -> error']);
				}
			},

			play : function()
			{
				$.Dura.sound.log(['Dura.sound -> play']);

				if (!$.Dura.sound.data.do_ready)
				{
					$.Dura.sound.log(['Dura.sound -> play -> not ready']);

					$.Dura.sound.data.play_on_load = true;

					$.Dura.sound._play();

					return;
				}

				if ($.Dura.sound.data.do_loaded || $.Dura.sound.data.is_loaded)
				{
					$.Dura.sound.log(['Dura.sound -> play -> play']);

					$.Dura.sound._play();
				}
				else
				{
					$.Dura.sound.log(['Dura.sound -> play -> load']);

					$.Dura.sound.data.play_on_load = true;

					$.Dura.sound
						.create()
						.load()
					;
				}

				return this;
			},

			onload : function(fn)
			{
				$.Dura.sound.log(['Dura.sound -> onload']);

				if (fn != undefined) $.Dura.sound.data.onload = fn;

				return this;
			},

			_load : function()
			{
				$.Dura.sound.log(['Dura.sound -> _load']);

				if (!$.Dura.sound.data.is_loaded) $.Dura.sound.data.is_loaded = $.Dura.sound.create().loaded;

				if ($.Dura.sound.data.onload)
				{
					$.Dura.sound.data.onload();
				}

				if ($.Dura.sound.data.play_on_load)
				{
					$.Dura.sound.log(['Dura.sound -> _load -> play_on_load']);

					$.Dura.sound._play();
				}
			},

			load : function()
			{

				if (!$.Dura.sound.data.do_ready)
				{
					$.Dura.sound.log(['Dura.sound -> load -> not ready']);

					return;
				}

				if (!$.Dura.sound.data.do_loaded)
				{
					$.Dura.sound.log(['Dura.sound -> load']);
					$.Dura.sound.data.do_loaded = true;

					if (!$.Dura.sound.data.is_loaded)
					{
						$.Dura.sound.create();
					}
				}

				return this;
			},
		};

		$.extend($.Dura.sound, {}, sound);

		soundManager.onready(function(){
			$.Dura.sound.log(['soundManager -> onready']);
			$.Dura.sound._ready();
		});

	})(jQuery, soundManager);

/*
var messageSound;

soundManager.url = '<?php e(DURA_URL) ?>/js/SoundManager2/swf/';

soundManager.preferFlash = false;
soundManager.useHTML5Audio = true;

soundManager.onload = function() {

	$.log(['soundManager', 'onload']);

	messageSound = soundManager.createSound({
		id: 'messageSound',
		url: '<?php e(DURA_URL) ?>/js/sound.mp3',
		volume: 100,
		autoLoad: true,
		onload: function() {
			$.log(['createSound', 'onload']);
		},
	});
};

soundManager.debugMode = true;
soundManager.useFlashBlock = true;
soundManager.useConsole = true;
soundManager.useHighPerformance = true;
soundManager.useHTML5Audio = true;

*/

/*
soundManager.audioFormats = {
	'mp3': {
		'type': ['audio/mpeg; codecs="mp3"', 'audio/mpeg', 'audio/mp3', 'audio/MPA', 'audio/mpa-robust'],
		'required': true //必须支持，false可不支持
	}
};
*/

/*
soundManager.onready(function() {
	$.log(['soundManager', 'onready']);
});
*/
</script>

<script type="text/javascript">
duraUrl = "<?php e(DURA_URL) ?>";
GlobalMessageMaxLength = <?php e(DURA_MESSAGE_MAX_LENGTH) ?>;
useComet = <?php e(DURA_USE_COMET) ?>;
</script>

	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.corner.js"></script>
	<!--script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.chat.js"></script-->

	<script type="text/javascript" src="<?php e(DURA_URL) ?>/js/jquery.easing.1.3.js"></script>

<script>

<?php e($this->slot('room.default.js.chat'));?>

</script>