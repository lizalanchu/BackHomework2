<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/city.php';

$database = new Database();
$db = $database->getConnection();

$city = new User($db);

$city->id = $_POST['id'];
$city->name = $_POST['name'];


if ($city->delete()) {

    http_response_code(200);

    echo json_encode(array("message" => "Город был удалён"));
}

else {

    http_response_code(503);


    echo json_encode(array("message" => "Не удалось удалить город"));

}


