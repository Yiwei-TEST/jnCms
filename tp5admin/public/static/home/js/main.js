

// var docEl = document.documentElement,
//     resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
//     recalc = function () {
//         var clientWidth = docEl.clientWidth;
//         if (!clientWidth) return;
//         docEl.style.fontSize = 32 * (clientWidth / 750) + 'px';
//     };
// window.addEventListener(resizeEvt, recalc, false);
// document.addEventListener('DOMContentLoaded', recalc, false);

//--------- initRem -----------------



$(function () {
    var width = $(window).width();
    var height = $(window).height();
    if(width<350||height<350){
        $('html').css('font-size',12+'px')
    }
    else if(width<380||height<380){
        $('html').css('font-size',14+'px')
    }
    else if(width<415||height<415){
        $('html').css('font-size',16+'px')
    }
})

//开启动图
var openGif =function () {
    $('.left-gif').css('display','inline-block');
    $('.left-png').css('display','none')
};
//关闭动图
var closeGif =function () {
    $('.left-gif').css('display','none')
    $('.left-png').css('display','inline-block')
};

