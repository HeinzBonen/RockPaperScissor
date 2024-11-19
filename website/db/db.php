<?php
$dbCred = include "config.php";

// get database credentials
$db_host = $dbCred["DB_HOST"];
$db_user = $dbCred["DB_USER"];
$db_pass = $dbCred["DB_PASS"];
$db_data = $dbCred["DB_DATA"];

if (!$db_host || !$db_user || !$db_data) {
    error_log("Missing database credentials.");
    echo "<h1>Er is een interne fout opgetreden.</h1>";
    exit;
}

// create connection to the database
$con = new mysqli($db_host, $db_user, $db_pass, $db_data);

// validate connection
if ($con->connect_error) {
    error_log("Connection failed: " . $con->connect_error);
    echo "<h1>Er is een interne fout opgetreden.</h1>";
    exit;
}

?>
