<?php

$servername = "localhost";
// $servername = "sql205.epizy.com";
$dbname = "test_db";
// $dbname = "epiz_32065088_test_db";
$username = "root";
// $username = "epiz_32065088";
$password = "";
// $password = "xETedDN2R6";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

//else echo "Connected successfully";

// $sql = "use test_db";
// $result = $conn->query($sql);

//echo "<br/>Encoding: ".$conn->character_set_name();
// $conn->set_charset("utf8");
//echo "<br/>Encoding: ".$conn->character_set_name();

?>