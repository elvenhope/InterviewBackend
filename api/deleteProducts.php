<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: POST');

header("Access-Control-Allow-Headers: content-type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field

    require "../classes/db.php";

    $json = file_get_contents('php://input');

    $obj = json_decode($json);

    $data = [];
    foreach ($obj as $arr => $key) {
        $data[$arr] = $key;
    }

    echo $database->deleteData($data);
}
