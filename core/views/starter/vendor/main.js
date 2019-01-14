$(document).ready(function($){

    var password = $('input[name=password]');
    var password_confirm = $('input[name=password_confirm]');
    var password_length = password.val().length;
    var password_confirm_length = password_confirm.val().length;



    $(".register-input").on('blur', function () {
        var element = $(this);
       if (checkForEmptyField()) {
            if (passwordCheck() && checkPasswords()) {
                $(".sendForm").removeAttr('disabled');
            } else {
                $(".sendForm").attr('disabled', 'true');
            }
        } else {
            $(".sendForm").attr('disabled', 'true');
        }
        if (element.val() !== "") {
            if (element.hasClass("input-ajax")) {
                checkDatabase(element);
            }
        }
    });
    function someFunction(data = null) {
        console.log(data);
    }
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
            },
            success: function (serverResult){
                var result = $.parseJSON(serverResult);
                var type = result.type;
                var answer = result.answer;
                var message = '';
                test = answer;
                element.next('.check-up').fadeOut();
                if (answer == 0) {
                    if (element.next().next('.ajax-result').hasClass('alert-warning')) {
                        element.next().next('.ajax-result').removeClass('alert-warning')
                    }
                    if (type == "email") {
                        message = "You can use this email";
                    }
                    else if (type == "login") {
                        message = "You can use this login";
                    }
                    element.next().next('.ajax-result').addClass('alert-success').text(message).fadeIn().delay(1000).fadeOut();
                }
                else if (answer == 1) {
                    if (element.next().next('.ajax-result').hasClass('alert-success')) {
                        element.next().next('.ajax-result').removeClass('alert-success')
                    }
                    if (type == "email") {
                        message = "This email is already exist.";
                    }
                    else if (type == "login") {
                        message = "This login is already exist.";
                    }
                    element.next().next('.ajax-result').addClass('alert-warning').text(message).fadeIn().delay(1000).fadeOut();
                    $(".sendForm").attr('disabled', true);
                }
                else {
                    if (element.next().next('.ajax-result').hasClass('alert-success')) {
                        element.next().next('.ajax-result').removeClass('alert-success')
                    }
                    element.next().next('.ajax-result').addClass('alert-warning').text(answer).fadeIn().delay(1000).fadeOut();
                    $(".sendForm").attr('disabled', true);
                }
            }
        });
    }

    function checkForEmptyField(){
        var input = $("#form-check").find('input');
        var freeInputCount = 0;
        $(input).each(function(a,b){
            if($(this).val() === ""){
                freeInputCount++;
            }
        });
        if (freeInputCount == 0 && checkPasswords()) return true;
        return false;
        
    }

    function checkPasswords(){
        if (password.val() !== password_confirm.val()) {
            password_confirm.next('.ajax-result').addClass('alert-danger').text('Passwords didnt match').fadeIn().delay(1000).fadeOut();
            return false;
        }
        return true;
    }

    function passwordRule(){
        var password_length = +password.val().length;
        if (password_length < 6){
            password.next('.ajax-result').addClass('alert-danger').text('Minimum 6 charachters').fadeIn();
        }
    }

    function passwordCheck(){
        var password_length = +password.val().length;
        if(password_length >= 6){
            // console.log('Im here 1');
            password.next('.ajax-result').fadeOut();
            return true;
        }
        else{
            // console.log('Im here 2');
            password.next('.ajax-result').fadeIn();
            return false;
        }
    }

    password.on('click focus', passwordRule);
    password.on('keyup', passwordCheck);
    password_confirm.on('click focus blur', checkPasswords);
});