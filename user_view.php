<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Page User</title>
		<link href="css/style.css" media="screen" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
        <script type="text/javascript">
	        var user = window.localStorage.getItem('user');
	        var bonus = window.localStorage.getItem('bonus');
	        if(!user){
	        	window.location.href = "index.php";
	    	}
	    	$(document).ready(function(){
		    	$('input').change(function(){
		      		$(".error").fadeOut('300');
			    });

			    $("#user-login").text(user);
			    $("#bonuses").text(bonus);

			    $('#bonus').click(function(){
			        var bonus_user = $('#prize-amount').text();
			        console.log(bonus_user);
			        $('#bonuses').text(bonus_user);
			    });
			    $('#logout').click(function () {
			        window.localStorage.clear();
			        window.location.href = "index.php";
			    });
			});
		</script>
        <script type="text/javascript" src="js/main.js"></script>

	</head>
	<body>
		<div id="wrap-user-page">
			<div class="top">
				<button class="button" id="logout">Выйти из системы</button>
				<div class="info">
					<h1>Добро пожаловать, <span id="user-login"></span></h1>
					<p>Ваши бонусы: <span id="bonuses"></span></p>
				</div>
			</div>
			<div class="play">
				<button class="button button-play" id="play-button">Жми и выигрывай!</button>
			</div>
			<div class="you-prize">
				<h2>Вы выиграли <span id="prize-name"></span> в колличестве <span id="prize-amount"></span> !!!</h2>
				<div class="wrap-button-choose">
					<button class="button yes-prize" >Принять</button>
					<button class="button no-prize" >Отказаться</button>
				</div>
			</div>
		</div>
		<div id="popup-address" class="popup">
			<div class="wrap-login"> 
				<h3>Заполните данные:</h3>
				<form id="address-form" method="post" name="address-form" action="">
		            <label for="user_firstname">Имя</label>
		            <input type="text" name="user_firstname" id="user_firstname" required="">
		            <label for="user_lastname">Фамилия</label>
		            <input type="text" id="user_lastname" name="user_lastname" required="">
		            <label for="user_postcode">Почтовый индекс</label>
		            <input type="text" id="user_postcode" name="user_postcode" required="">
		            <label for="user_country">Страна</label>
		            <input type="text" id="user_country" name="user_country" required="">
		            <label for="user_city">Город</label>
		            <input type="text" id="user_city" name="user_city" required="">
		            <label for="user_address">Адресс</label>
		            <input type="text" id="user_address" name="user_address" required="">
		            <p class="error">Неверные данные:<br>
		                <span></span>
		            </p>
		            <input id="addresssent" type="submit" class="button">
		        </form>
	        </div>
		</div>
		<div id="popup-bank" class="popup">
			

			<div class="wrap-login">
				<div class="ask">
					<p>Вы можете перевести деньги на карту, либо зачислить в бонус с учетом коеффициента</p>
					<button class="button to-card" >На карту</button>
					<button class="button to-bonus" >Конвертировать в бонусы</button>
				</div>
				<div class="form-card">
					<h3>Заполните данные:</h3>
					<form id="card-form" method="post" name="card-form" action="">
			            <label for="firstname-card">Имя</label>
			            <input type="text" name="user_firstname" id="firstname-card" required="">
			            <label for="lastname-card">Фамилия</label>
			            <input type="text" id="lastname-card" name="user_lastname" required="">
			            <label for="card">Номер карточки</label>
			            <input type="text" id="card" name="user_card" required="">
			            <p class="error">Неверные данные:<br>
			                <span></span>
			            </p>
			            <input id="banksent" type="submit" class="button" name="submit-card">
			        </form>
			    </div>
	        </div>
		</div>
	</body>
</html>
