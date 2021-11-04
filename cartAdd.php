<?php
@include "loginpages.php";
@include "dbConnection.php";





if (!empty($_POST)) {
    $verifier=true;
    $id = $_GET['id'];
    if (!isset($_SESSION['cartItem'])) {
        $sql = "SELECT book.id, title, release_year, name FROM book JOIN author ON book.author_id=author.id Where book.id=" . $id;
        $result = $conn->query($sql);
        $_SESSION['cartItem'][] = $result->fetch_assoc();
    } 
    else {
        foreach ($_SESSION['cartItem'] as $k => $v) {
            if ($id == $_SESSION['cartItem'][$k]['id']) {
                echo "<br> Book already in cart <br>";
                $verifier = false;
                break;
            }
        }
        if ($verifier) {
            $sql = "SELECT book.id, title, release_year, name FROM book JOIN author ON book.author_id=author.id Where book.id=" . $id;
            $result = $conn->query($sql);
            $_SESSION['cartItem'][] = $result->fetch_assoc();
        }
    }
}

header("Location: index.php");