<?php
include "dbConnection.php"; // Using database connection file here

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // collect value of input field
    $data = $_REQUEST;

    if (empty($data)) {
        echo "data is empty";
    } else {
       
        $sql = "INSERT INTO book (title, release_date, author_id) VALUES ('" . $data['title'] . "', " . $data['release_date'] . ", " . $data['author_id'] . ")";


        if ($conn->query($sql) === TRUE) {
            echo "New book created successfully";
            header("Location: index.php"); // redirects to read page
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();