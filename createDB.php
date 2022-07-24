
<?php

define('ini_config', array(
    "dbServername" => "localhost",
    "dbUsername" => "root",
    "dbPassword" => "password",
    "dbName" =>  "members",
));
// Function to execute sql command and checking the result
// Input Parameters : conn->mysqli, sql->String, tableName->String;
// Return Parameters : void;
// Additional Details: N/A
function executeQueryAndCheckResult($conn, $sql, $tableName)
{
    if (mysqli_query($conn, $sql)) {
        echo "Table $tableName created successfully<br>";
    } else {
        echo "Error creating table $tableName: " . mysqli_error($conn) . mysqli_query($conn, $sql) . "<br>";
    }
}

// Create connection
$conn = mysqli_connect(ini_config['dbServername'], ini_config['dbUsername'], ini_config['dbPassword']);

// Checking connection
if (!$conn) {
    die("Connection failed: Please create a mySql user: file-sharing" . mysqli_connect_error());
}

// connection established. Further processing
echo "Database creation in progress....<br>";

// Creating database
$dbName = ini_config['dbName'];
$sql = "CREATE DATABASE IF NOT EXISTS $dbName;";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database $dbName: " . mysqli_error($conn) . "<br>";
}

// closing connection
mysqli_close($conn);

// Create connection to db
$conn = mysqli_connect(ini_config['dbServername'], ini_config['dbUsername'], ini_config['dbPassword'], ini_config['dbName']);

// Checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}

// sql to create table: user
$sql = "CREATE TABLE IF NOT EXISTS member (
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `firstName` VARCHAR(50),
    `lastName` VARCHAR(50),
    `createDate` DATETIME DEFAULT CURRENT_TIMESTAMP
    );";

// executing query and checking result
executeQueryAndCheckResult($conn, $sql, "member");

// sql to create table: share
$sql = "INSERT INTO `member` (`firstName`, `lastName`) VALUES ('Niamul','Hasan');";

// executing query and checking result
executeQueryAndCheckResult($conn, $sql, "insert");
// sql to create table: share
$sql = "INSERT INTO `member` (`firstName`, `lastName`) VALUES ('Nahid','Hasan');";

// executing query and checking result
executeQueryAndCheckResult($conn, $sql, "insert");

// closing connection
mysqli_close($conn);
