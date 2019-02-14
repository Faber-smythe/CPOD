/* GALERY SCRIPT */
$(document).ready(function($) {

    var vh_in_pixel = document.documentElement.clientHeight ;
    var vw_in_pixel = document.documentElement.clientWidth ;
    var controller = new ScrollMagic.Controller();


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



    /**
     * IMAGE SIZE IN PICTURE_CONTENT FOR PORTRAIT/LANDSCAPE
     */
     Array.from($('.picture_container img')).forEach(function(elem){
         var image = $(elem);
         if(image.height() < image.width()){
             image.css('height', '100%');
             image.css('width', 'auto');
         }
     });


     var zooming = false; //is a picture currently zoomed ?
    /**
     * PICTURE BEHAVIOUR
     */
     function dezoom(picture_to_dezoom){
             var picture_to_dezoom = $('.col-12');
             picture_to_dezoom.removeClass('col-12').removeClass('md-col-12').removeClass('mb-col-12');
             picture_to_dezoom.find('.picture').css('height', picture_to_dezoom.next().find('.picture').width() + 'px');
             picture_to_dezoom.find('.dezoom').css('display', 'none');

             picture_to_dezoom.find('.picture_content').css('justify-content', 'space-around').css('align-items', 'center');
             picture_to_dezoom.find('.picture_content>h3, .picture_content>.picture_detail, .picture_content>.info_date').css('opacity', '0').css('width', 'auto').css('background', 'none');
             picture_to_dezoom.find('.toggle_info').css('display', 'none');
             $(picture_to_dezoom).find('.picture_content>h3, .picture_content>.picture_detail, .picture_content>.info_date, .picture_content>.toggle_info').css('left', 'auto').css('margin-left', '0px');

             $(picture_to_dezoom).find('h3, .info_date, .picture_detail').css('transform', 'rotateY(0deg)');

             if(picture_to_dezoom.find('img').height()<picture_to_dezoom.find('img').width()){
                 // for landscape image
                 picture_to_dezoom.find('img').css('height','100%');
                 picture_to_dezoom.find('img').css('width','auto');
             }else{
                 // for portrait image
                 picture_to_dezoom.find('img').css('height','auto');
                 picture_to_dezoom.find('img').css('width','100%');
             }
     }
     function dezoom_portrait(picture_to_dezoom){
             var picture_to_dezoom = $('.col-12');
             picture_to_dezoom.removeClass('col-12').removeClass('md-col-12').removeClass('mb-col-12');
             picture_to_dezoom.find('.picture').css('height', picture_to_dezoom.next().find('.picture').width() + 'px');
             picture_to_dezoom.find('.dezoom').css('display', 'none');

             picture_to_dezoom.find('.picture_content').css('justify-content', 'space-around').css('align-items', 'center');
             picture_to_dezoom.find('.picture_content>h3, .picture_content>.picture_detail, .picture_content>.info_date').css('opacity', '0').css('width', 'auto').css('background', 'none');
             picture_to_dezoom.find('.toggle_info').css('display', 'none');
             $(picture_to_dezoom).find('.picture_content>h3, .picture_content>.picture_detail, .picture_content>.info_date, .picture_content>.toggle_info').css('left', 'auto').css('margin-left', '0px');

             $(picture_to_dezoom).find('h3, .info_date, .picture_detail').css('transform', 'rotateY(0deg)');

             if(picture_to_dezoom.find('img').height()<picture_to_dezoom.find('img').width()){
                 // for landscape image
                 picture_to_dezoom.find('img').css('height','100%');
                 picture_to_dezoom.find('img').css('width','auto');
             }else{
                 // for portrait image
                 picture_to_dezoom.find('img').css('height','auto');
                 picture_to_dezoom.find('img').css('width','100%');
             }
     }
     Array.from($('.picture_container')).forEach(function(picture_container){
         //CLOSE CURRENT PICTURE
         $('.dezoom').click(function(e){
             if($(e.target).parent().parent().parent().hasClass('col-12')){

                 if(vh_in_pixel>vw_in_pixel){
                     dezoom_portrait($(e.target).parent().parent().parent());
                 }else{
                     dezoom($(e.target).parent().parent().parent());
                 }

                 $('body').css('background', 'rgb(40, 43, 47)');
                 $('#background').css('display', 'flex');

                 zooming = false;
             }
         })
         $(picture_container).click(function(e){
             if(!($(this).hasClass('col-12')) && !($(e.target).hasClass('dezoom'))){
                 //auto-dezoom last zoomed picture
                 if(document.querySelector('.col-12')){

                     if(vh_in_pixel>vw_in_pixel){
                         dezoom_portrait($('.col-12'));
                     }else{
                         dezoom($('.col-12'));
                     }
                 }

                 /*
                 * Zoom on clicked picture
                 */
                 var info_background = "linear-gradient(to right, rgba(25, 25, 25, 0.5), rgba(25, 25, 25, 0.5), rgba(25, 25, 25, 0.5), rgba(25, 25, 25, 0.5), transparent)";

                 $(this).addClass('col-12').addClass('md-col-12').addClass('mb-col-12');

                 if(vh_in_pixel>vw_in_pixel){
                     /* portrait screen */
                         $(this).find('img').css('height','auto');
                         $(this).find('img').css('width','auto').css('max-width', '95vw');
                         $(this).find('.picture').css('height', $(this).find('img').height()+'px');
                    
                     $(this).find('.picture_content>h3, .picture_content>.picture_detail, .picture_content>.info_date').css('opacity', '1').css('width', '50vw').css('background', info_background);
                 }else{
                     /* landscape screen */
                     $(this).find('img').css('height','100%');
                     $(this).find('img').css('width','auto');
                     $(this).find('.picture').css('height', 0.9*vh_in_pixel+'px');
                     $(this).find('.picture_content>h3, .picture_content>.picture_detail, .picture_content>.info_date').css('opacity', '1').css('width', '25vw').css('background', info_background);
                 }


                 $(this).find('.dezoom').css('display', 'flex');
                 $(this).find('.picture_content').css('justify-content', 'flex-end').css('align-items', 'flex-start');
                 $(this).find('.toggle_info').css('display', 'flex');
                 $(this).find('h3, .info_date, .picture_detail').css('transform', 'rotateY(0deg)');
                 $(this).find('.info_date').css('margin-left', '25px');


                 if(!zooming){
                     $('body').css('background', 'rgb(25, 25, 25)');
                     $('#background').css('display', 'none');
                     zooming = true;
                 }
                 var target = this;
                 var offset = (vh_in_pixel/2) - (parseInt($(target).height())/2);

                 setTimeout(function(){
                     $([document.documentElement, document.body]).animate({
                         scrollTop: ($(target).offset().top) - offset
                     }, 300, 'easeInOutCirc', function(){});

                     $(target).find('.mask').css('opacity', '0');
                     if(target.querySelector('img') && vh_in_pixel<vw_in_pixel){

                         $(target).find('.picture_content>h3, .picture_content>.picture_detail, .picture_content>.info_date, .picture_content>.toggle_info').css('left',  (target.querySelector('img').offsetLeft) + 'px');

                     }
                 }, 310);

             }
         })
     })

     /**
      * HOVER ONLY OVER NON ZOOMED PICTURE
      */
     var hover_duration = 300; // (in ms)
     Array.from($('.picture_container')).forEach(function(picture_container){
         $(picture_container).hover(function(){
             if( !($(this).hasClass('col-12')) ){

                 $(this).find('.mask').stop().animate({
                     opacity: 0.5
                 }, hover_duration/2);
                 $(this).find('h3').stop().animate({
                     opacity: 1
                 }, hover_duration);
                 $(this).find('.info_date').stop().animate({
                     opacity: 1
                 }, hover_duration);


             }
         }, function(){
             if( !($(this).hasClass('col-12')) ){
                 $(this).find('.mask').stop().animate({
                     opacity: 0
                 }, hover_duration/2);
                 $(this).find('h3').stop().animate({
                     opacity: 0
                 }, hover_duration);
                 $(this).find('.info_date').stop().animate({
                     opacity: 0
                 }, hover_duration);
             }
         })
     });

     /**
      * TOGGLE INFOS
      */
     Array.from($('.toggle_info')).forEach(function(toggle){

         var toggled = true;
         $(toggle).click(function(){
             if(toggled){
                 $(this).parent().find('h3, .info_date, .picture_detail').css('transform', 'rotateY(90deg)');
                 toggled = false;
             }else{
                 $(this).parent().find('h3, .info_date, .picture_detail').css('transform', 'rotateY(0deg)');
                 toggled = true;
             }
             console.log(toggled);
         })
     })

})
