<?php

interface ValidDB {
    public function __construct(string $servername, string $username, string $password, string $dbName);
}