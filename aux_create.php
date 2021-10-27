<?php
var_dump($_POST);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

include "dbConnection.php"; // Using database connection file here

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // collect value of input field
    $data = $_REQUEST;

    if (empty($data)) {
        echo "data is empty";
    } else {
        var_dump($data);
        $sql = "INSERT INTO book (title, release_date, author_id) VALUES ('" . $data['title'] . "', " . $data['release_date'] . ", " . $data['author_id'] . ")";


        if ($conn->query($sql) === TRUE) {
            echo "New book created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();