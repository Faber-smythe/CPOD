/* C'ESt PAR OU - SCRIPT */
$(document).ready(function($) {

    var vh_in_pixel = document.documentElement.clientHeight ;
    var vw_in_pixel = document.documentElement.clientWidth ;
    var controller = new ScrollMagic.Controller();

/**
** Background Behaviour
**/
    //resize the picture
    console.log($('#wallpaper_monks').css('width'));
    console.log($('#wallpaper_monks').css('height'));
//    $('#background').css('height', vh_in_pixel+'px');
    $('#background').css('height', (($('#wallpaper_monks').css('width'))*1.633));
    $('#wallpaper_monks').css('height', (($('#wallpaper_monks').css('width'))*1.633));
//    $('#wallpaper_monks').css('height', '800px');
    console.log($('#wallpaper_monks').css('width'));
    console.log($('#wallpaper_monks').css('height'));

    if(window.matchMedia("(min-width:768px)").matches){
        //positionning main section
        $('main').css('margin-top', (vh_in_pixel*0.9));
        //dealing with image positionning through devices
        var wallpaper_height = $('#wallpaper_monks').height();
        if(window.matchMedia("(max-width:1299px)").matches){
            var initial_margin = -(vw_in_pixel*0.4);
            console.log('small');
        }
        if(window.matchMedia("(min-width:1300px)").matches){
            var initial_margin = -(vw_in_pixel*0.45);
            console.log('big');
        }
        if(wallpaper_height+initial_margin < vh_in_pixel){
            initial_margin = 0;
        }
        var wallpaper_added_margin = (vh_in_pixel - wallpaper_height );
        if(wallpaper_added_margin < -(vh_in_pixel)*0.5){
            wallpaper_added_margin = -(vh_in_pixel)*0.5;
        }
        var wallpaper_final_margin = wallpaper_added_margin + initial_margin;
        if(wallpaper_height+wallpaper_final_margin < vh_in_pixel){
            wallpaper_final_margin = vh_in_pixel-wallpaper_height;
        }
        var motion_duration = $('body').height();
        $('#wallpaper_monks').css('margin-top', (initial_margin));
        var c_est_par_ou_scene = new ScrollMagic.Scene({
            triggerElement: 'body',
            triggerHook: 0,
            duration: motion_duration,
        })
        .setTween($('#wallpaper_monks'), 0.5, {marginTop:wallpaper_final_margin})
        .addTo(controller);
    }
    if(window.matchMedia("(max-width:767px)").matches){
        $('#wallpaper_monks').css('height', '100%').css('width', 'auto');
    }
})
