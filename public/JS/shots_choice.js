
$(document).ready(function($) {

    Array.from($('.stage_container')).forEach(function(stage_container){
        $(stage_container).height($(stage_container).width()+'px');
    })

})
