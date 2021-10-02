<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "dbms_project";

$db_host = "151.106.116.46";
$db_user = "u776657329_gecskp";
$db_pass = "5PkdNRRXJQyYQ4M";
$db_name = "u776657329_gecskp";
$db_connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$db_connect) {
    die("Not connected:" . mysqli_connect_error());
    exit();
}
?>