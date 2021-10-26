<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT title, release_date, name FROM book JOIN author ON book.author_id=author.id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "Title: " . $row["title"]. " - Release date: " . $row["release_date"]. " " . " - Author: " . $row["name"]. "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
