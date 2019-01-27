/* JOURNAL SCRIPT */
$(document).ready(function($) {

/* general tools */

    var vh_in_pixel = document.documentElement.clientHeight ;
    var vw_in_pixel = document.documentElement.clientWidth ;
    var controller = new ScrollMagic.Controller();

/**
**  Section tabs egalisation (height)
**/
    if($('#tab_developpement').height()>$('#tab_voyage').height()){
        var tab_minimum_height = $('#tab_developpement').height();
    }
    if($('#tab_voyage').height()>$('#tab_developpement').height()){
        var tab_minimum_height = $('#tab_voyage').height();
    }

    $('.sections_tab').css('height', tab_minimum_height);

/**
** Section switch behaviour
**/

    // initialisation
    var tab_dev = $('#tab_developpement');
    var tab_voyage = $('#tab_voyage');
    var section_dev = $('#developpement');
    var section_voyage = $('#voyage');
    tab_voyage.css('font-size', '2.3em').css('opacity','1');
    tab_dev.css('font-size', '2em').css('opacity','0.8');
    section_voyage.css('height', 'auto');
    //setting the timeline
    var to_development_timeline = new TimelineLite();
    to_development_timeline.to(tab_dev, 0.4, {fontSize:'2.3em', opacity:'1', borderBottom:'1px solid #fff', borderLeft:'1px solid #010000', borderTop:'1px solid #010000'});
    to_development_timeline.to(tab_voyage, 0.4, {fontSize:'1.8em', opacity:'0.8', borderBottom:'1px solid #010000', borderRight:'1px solid #fff', borderTop:'1px solid #fff'}, 0);
    to_development_timeline.to(section_dev, 0.4, {opacity:'1', width: '100%', height:'auto'}, 0);
    to_development_timeline.to(section_voyage, 0.4, {opacity:'0', width:'0', height:'0'},0);
    to_development_timeline.pause();

    // go to "developpement"
    tab_dev.click(function(){
        to_development_timeline.play();
    })
    // go to "voyage"
    tab_voyage.click(function(){
        to_development_timeline.reverse();
    })


})
