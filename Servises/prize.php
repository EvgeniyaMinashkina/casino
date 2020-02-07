<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once '../Classes/Prize.php';
    header('Content-Type: application/json');

    $prize = new Prize();
    $action = $_POST['action'] ?: null;
    if ($action) {
        if ($action == 'setBonus') {

            $bonus = $_POST['sentdata'];
            $user = $_POST['user'];

            echo json_encode($prize->newInfoUser($bonus,$user));
            return;
        }
        if ($action == 'sendmoney') {

            $card = $_POST['infocard'];
            $user = $_POST['user'];

            echo json_encode($prize->cardToBD($card,$user));
            return;
        }
        if ($action == 'sendaddress') {

            $address = $_POST['address'];
            $user = $_POST['user'];

            echo json_encode($prize->addressToBD($address,$user));
            return;
        }
        if ($action == 'moneyToBonus') {

            $user = $_POST['user'];
            $bonus_db = $prize->getCurrentBonus($user);
            $current_bonus = $_POST['moneytobonus'];
            $bonus = $prize->moneyToBonus($current_bonus);
            $bonus_total = $bonus_db + $bonus;
            $prize->newInfoUser($bonus_total, $user);

            echo json_encode($bonus_total);

            return;
        }
        
    }
    $action = $_POST['address'];

    $type_prize = $prize->randPrize();
    if ($type_prize == 'bonus') {
        $name_prize = 'Бонус';
    } elseif ($type_prize == 'money') {
        $name_prize = 'Деньги';
    } else {
        $info_prize = $prize->randGift();
        $name_prize = reset($info_prize);
    }

    $amount_prize = $prize->randQuantity();

    $prize = [
        'type'   => $type_prize,
        'name'   => $name_prize,
        'amount' => $amount_prize,
    ];

    echo json_encode(['success' => $prize]);

    return;
}