/* PAGINATION STYLING SCRIPT */
$(document).ready(function($) {

    /**
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





})
