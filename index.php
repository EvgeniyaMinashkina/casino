<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  
    <link href="css/style.css" media="screen" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript">
        var user = window.localStorage.getItem('user');
        console.log(user);
        if(user){
            window.location.href = "user_view.php";
        } 
    </script>
    <title>Login</title>
</head>
<body>
    <div class="wrap-login">
        <h1>Вход</h1>
        <form id="login-form" method="post" name="login_form">
            <label for="login">Имя пользователя</label>
            <input type="text" name="login" id="login">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password">
            <p class="error">Неверные данные:<br>
                <span></span>
            </p>
            <input id="auth" type="submit" class="button">
        </form>
        <div class="blocked"></div>
    </div>
</body>
</html>
