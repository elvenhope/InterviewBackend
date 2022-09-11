<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: content-type");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field

    require "../classes/db.php";

    // $SKU = $_POST['SKU'];
    // $Name = $_POST['Name'];
    // $Price = $_POST['Price'];
    // $Properties = $_POST['Properties'];

    //$data = $_POST['Name'] or $_REQUEST['Name'];

    $json = file_get_contents('php://input');

    $obj = json_decode($json);

    $data = [];
    foreach ($obj as $arr => $key) {
        $data[$arr] = $key;
    }

    echo $database->insertData($data["SKU"], $data["Name"], $data["Price"], $data["Properties"]);

}

// if ($_SERVER["REQUEST_METHOD"] == "GET") {
//     // collect value of input field
//     echo "OK";
// }