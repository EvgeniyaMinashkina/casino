$(document).ready(function(){
    var counter = window.localStorage.getItem('counter');

    //block if more than 3 attempts
    function blocked(){
        var time_now = moment().format('X');
        var time_block = moment.unix(window.localStorage.getItem('time')).add(5,'minutes');
        var time_left =  time_block.diff(moment(), 'seconds');
        if(time_left > 0){
            var warning = 'Попробуйте еще раз через ' + time_left + ' секунд';
            $('#login-form').css('display','none');
            $('.blocked').text(warning);
            time_left = 0;
        } else {
            window.localStorage.setItem('counter', 0);
            window.localStorage.removeItem('time');
        }
        
    }
    if (counter=='block'){
        blocked();
    }
    
    if(!counter ) {
        var counter =  0;
    }
 

    $('#auth').click(function (e) {
        e.preventDefault();
        $.ajax({
            url:      '../Servises/authorization.php',
            method:   'post',
            dataType: 'json',
            data:     $('#login, #password, #bonus'),
            success:  function (response) {
                if (typeof response.success !== "undefined") {
                    window.localStorage.setItem('user', response.success.user_login);
                    window.localStorage.setItem('bonus', response.success.user_bonuses);
                    console.log(window.localStorage.getItem('user'));
                    window.location.href = "user_view.php";
                }
                if (typeof  response.error !== 'undefined') {
                    $(".error span").text(response.error);
                    $(".error").fadeIn('500');
                    window.localStorage.setItem('counter', counter);
                    console.log( window.localStorage.getItem('counter'));

                    if(counter > 2){ 
		                window.localStorage.setItem('time', moment().format('X'));
                        counter = 'block';
		                window.localStorage.setItem('counter', 'block' );

		            }
                    if (counter=='block'){
                        blocked();
                    }
    	          	
                    if(counter!=='block') {
    		            counter++;
                    }
                }
            },
            error:    function (error) {
                console.log(error);
            }
        });
    });


    //Push button play//
    $('#play-button').click(function (e) {
        e.preventDefault();
        $.ajax({
            url:      '../Servises/prize.php',
            method:   'post',
            dataType: 'json',
            data:     $('#prize'),
            success:  function (response) {
                if (typeof response.success !== "undefined") {
                    $('#prize-amount').text(response.success.amount);
                    $('#prize-name').text(response.success.name);
                    var type = response.success.type;
                    $('.yes-prize').attr('id', type);
                    console.log(response.success);
                }
            },
            error:    function (error) {
                console.log(error);
            }
        });
        $('.you-prize').show();
    });


    $('.no-prize').click(function(){
        $('.you-prize').hide();
    });


    $('.yes-prize').click(function(e){
        e.preventDefault();
        var type = $('.yes-prize').attr('id');
        if(type == 'bonus') {
            var bonus1 = Number($('#bonuses').text());
            var bonus2 = Number($('#prize-amount').text());
            var bonus_sum = bonus1+bonus2;
            window.localStorage.setItem('user_bonuses', bonus_sum);
            $('#bonuses').text(bonus_sum);
            var sentdata = window.localStorage.getItem('user_bonuses');
            var user = window.localStorage.getItem('user');
            var data = {action:"setBonus", sentdata:sentdata, user:user};
            console.log(data);
            $.ajax({
                url:      '../Servises/prize.php',
                method:   'post',
                dataType: 'json',
                data: data,
                success:  function (response) {
                    console.log(response);
                },
                error:    function (error) {
                    // console.log(error);
                }
            });

        } else if (type == 'money'){
            $('#popup-bank').show();
        } else if (type == 'gift'){
            $('#popup-address').show();
        }
        $('.you-prize').hide();
       
    });

    $("#address-form").submit(function(e) {
        e.preventDefault();

        var address = $("#address-form").serialize();
        var user = window.localStorage.getItem('user');
        var data = {action:"sendaddress", address:address, user:user};

        console.log(data);
        $.ajax({
            type: "post",
            url: "../Servises/prize.php",
            dataType: 'json',
            data: data,
            success: function(responce) {
                // console.log(responce);
            }
        });
        $("#popup-address").hide();
    });

    $("#card-form").submit(function(e) {
        e.preventDefault();

        var infocard = $("#card-form").serialize();
        var user = window.localStorage.getItem('user');
        var data = {action:"sendmoney", infocard:infocard, user:user};

        console.log(data);
        $.ajax({
            type: "post",
            url: "../Servises/prize.php",
            dataType: 'json',
            data: data,
            success: function(responce) {
                console.log(responce);
            }
        });
        $("#popup-bank").hide();
    });



    $('.to-bonus').click(function(e){
        e.preventDefault();
        var user = window.localStorage.getItem('user');
        var moneytobonus = Number($('#prize-amount').text());
        var data = {action:"moneyToBonus", moneytobonus:moneytobonus, user:user};
        console.log(data);
        $.ajax({
            url:      '../Servises/prize.php',
            method:   'post',
            dataType: 'json',
            data: data,
            success:  function (response) {
                $('#bonuses').text(response);
            },
            error:    function (error) {
                // console.log(error);
            }
        });

        $('#popup-bank').hide();
    });

    $('.to-card').click(function(){
        $('.form-card').show();
    });

    


    $('input').change(function(){
      $(".error").fadeOut('300');
    });

    $('#logout').click(function () {
        window.localStorage.clear();
        
    });
});

