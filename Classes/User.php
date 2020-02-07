<?php

require_once('DB.php');

class User {

    function getUser($login) {

        $connection = DB::getDB();
        $query = mysqli_query($connection, "SELECT `user_login`,`user_pass`, `user_bonuses` FROM `users` WHERE(`user_login` = '$login')");
        $user = $query->fetch_assoc();

        return $user;

    }

}