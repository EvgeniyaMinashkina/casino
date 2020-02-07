<?php 

class Bank {

	
	function infoClient($firstname, $lastname, $card) {

		$infoclient = [
			'firstname' => $firstname,
			'lastname' => $lastname,
			'card' => $card,
		];

    	return $infoclient;
    }

    // Connect to API bank
    function moneyToBank() {

		$infoclient = $this->infoClient();
		/*Sent to API
		$vars = http_build_query($infoclient);
		// создаем параметры контекста
		$options = array(
		    'http' => array(  
		                'method'  => 'POST',  // метод передачи данных
		                'header'  => 'Content-type: application/x-www-form-urlencoded',  // заголовок 
		                'content' => $vars,  // переменные
		            )  
		);  
		$context  = stream_context_create($options);  // создаём контекст потока
		$result = file_get_contents('http://test.web/index.php', false, $context); //отправляем запрос


		*/

    	return $result;
    }


}