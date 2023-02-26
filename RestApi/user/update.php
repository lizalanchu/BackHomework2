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

$user->id = $_POST['id'];
$user->name = $_POST['name'];
$user->city_id = $_POST['city_id'];
$user->username = $_POST['username'];

if ($user->update()) {

    http_response_code(200);

    echo json_encode(array("message" => "Пользователь был обновлён") , JSON_UNESCAPED_UNICODE);
}
else {
    http_response_code(503);

    echo json_encode(array("message" => "Невозможно обновить пользователя") , JSON_UNESCAPED_UNICODE);

}
