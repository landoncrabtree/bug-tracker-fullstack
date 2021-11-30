<?php
include "database.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . " Make sure 'database.php' is correctly set.");
}

$sql = "CREATE TABLE members (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
token VARCHAR(64) NOT NULL
)";

if ($conn->query($sql) === true) {
    echo "Database tables created successflly.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>
