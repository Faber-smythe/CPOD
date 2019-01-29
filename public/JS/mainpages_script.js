$(document).ready(function($) {

    var vh_in_pixel = document.documentElement.clientHeight ;
    var vw_in_pixel = document.documentElement.clientWidth ;

    if(!document.querySelector('#fix_header')){

        /**
        ** header behaviour
        **/
        var reached_first_title = false
        var controller = new ScrollMagic.Controller();
        var header_scene =  new ScrollMagic.Scene({
            triggerElement : 'main',
            triggerHook : 0.4,
        });
        header_scene.on('start', function(){
            if(reached_first_title == false){
                reached_first_title = true;
            }
            else{
                reached_first_title = false;
            }
        })
        header_scene.addTo(controller);

        var hidden_header = false;
        var hidden_title_margin = -($('header').find('h1').height() + parseInt($('header').find('h1').css('padding-top')) + parseInt($('header').find('h1').css('padding-bottom'))) ;
        var hidden_nav_margin =  -($('header').find('nav').height());
        var lastScrollTop = 0;
        var topscrolling = 0;
        var botscrolling = 0;
        /** short function adding for mobile_script.js **/
        function menufolding_onscroll_mobile(){
            $( "#main_menu" ).slideUp( "slow" );
            $('header').css('background', 'rgba(255, 255, 255, 0.7)');
            $('h1').css('color', '#010000');
            document.getElementById("burgercheck").checked = false;
        }
        function hide_header_on_botscrolling(){
            $('header').css('top', hidden_title_margin+hidden_nav_margin);
            hidden_header = true;
        }
        var land_mark_rotate = 90;
        var way = 'down';
        var first_scroll;
        function scroll_landmark_down(){
            if(!first_scroll){
                first_scroll = 'done';
            }
            $('#scroll_landmark')
                .css("transform", "rotateY(180deg) rotateZ(" + land_mark_rotate + "deg")
                .css('margin-left', '-8px')
                .css('margin-right', '0');
            land_mark_rotate += 180;

        }
        function scroll_landmark_up(){
            if(!first_scroll){
                land_mark_rotate += 180;
                first_scroll = 'done';
            }
            $('#scroll_landmark')
                .css("transform", "rotateY(180deg) rotateZ(" + land_mark_rotate + "deg")
                .css('margin-left', '8px')
                .css('margin-right', '0');
            land_mark_rotate += 180;
        }

        $(window).scroll(function(event){
            var st = $(this).scrollTop();
            if (st > lastScrollTop && reached_first_title == true){
                    botscrolling ++;

    //                console.log("scroll vers le bas /  botscrolling = " + botscrolling);

                if (hidden_header == false && botscrolling > 8){ //Hide header cause page goes down
                    hide_header_on_botscrolling();
                    if (window.matchMedia("(max-width: 767px)").matches) { //RESPONSIVE PART
                        menufolding_onscroll_mobile();
                    }
                }
                if($('#scroll_landmark') && botscrolling==8){ // LANDMARK rotation in "pays" page
                    scroll_landmark_down();
                }
                topscrolling = 0;
            } else{
                topscrolling ++;

    //               console.log("topscrolling = " + topscrolling);

                if(reached_first_title == true && topscrolling > 5){
                    $('header').css('top', hidden_title_margin);
                    if (window.matchMedia("(max-width: 767px)").matches) {
                        menufolding_onscroll_mobile(); //RESPONSIVE PART
                    }
                    hidden_header = false;
                }
                if(reached_first_title == false && topscrolling > 2){
                    $('header').css('top', '0px');
                    if (window.matchMedia("(max-width: 767px)").matches) {
                        menufolding_onscroll_mobile(); //RESPONSIVE PART
                    }
                    hidden_header = false;
                }
                if($('#scroll_landmark') && topscrolling==8){ // LANDMARK rotation in "pays" page
                    scroll_landmark_up();
                }
                botscrolling = 0;
            }
            lastScrollTop = st;
        });
    }

/**
** dropdown menu
**/
    var dropdown_timeline = new TimelineLite();

    dropdown_timeline.to($('#secondary_menu'), 0.5, {display:'flex'});

    if (window.matchMedia("(max-width: 991px)").matches) {
        dropdown_timeline.to($('#secondary_menu'), 0.5, {height:'170px'}, 0);
    }
    else{
        dropdown_timeline.to($('#secondary_menu'), 0.5, {height:'230px'}, 0);
    }
    dropdown_timeline.pause();

    $('#pays_tab').hover(
        function(){
            dropdown_timeline.timeScale(1);
            dropdown_timeline.play();
        },
        function(){
            dropdown_timeline.timeScale(2);
            dropdown_timeline.reverse();
        }
    )
    var pays_click = false
    $('#pays_tab').click(function(){
        if(pays_click == false){
            dropdown_timeline.timeScale(1);
            dropdown_timeline.play();
            pays_click = true;
        }
        else{
            dropdown_timeline.timeScale(2);
            dropdown_timeline.reverse();
            pays_click = false;
        }

    })
})
