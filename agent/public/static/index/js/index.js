function toptrad () {

	var tradOne = Math.ceil(tradingVolume[0] / 1000);
	var tradTwo = Math.ceil(tradingVolume[1] / 1000);
	var tradThree = Math.ceil(tradingVolume[2] / 1000);
	var tradFour = Math.ceil(tradingVolume[3] / 1000);

	setTimeout (function () {
		$('#topOneScore').each(function () {
			$(this).prop('Counter', 0).animate({
				Counter: tradOne
			}, {
				duration: 1000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		});
		$('#topTwoScore').each(function () {
			$(this).prop('Counter', 0).animate({
				Counter: tradTwo
			}, {
				duration: 1000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		});
		$('#topThreeScore').each(function () {
			$(this).prop('Counter', 0).animate({
				Counter: tradThree
			}, {
				duration: 1000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		});
		$('#topFourScore').each(function () {
			$(this).prop('Counter', 0).animate({
				Counter: tradFour
			}, {
				duration: 1000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		});

		var oneNum = tradingVolume[0] / (tradingVolume[0] + surplusVolume[0]) * 396;
		var twoNum = tradingVolume[1] / (tradingVolume[1] + surplusVolume[1]) * 396;
		var threeNum = tradingVolume[2] / (tradingVolume[2] + surplusVolume[2]) * 396;
		var fourNum = tradingVolume[3] / (tradingVolume[3] + surplusVolume[3]) * 396;

		$('#one_value').attr('stroke-dashoffset', oneNum + 396);
		$('#two_value').attr('stroke-dashoffset', twoNum + 396);
		$('#three_value').attr('stroke-dashoffset', threeNum + 396);
		$('#four_value').attr('stroke-dashoffset', fourNum + 396);

		$('#oneEnd').attr('stroke-dashoffset', oneNum + 396);
		$('#twoEnd').attr('stroke-dashoffset', twoNum + 396);
		$('#threeEnd').attr('stroke-dashoffset', threeNum + 396);
		$('#fourEnd').attr('stroke-dashoffset', fourNum + 396);

	}, 10);

}
toptrad();

	var topItemTime = new Object;
	var runTimeId;
	function runTimeFunc(){
		upTopItemTime();
		console.log( 'upTimeNum:'+upTimeNum );
		clearTimeout( runTimeId );
		runTimeId = setTimeout( runTimeFunc, 1000);
	}
	function upTopItemTime()
	{
		var now = new Date().getTime();
		var test = new Date( countDownStartTime[1] ).getTime();
		for( i = 0 ; i < countDownStartTime.length ; i++ )
		{
			var countDownDate = new Date( countDownStartTime[i] ).getTime();
			var distance = countDownDate - now;
			//JS計算出來比之前多了八小時180922/上午顥示正常-0
			var hours = ('0' + ( Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)) - 0 ) ).slice(-2);
			var minutes = ('0' + Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).slice(-2);
			var seconds = ('0' + Math.floor((distance % (1000 * 60)) / 1000)).slice(-2);
			if( seconds < 0 )
			{
				window.location.reload();
				return false;
			}
			$( "#cdTime"+i ).html( hours+':'+minutes+':'+seconds );
		}
	}
runTimeFunc();
