$(document).ready(function () {
    $('#login-container').click(function () {
        var hei = $('.login-form').height();
        $('.login-form').css({
            'opacity':0,
            'margin-top':-hei+"px"
        });
        setTimeout(function () {
            $('#login-container').css('display','none');
        },500);
    });
    $('.login-form').click(function (event) {
        event.stopPropagation();
    });
    
    
    $('.login').click(function () {
        $('#login-container').css('display','block');
        setTimeout(function () {
            $('.login-form').css({
                'opacity':1,
                'margin-top':'100px'
            });
        },100);
    });

    $('#sign-container').click(function () {
        var hei = $('.sign-form').height();
        $('.sign-form').css({
            'opacity':0,
            'margin-top':-hei+"px"
        });
        setTimeout(function () {
            $('#sign-container').css('display','none');
        },500);
    });
    $('.sign-form').click(function (event) {
        event.stopPropagation();
    });
    $('.sign').click(function () {
        $('#sign-container').css('display','block');
        setTimeout(function () {
            $('.sign-form').css({
                'opacity':1,
                'margin-top':'100px'
            });
        },100);
    });


});