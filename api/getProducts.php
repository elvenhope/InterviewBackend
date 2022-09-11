<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

require '../classes/db.php';

$data = $database->getData();
$json_response = json_encode($data);
echo $json_response;