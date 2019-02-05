$(document).ready(function($) {

    function insertAfter(newNode, referenceNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }

    function wrap(wrapper_tag, target, classname='') {
        el = document.createElement(wrapper_tag);
        if(classname.length!=0){
            el.classList.add(classname);
        }
        target.parentNode.insertBefore(el, target);
        el.appendChild(target);
    }


    var row_with_checkboxes = [];

    Array.from($('.form_row_container')).forEach(function(row){
        Array.from($("input[type='checkbox']")).forEach(function(checkbox){
            if(row.contains(checkbox)){
                if(!row_with_checkboxes.includes(row)){
                    row_with_checkboxes.push(row);
                }
            }
        })
    })

    row_with_checkboxes.forEach(function(row){
        Array.from($(row).find("input[type='checkbox']")).forEach(function(input){
            wrap('div', input, 'checkbox_wrapper');
            var new_checkbox = document.createElement("span");
            new_checkbox.classList.add("checkmark");
            insertAfter(new_checkbox, input);

        })
        Array.from($('.checkmark')).forEach(function(check){
            $(check).click(function(e){
                var box = $(this.parentNode).find("input[type='checkbox']");
                if(!(box.attr("checked")) || !(box.prop("checked"))){
                    box.attr("checked", true);
                    box.prop("checked", true);
                }else{
                    box.attr("checked", false);
                    box.prop("checked", false);
                }
            })
        });
    })


})
