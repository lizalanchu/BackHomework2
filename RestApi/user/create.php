<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


if (
    !empty($_POST['username']) &&
    !empty($_POST['name']) &&
    !empty($_POST['city_id'])
) {

    $user->name = $_POST['name'];
    $user->city_id = $_POST['city_id'];
    $user->username = $_POST['username'];

    if ($user->create()) {

        http_response_code(201);


        echo json_encode(array("message" => "Пользователь был создан."));
    }

    else {

        http_response_code(503);

        // сообщим пользователю
        echo json_encode(array("message" => "Невозможно создать пользователя."), JSON_UNESCAPED_UNICODE);
    }
}

else {
    http_response_code(400);

    echo json_encode(array("message" => "Невозможно создать пользователя. Данные неполные.") , JSON_UNESCAPED_UNICODE);
}