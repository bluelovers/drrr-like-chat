<script>

(function($){

	$(document)
		.bind("ready, pageinit, pageshow", function(){

			$('#page_default #icons .ui-btn .icon')
				.hover(function(){
					var _this = $(this);

					_this
						.animate({
							opacity : 1
						})
					;

				}, function(){
					var _this = $(this);

					_this
						.animate({
							opacity : 0.25
						})
					;
				})
				.css({
					opacity : 0.25
				})
			;

		})
	;


})(jQuery);

</script>