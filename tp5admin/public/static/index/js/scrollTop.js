$(function () {
	$(".sidy__content").scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#return-to-top').fadeIn();
		} else {
			$('#return-to-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	$('#return-to-top').click(function () {
		$('.sidy__content').animate({
			scrollTop: 0
		}, 1000);
		return false;
	});
});
