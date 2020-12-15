$(function () {
    var fadeConfig = {
        stayTime: 2000,
        actionTime: 1000,
        wrap: $('#rotateFade .rotate-wape'),
        nvs: $('#rotateFade .rotate-nav a'),
        items: $('#rotateFade .rotate-item'),
        width: 1700,
        effect: 'fade'
    };
    var fadeRotate = new Rotate(fadeConfig);
    $('#rotateFade .rotate-nav a').click(function () {
        if (!$(this).is('.active')) {
            var index = $('#rotateFade .rotate-nav a').index($(this));
            fadeRotate.custom(index);
        }
    });
    
    var moveConfig = {
        stayTime: 2000,
        actionTime: 1000,
        wrap: $('#rotateMove .rotate-wape'),
        nvs: $('#rotateMove .rotate-nav a'),
        items: $('#rotateMove .rotate-item'),
        width: 1700
    };
    var moveRotate = new Rotate(moveConfig);
    $('#rotateMove .rotate-nav a').click(function () {
        if (!$(this).is('.active')) {
            var index = $('#rotateMove .rotate-nav a').index($(this));
            moveRotate.custom(index);
        }
    });
});