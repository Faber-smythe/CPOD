$(document).ready(function($) {

/* general tools */

    var vh_in_pixel = document.documentElement.clientHeight ;
    var vw_in_pixel = document.documentElement.clientWidth ;

    var controller = new ScrollMagic.Controller();
/**
**  on .hover, picture behaviour (ONLY SMARTPHONE)
**/
    if (window.matchMedia("(min-width: 992px)").matches) {
        $('.frame').hover(
            function(){
                $(this).css('border-color', 'white')
                $(this).find('.picture_title').css('background-color', 'rgba(255, 255, 255, 0.9')
            },function(){
                $(this).css('border-color', 'rgb(200, 199, 198)')
                $(this).find('.picture_title').css('background-color', 'rgba(255, 255, 255, 0.7')
            }
        )
    }

/**
**  on .click, picture behaviour
**/

    var focusing = false;

    $('.frame').click(function(e){
        // open the focus
        if(focusing == false && !$(e.target).is($('i'))){
            focused_section = $(this).parent();
            focused_section.find('.frame').addClass('under_focus');
            focused_section.find('.frame img').addClass('under_focus');
            focused_section.find('.frame').children().addClass('under_focus');

            var focus_height = focused_section.height();
            var focus_width = vw_in_pixel*0.5 ;
            if (window.matchMedia("(max-width: 991px)").matches) {
                focus_width = vw_in_pixel*0.75 ;
                console.log('test');
            }

            var offset = focused_section.offset(); // Contains .top and .left
            offset.left -= 80;
            offset.top -= (vh_in_pixel/2)-(focus_height/2);

            $('html, body').animate({
                scrollTop: offset.top,
                scrollLeft: offset.left
            });
            focusing_timeline = new TimelineLite();
            //cancel title

            focusing_timeline.to(focused_section.find('.picture_title'), 0.1, {display:'none'}, 0);
            focusing_timeline.to(focused_section.find('.description'), 0.5, {display:'block'}, 0);
            focusing_timeline.to(focused_section.find('i'), 0.5, {display:'flex'}, 0);
            focusing_timeline.to(focused_section.find('.frame'), 0.1, {cursor:'auto'}, 0);
            //resize picture_container
            focusing_timeline.to(focused_section.find('.picture'), 0.5, {height:'15vw', width:'15vw', margin:'30px'}, 0);
            //and also resize picture itself
            if((focused_section.find('.picture img').height())>(focused_section.find('.picture img').width())){
                focusing_timeline.to(focused_section.find('.picture img'), 0.5, {height:'auto', width:'100%', position:'relative'}, 0);
                console.log('height bigger');
            }else{
                focusing_timeline.to(focused_section.find('.picture img'), 0.5, {height:'100%', width:'auto', position:'relative'}, 0);
                console.log('width bigger');
            }
            //alter frame
            focusing_timeline.to(focused_section.find('.frame'), 0.5, {border:'0px', height:'auto', width:focus_width, backgroundColor:'#f8f8f8'},0);
            //alter section
            focusing_timeline.to(focused_section, 0.5, {borderTop:'1px solid white', borderBottom:'1px solid white', backgroundColor:'rgba(255, 255, 255, 0.3)',justifyContent:'center'}, 0);
            //then, zoom with description fading in
            focusing_timeline.to(focused_section.find('.frame'), 0.5, {padding:'px', margin:'20px'},0);
            focusing_timeline.to(focused_section.find('.description'), 0.5, {opacity:1}, 0.6);
            focusing_timeline.to(focused_section.find('i'), 0.5, {opacity:1}, 0.6);
            focusing_timeline.pause();

            // initializing
            focusing_timeline.timeScale(1);
            focusing_timeline.play();
            //flip the boolean switch
            focusing = true;
            console.log('now '+ focusing);
        }
        else{
            // fold previous + unfold new one
            if(!($(e.target).is('.under_focus')) && !$(e.target).is($('i'))){
                /** fold previous one **/
                focusing_timeline.timeScale(5);
                focusing_timeline.reverse();
                focused_section.find('.frame').removeClass('under_focus');
                focused_section.find('.frame img').removeClass('under_focus');
                focused_section.find('.frame').children().removeClass('under_focus');
                //flip the boolean switch
                focusing = false;
                console.log('now '+ focusing);

                /** unfold new one **/
                focused_section = $(this).parent();
                focused_section.find('.frame').addClass('under_focus');
                focused_section.find('.frame img').addClass('under_focus');
                focused_section.find('.frame').children().addClass('under_focus');

                var focus_height = focused_section.height();
                var focus_width = vw_in_pixel*0.5 ;
                if (window.matchMedia("(max-width: 991px)").matches) {
                    focus_width = vw_in_pixel*0.7 ;
                    console.log('test');
                }

                var offset = focused_section.offset(); // Contains .top and .left
                offset.left -= 80;
                offset.top -= (vh_in_pixel/2)-(focus_height/2);

                $('html, body').animate({
                    scrollTop: offset.top,
                    scrollLeft: offset.left
                });
                focusing_timeline = new TimelineLite();
                //cancel title

                focusing_timeline.to(focused_section.find('.picture_title'), 0.1, {display:'none'}, 0);
                focusing_timeline.to(focused_section.find('.description'), 0.5, {display:'block'}, 0);
                focusing_timeline.to(focused_section.find('i'), 0.5, {display:'flex'}, 0);
                focusing_timeline.to(focused_section.find('.frame'), 0.1, {cursor:'auto'}, 0);
                //resize picture
                focusing_timeline.to(focused_section.find('.picture'), 0.5, {height:'15vw', width:'15vw', margin:'30px'}, 0);
                //and also resize picture itself
                if((focused_section.find('.picture img').height())>(focused_section.find('.picture img').width())){
                    focusing_timeline.to(focused_section.find('.picture img'), 0.5, {height:'auto', width:'100%', position:'relative'}, 0);
                    console.log('height bigger');
                }else{
                    focusing_timeline.to(focused_section.find('.picture img'), 0.5, {height:'100%', width:'auto', position:'relative'}, 0);
                    console.log('width bigger');
                }
                //alter frame
                focusing_timeline.to(focused_section.find('.frame'), 0.5, {border:'0px', height:'auto', width:focus_width, backgroundColor:'#f8f8f8'},0);
                //alter section
                focusing_timeline.to(focused_section, 0.5, {borderTop:'1px solid white', borderBottom:'1px solid white', backgroundColor:'rgba(255, 255, 255, 0.3)',justifyContent:'center'}, 0);
                //then, zoom with description fading in
                focusing_timeline.to(focused_section.find('.frame'), 0.5, {padding:'px', margin:'20px'},0);
                focusing_timeline.to(focused_section.find('.description'), 0.5, {opacity:1}, 0.6);
                focusing_timeline.to(focused_section.find('i'), 0.5, {opacity:1}, 0.6);
                focusing_timeline.pause();

                // initializing
                focusing_timeline.timeScale(1);
                focusing_timeline.play();
                //flip the boolean switch
                focusing = true;
                console.log('now '+ focusing);

            }
        }
    })

    // close focus
    $(document.body).click(function(e) {
        // Si ce n'est pas la section ouverte ni un de ses enfants
        if(focused_section){
            if( !$(e.target).is(focused_section) && !$.contains(focused_section[0],e.target) && focusing == true) {
                focusing_timeline.timeScale(5);
                focusing_timeline.reverse();
                focused_section.find('.frame').removeClass('under_focus');
                focused_section.find('.frame img').removeClass('under_focus');
                focused_section.find('.frame').children().removeClass('under_focus');
                //flip the boolean switch
                focusing = false;
                console.log('now '+ focusing);
            }
        }
    });
    $('.frame').find('i').click(function(){
        if(focusing == true){
            focusing_timeline.timeScale(5);
            focusing_timeline.reverse();
            focused_section.find('.frame').removeClass('under_focus');
            focused_section.find('.frame img').removeClass('under_focus');
            focused_section.find('.frame').children().removeClass('under_focus');
            //flip the boolean switch
            focusing = false
            console.log('now '+ focusing);
        }
    });

})
