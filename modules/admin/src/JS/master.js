/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var idleState = false;
    var idleTimer = null;
    $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
        clearTimeout(idleTimer);
        if (idleState == true) {
            $("body").css('background-color', '#fff');
        }
        idleState = false;
        idleTimer = setTimeout(function () {
            $("body").css('background-color', '#000');
            idleState = true;
        }, 2000);
    });
    $("body").trigger("mousemove");
});

