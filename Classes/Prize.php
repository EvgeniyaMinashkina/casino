<?php 
require_once('DB.php');

class Prize {

    private $connection;
    
    private $types = array(
        'money',
        'bonus',
        'gift'
    );

   public $selectedPrizeType = null;

    public function __construct()
    {
        $this->connection = DB::getDB();
    }

    //Prize Type Selection
    function randPrize() {

        if($this->selectedPrizeType){
            return $this->selectedPrizeType;
        }
        $types_prize = $this->types;

        return $this->selectedPrizeType = $types_prize[array_rand($types_prize, 1)];
    }

    //Random selection of a physical item for a prize from the database
    function randGift() {

        $query = mysqli_query($this->connection, "SELECT `prize_id`, `prize_name` FROM `prizes` WHERE( `prize_type` = 'gift')");
        if ($result = $query) {
            // fetching data and putting it in an array
            while ($row = $result->fetch_row()) {
                $gifts[$row[0]] = $row[1];
            }
        }
        $rand_id = array_rand($gifts, 1);
        $gift = [$rand_id=>$gifts[$rand_id]];

        return $gift;
    }

    // Determine the maximum amount of prize
    function getDataPrize() {
        $type_prize = $this->randPrize();

        //If the prize is a physical item, then check the amount in the database
        if($type_prize == 'gift') {
            $prize_name = reset($this->randGift());
            $query = mysqli_query($this->connection, "SELECT `prize_amount` FROM `prizes` WHERE(`prize_name` = '$prize_name')"); ///`id`
            $data_prize = $query->fetch_assoc();
            $available_quantity = reset($data_prize);
        } else {
            //If bonuses or money, set the maximum value of winning at a time
            $available_quantity = 1000; 
        }

        return $available_quantity;
    }

    //Random determination of the amount of prize, given the limitation of the maximum amount
    function randQuantity() {
        $max_amount = $this->getDataPrize();
        $type_prize = $this->randPrize();
        if ($max_amount>0) {
            if ($type_prize == 'gift') {
                $quantity = 1; //If a physical item, we can only win one item
            } else {
                $quantity = rand(1, $max_amount); //Randomly determine the amount in a given range if the prize is money or a bonus
            }
        } else {
            $quantity = 0;
        }
        
        return $quantity;
    }

    //Еransferring money to bonuses, taking into account the coefficient
    function moneyToBonus($bonus) {

        $bonus = $bonus * 2;
        return $bonus;
        
    }

    //Reducing available prizes and recording in the database
    function subtractPrizeOfDB($quantity, $type) {

        $query = mysqli_query("SELECT `prize_type`, prize_id, `prize_amount` FROM `prizes` WHERE `type` = '$type'");
        $result = $query->fetch_assoc();
        $subtract_priza = $result['prize_amount'] - $quantity;
        $id_prize = $result['prize_id'];
        mysqli_query("UPDATE `prizes` SET `prize_amount` = $subtract_priza WHERE `prize_id` = $id_prize");
        
    }


    //Writing bonuses to the table users 
    function newInfoUser($bonus, $user_login) {

        $query = mysqli_query($this->connection, "UPDATE `users` SET `user_bonuses` = $bonus WHERE (`user_login` = '$user_login')");
        return;

    }

    //Get user's bonuses
    function getCurrentBonus($user_login) {

        $query = mysqli_query($this->connection, "SELECT `user_bonuses` FROM `users` WHERE (`user_login` = '$user_login')");
        $data_bonus = $query->fetch_assoc();
        $current_bonus = reset($data_bonus);
        return $current_bonus;

    }

    //Writing info address to the table users 
    function addressToBD($address, $user_login) {

    parse_str($address, $result);

    // build query...
       $sql  = "UPDATE `users` SET ";
        foreach ($result as $key=>$value){
            $sql .= "`$key`='$value', ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE (`user_login` = '$user_login')";
        $query = mysqli_query($this->connection, $sql);


        return $sql;
    }

    //Writing info address to the table users 
    function cardToBD($card, $user_login) {

    parse_str($card, $result);

    // build query...
       $sql  = "UPDATE `users` SET ";
        foreach ($result as $key=>$value){
            $sql .= "`$key`='$value', ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE (`user_login` = '$user_login')";
        $query = mysqli_query($this->connection, $sql);

        return $sql;
    }

    //Filling winners table in database
    function winnersToBD() {


    }


}