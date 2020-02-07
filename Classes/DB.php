<?php 

class DB {
	
	static function getDB() {

		$connection = mysqli_connect('localhost', 'root', '', 'casino');

	    if( $connection == false) {
	        echo 'Не удалось подключиться к базе данных!<br>';
	        echo mysqli_connect_error();
	        exit();
    	}

    	return $connection;
    }


}