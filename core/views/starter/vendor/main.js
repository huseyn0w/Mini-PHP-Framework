$(document).ready(function($){


    var password = $('input[name=password]');
    var password_confirm = $('input[name=password_confirm]');
    if(password.length > 0 && password_confirm.length > 0){
         var password_length = password.val().length;
         var password_confirm_length = password_confirm.val().length;

         password.on('click focus', passwordRule);
         password.on('keyup', passwordCheck);
         password_confirm.on('click focus blur', checkPasswords);
    }

    
   

    $("#CheckAll").on('click', function(){
        if($(".taskCheckbox").attr('checked')){
            $(".taskCheckbox").removeAttr('checked');
            $(".ordering2").hide();
        }
        else{
            $(".ordering2").css('display', 'flex');
            $(".taskCheckbox").attr('checked', 'checked');
        }
    })


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
        if ($(".ajax-result").hasClass('alert-warning')) {
            $(".sendForm").attr('disabled', 'true');
        }
        else{
            $(".sendForm").removeAttr('disabled');
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


    $(".deleteTask").on("click", function (e) {
        var deleteButton = $(this);
        var answerToAction = confirm('Are you sure?');
        if(answerToAction === true){
            var taskID = +$(this).data('taskid');
            var url = "http://hwf/tasks/delete/" + taskID;
            $.ajax({
                method: "POST",
                url: url,
                beforeSend: function () {
                    $('.page-loader').fadeIn();
                },
                success: function (data) {
                    $('.page-loader').fadeOut(100, function(){
                        deleteButton.closest('tr').fadeOut(500);
                    });
                    
                }
            });
        }
        
    });

    $(".deleteMarkedTasks").on("click", function () {
        var deleteButton = $(this);
        var answerToAction = confirm('Are you sure?');
        if (answerToAction === true) {
            var tasksArray = [];
            $('.taskCheckbox').each(function (index, element) {
                if($(element).attr('checked') == "checked"){
                    var taskID = $(element).val();
                    tasksArray.push(taskID);
                }
            })
            var url = "http://hwf/tasks/deletetasks/";
            $.ajax({
                method: "POST",
                url: url,
                data:{
                    taskArray: tasksArray
                },
                beforeSend: function () {
                    $('.page-loader').fadeIn();
                },
                success: function (data) {
                    $('.page-loader').fadeOut(100, function () {
                        if(data == '1'){
                            location.reload();
                        }
                        //deleteButton.closest('tr').fadeOut(500);
                    });

                }
            });
        }
    })

    
});