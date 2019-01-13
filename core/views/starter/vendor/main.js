$(document).ready(function($){
    $(".register-input").on('blur', function () {
        var element = $(this);
        if (element.val() !== "") {
            if (element.hasClass("input-ajax")) {
                checkDatabase(element);
            } else {
                console.log('no');
            }
        }
    });

    function checkDatabase(element) {
        var name = element.attr('name');
        var value = element.val();
        $.ajax({
            method: "POST",
            url: "http://hwf/register",
            data: {
                name: name,
                value: value
            },
            beforeSend: function (xhr) {
               element.next('.check-up').fadeIn();
            }
        })
        .done(function (msg) {
            element.next('.check-up').fadeOut();
            console.log(msg);
        });
    }
});