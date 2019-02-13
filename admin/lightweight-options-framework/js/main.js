(function( $ ) {
	var main = function() {
		$('.status-box').keyup(function() {
			$(this).css('height','auto');
			$(this).height(this.scrollHeight);
		});
		
		$('.status-box').keypress(function() {
			var postlength = $(this).val().length;
			var charactersleft = (280 - postlength);
			if( charactersleft < 0 ) {
				$('.status-box').val($('.status-box').val().slice(0, charactersleft));
			}
			postlength = $(this).val().length;
			charactersleft = (280 - postlength);
			$(this).parent().children(".counter").text(charactersleft);
			//$('.counter').text(charactersleft);
			$(this).css('height','auto');
			$(this).height(this.scrollHeight);
		});
		
		$.each($(".status-box"), function() {
			var postlength = $(this).val().length;
			var charactersleft = (280 - postlength);
			$(this).parent().children(".counter").text(charactersleft);
			$(this).css('height','auto');
			$(this).height(this.scrollHeight);
		});

	};
	
	$(document).ready(main);
})( jQuery );