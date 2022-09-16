<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: POST');

header("Access-Control-Allow-Headers: content-type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field

    require "../classes/db.php";

    //Getting the Input

    $json = file_get_contents('php://input');

    /*
        I am aware I could have done this using $_POST however, if you examine the vue repository
        you will see that in addProduct.vue I am sending the request with Axios instead of submitting
        using the form. I gave alot of thought to that decision and the main reason I decided to do was because Layout dom wasn't really working out for it.

        The save button was in the header part while the form itself was in the body, it just didn't seem right.

        I apologize if I shouldn't have taken such liberty.
    */

    //Decoding the Input
    $obj = json_decode($json);

    //convert our Input into usable Data;
    $data = [];
    foreach ($obj as $arr => $key) {
        $data[$arr] = $key;
    }

    //Call the database to delete the selected rows.
    echo $database->deleteData($data);
}
