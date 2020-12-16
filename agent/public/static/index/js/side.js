function siidyy() {
	
	var btn = $('.menu_btn');
	var sp = $('.sidy__panel');
	var md = $('#modify111');
	
	btn.css('cursor','pointer');

	$(document).on('click', function (e) {
		e.stopPropagation();
		
		if( btn.is(e.target)) {
		   $('.sidy').addClass('sidy--opened');
		}
		else if (!sp.is(e.target) && sp.has(e.target).length === 0 && !btn.is(e.target) && btn.has(e.target).length === 0 && !md.is(e.target) && md.has(e.target).length === 0 ) {
			$('.sidy').removeClass('sidy--opened');
		}
		
	});

} siidyy();


$("#confirmClose").on('click', function () {
    $("#Modal_coverchgload").css('display', 'none');
    $("#Modal_verificationCode").css('display', 'none');
});
