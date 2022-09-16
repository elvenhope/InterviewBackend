<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

require '../classes/db.php';
//Get the Data from database;
$data = $database->getData();
//Convert our data to Json.
$json_response = json_encode($data);
//Echo our response
echo $json_response;
