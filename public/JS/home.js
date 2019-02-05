/* HOME SCRIPT */
$(document).ready(function($) {

    var vh_in_pixel = document.documentElement.clientHeight ;
    var vw_in_pixel = document.documentElement.clientWidth ;
    var controller = new ScrollMagic.Controller();

/**
** Parallaxe Behaviour
**/
    //positionning main section
    $('main').css('margin-top', (vh_in_pixel*0.9));

    var parallaxe_initial_margin = ($('#parallaxe').height())/17;
    $('#parallaxe').css('margin-top', parallaxe_initial_margin);
    var parallaxe_final_margin = -($('#parallaxe').height())/6;
    var parallaxe_duration = $('body').height();
    var thai_parallaxe_scene = new ScrollMagic.Scene({
        triggerElement: 'body',
        triggerHook: 0,
        duration: parallaxe_duration,
    });
    thai_parallaxe_scene.setTween($('#parallaxe'), 0.5, {marginTop:parallaxe_final_margin});
    thai_parallaxe_scene.addTo(controller);
    var thai_wallpaper_scene = new ScrollMagic.Scene({
        triggerElement: 'body',
        triggerHook: 0,
        duration: parallaxe_duration,
    })

})
