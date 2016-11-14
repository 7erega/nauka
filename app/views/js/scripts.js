$('document').ready(function() {

    $("#reg").validate({
        rules:
        {
            user_full_name: {
                required: true,
                minlength: 3
            },
            user_email: {
                required: true,
                email: true
            },
            user_password: {
                required: true,
                minlength: 6
            }
        },
        messages:
        {
            user_full_name: {
                required: "Будь ласка, введіть ПІБ",
                minlength: "ПІБ повинно бути більше 3 символів"
            },
            user_email: "Будь ласка, введіть правильну email адресу",
            user_password: {
                required: "Будь ласка, введіть пароль",
                minlength: "Пароль повинен бути більше 6 символів"
            }
        },
        submitHandler: regForm
    });

    function regForm()
    {
        var data = $("#reg").serialize();

        $.ajax({
            type : 'POST',
            url  : 'main/reg',
            data : data,
            beforeSend: function() {
                $("#error").fadeOut();
                $("#signup").val('зачекайте...');
            },
            success: function(data) {
                $("#signup").val('зареєструватися');

                if(data) {
                    $("#error").fadeIn(1000, function() {
                        $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span>'+data+'</div>');
                    });
                }
            }
        });
        return false;
    }

    $("#log").validate({
        rules:
        {
            user_email: {
                required: true,
                email: true
            },
            user_password: {
                required: true,
                minlength: 6
            }
        },
        messages:
        {
            user_email: "Будь ласка, введіть правильну email адресу",
            user_password: {
                required: "Будь ласка, введіть пароль",
                minlength: "Пароль повинен бути більше 6 символів"
            }
        },
        submitHandler: logForm
    });

    function logForm()
    {
        var data = $("#log").serialize();

        $.ajax({
            type : 'POST',
            url  : 'main/auth',
            data : data,
            beforeSend: function() {
                $("#error").fadeOut();
                $("#login").val('зачекайте...');
            },
            success: function(data) {
                $("#login").val('увійти');
                alert(data);
                if(data) {
                    $("#error").fadeIn(1000, function() {
                        $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> '+data+' </div>');
                    });
                }

                //location.href = '/teach/index';
            }
        });
        return false;
    }

});