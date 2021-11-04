<?php
@include "loginpages.php";
@include "dbConnection.php";





if (!empty($_POST)) {
    $id = $_GET['id'];
    $sql = "SELECT book.id, title, release_year, name FROM book JOIN author ON book.author_id=author.id Where book.id=" . $id;
    $result = $conn->query($sql);
    $_SESSION['cartItem'][] = $result->fetch_assoc();
}
header("Location: index.php");

