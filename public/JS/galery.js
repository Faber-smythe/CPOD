/* GALERY SCRIPT */
$(document).ready(function($) {

    var vh_in_pixel = document.documentElement.clientHeight ;
    var vw_in_pixel = document.documentElement.clientWidth ;
    var controller = new ScrollMagic.Controller();

    /**
     *
     * SYLE FOR PAGINATION ARROWS
     */
    if(document.querySelector('.pagination .previous a')){
        document.querySelector('.pagination .previous a').innerHTML = "&#9666;";
        $('.pagination .previous a').attr('title', 'précédente') ;
        document.querySelector('.pagination .first a').innerHTML = "|&#9666;";
        $('.pagination .first a').attr('title', 'première') ;
    }
    if(document.querySelector('.pagination .next a')){
        document.querySelector('.pagination .next a').innerHTML = "&#9656;";
        $('.pagination .next a').attr('title', 'suivante') ;
        document.querySelector('.pagination .last a').innerHTML = "&#9656;|";
        $('.pagination .last a').attr('title', 'dernière') ;
    }
    $('.picture').height($('.picture').width());


    /**
     *
     * SYLE FOR PAGINATION ARROWS
     */






})
