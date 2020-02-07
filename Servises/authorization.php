<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once '../Classes/User.php';
    header('Content-Type: application/json');

    $login = addslashes(htmlspecialchars(trim($_POST['login'])));
    $password = md5(addslashes(htmlspecialchars(trim($_POST['password']))));

    if(empty($login) or empty($password)) {
    	echo json_encode(['error'=>"Заполните поля"]);
        return;
    }

    // Checking for a user in the database 
    $user = new User();
    $user = $user->getUser($login);

    if(!$user['user_login']) {
        echo json_encode(['error'=>"Неверный логин и/или пароль"]);
        return;
    }

    if($password != $user['user_pass']) {
        echo json_encode(['error'=>"Неверный логин и/или пароль"]);
        return;
    }


    echo json_encode(['success'=> $user]);
    return;
}

