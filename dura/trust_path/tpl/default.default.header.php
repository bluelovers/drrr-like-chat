<script>

(function($){

	$(document)
		.bind("ready, pageinit, pageshow", function(){

			$('#page_default #icons .ui-btn')
				.live('click', function(){
					var _this = $(this);


					_this
						.parents('#icons')
							.find('.ui-btn-active .icon')
								.dequeue()
								.animate({
									opacity : 1
								})
							.end()
							.find(':not(.ui-btn-active) .icon')
								.animate({
									opacity : 0.25
								})
					;
				})
				.find('.icon')
					.hover(function(){
						var _this = $(this);

						_this
							.animate({
								opacity : 1
							})
						;

					}, function(){
						var _this = $(this);

						if (_this.parents('.ui-btn-active').size())
						{
							_this
								.animate({
									opacity : 1
								})
							;
						}
						else
						{
							_this
								.animate({
									opacity : 0.25
								})
							;
						}
					})
					.css({
						opacity : 0.25
					})
				.end()
				.css({
					opacity : 0.8
				})
				.parent()
					.find(':radio')
						.hide()
			;

		})
	;


})(jQuery);

</script>