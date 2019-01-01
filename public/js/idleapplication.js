$base_url = $('#base_url').attr('content');
idleTimer = null;
idleState = false;
idleWait = 15000;
$screenlockstatus = $('#screenlockstatus').attr('content');
if ($screenlockstatus) {
    $('#screenunlock').modal('show');
}
(function ($) {
    $(document).ready(function () {
        $('*').bind('mousemove keydown scroll', function () {
            clearTimeout(idleTimer);
            if (idleState === true) {
//                $("#msg").append("<p>Welcome Back.</p>");
            }
            idleState = false;
            idleTimer = setTimeout(function () {
                if ($screenlockstatus !== '1') {
                    lockscreen();
                }
                // Idle Event
//                $("#msg").append("<p>You've been idle for " + idleWait / 1000 + " seconds.</p>");
                idleState = true;
            }, idleWait);
        });
        $("body").trigger("mousemove");
    });
})(jQuery)
function lockscreen() {
    $.ajax({
        url: $base_url + "/login/lock",
        type: "GET",
        success: function (data) {
            window.location.reload();
        }
    });
}
$form = $("form[name = 'screenlock']");
$($form).validate({
    rules: {
        password: "required",
    },
    messages: {
        password: "Please enter Password",
    },
    submitHandler: function (form) {
        $.ajax({
            url: $base_url + "/login/unlock",
            type: "POST",
            data: $form.serialize(),
            success: function (data) {
                if (data === 'true') {
                    window.location.reload();
                } else {
                    $('#screenlockmessage').html('Invalid Password').addClass('text-danger').fadeIn(400).fadeOut(1000);
                }
            }
        });
    }
});