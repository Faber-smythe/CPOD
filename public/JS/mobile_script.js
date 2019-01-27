$(document).ready(function($) {

    /**
    ** RESPONSIVE SCRIPT
    **/

    /** ACTUALISATION de la page lors du changement d'ORIENTAION sur MOBILE (pour mettre à  jour les positions des images, et les media query basée sur la VW) **/
    window.addEventListener("orientationchange", function(){
        if (window.orientation == 0){  //passe en portrait
            window.location.reload()
        }
        else{ //passe en paysage
            window.location.reload()
        }
    }, false);

    /* BURGER MENU TOGGLING */

    if (window.matchMedia("(max-width: 767px)").matches) {
        $( "#main_menu" ).css( "display", "none" );
        $('#burgercheck').click(function(){
            if (document.getElementById("burgercheck").checked == true){
                $('#burgercheck').checked = false;
                console.log('check');
                $( "#main_menu" ).slideDown( "slow" );
                $('header').css('background', 'rgba(25, 25, 25, 0.9)');
                $('h1').css('color', 'white');
            } else {
                $('#burgercheck').checked = true;
                console.log('uncheck');
                $( "#main_menu" ).slideUp( "slow" );
                $('header').css('background', 'rgba(255, 255, 255, 0.7)');
                $('h1').css('color', '#010000');
            }
        })
    }

})
