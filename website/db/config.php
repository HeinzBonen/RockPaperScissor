<?php
if ($_SERVER['SERVER_NAME'] == "") {
    return array(
        "DB_HOST" => "",
        "DB_USER" => "",
        "DB_PASS" => "",
        "DB_DATA" => ""
    );
} else if ($_SERVER['SERVER_NAME'] == "localhost") {
    return array(
        "DB_HOST" => "localhost",
        "DB_USER" => "root",
        "DB_PASS" => "",
        "DB_DATA" => "rps_webgame"
    );
} else {
    return null;
}
?>