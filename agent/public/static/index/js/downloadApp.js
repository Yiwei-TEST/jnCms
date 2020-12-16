//$(function(){
//	$("#adApp").on('click', function() {
//		$(".sidy").removeClass('sidy--opened');
//		$('.downloadApp').show();
//		$('#andriod').show();
//	});
//	
////	$('#forAndriod').on('click', function(){
////		$('#andriod').show();
////	})
////	$('#forIos').on('click', function(){
////		$('#ios').show();
////	})
//	$('.app_close').on('click', function(){
//		$('.step_two').hide();
//		$('.downloadApp').hide();
//	})
//});


$(function () {

	var adApp = $("#adApp"),
		forAndriod = $('#forAndriod'),
		forIos = $('#forIos');
		adApp.on('click', function (e) {
			e.stopPropagation();
			$(".sidy").removeClass('sidy--opened');
			$('.downloadApp').show();
			$('.step_one').show();
		});
	$('.downloadApp').on('click', function (e) {
		if (forAndriod.is(e.target)) {
			e.stopPropagation();
			$('.step_one').hide();
			$('#andriod').show();
		} else if (forIos.is(e.target)) {
			e.stopPropagation();
			$('.step_one').hide();
			$('#ios').show();
		} else if ($('.step_two').is(e.target)) {
			e.stopPropagation();
			$('.app_close').on('click', function () {
				$('.step_two').hide();
				$('.downloadApp').hide();
			})
		} else {
			e.stopPropagation();
			$('.step_two').hide();
			$('.downloadApp').hide();
		}
	});
	$('#androidlink , #ioslink').on('click', function (e) {
		e.stopPropagation();
		$('.downloadApp').hide();
	})


	var service_24hr = $('#service_24hr'),
		services = $('#services'),
		service_close = $('#service_close');

	service_24hr.on('click', function (e) {
		e.stopPropagation();
		services.show(100);
	})
	service_close.on('click', function (e) {
		e.stopPropagation();
		services.hide(100);
	})

});
