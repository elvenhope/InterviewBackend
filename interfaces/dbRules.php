<?php

interface ValidDB
{
    public function __construct(string $servername, string $username, string $password, string $dbName);
    public function insertData(string $SKU, string $Name, string $Price, string $Properties);
    public function getData();
    public function deleteData(array $idArray);
    public function selectBySKU(string $id);
}
