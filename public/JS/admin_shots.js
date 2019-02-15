
$(document).ready(function($) {


    var stored_height = $('#country_links').height();
    $('#country_links').height("0px");
    $('#country_links').css('opacity', 1);

    $('#countries_drop').hover(function(){
        $(this).find('#country_links').animate({
            height: stored_height + 'px',
        }, 150);
    }, function(){
        console.log('out');
        $(this).find('#country_links').animate({
            height: '0px',
        }, 150);
    })


})
