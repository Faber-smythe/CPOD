/* GALERY SCRIPT */
$(document).ready(function($) {

    var vh_in_pixel = document.documentElement.clientHeight ;
    var vw_in_pixel = document.documentElement.clientWidth ;
    var controller = new ScrollMagic.Controller();


console.log(vh_in_pixel);
    /**
     *
     * BACKGROUND FADING
     */

     var fading_scene = new ScrollMagic.Scene({
         triggerElement: 'body',
         triggerHook: 0,
         duration: (0.5*vh_in_pixel),
     });
     fading_scene.setTween($('#background'), 0.5, {opacity:'0.05'})
     .addTo(controller);


})
