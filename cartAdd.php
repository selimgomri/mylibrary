<?php
@include "loginpages.php";


if (!empty($_POST)) {
    $_SESSION['cartItem'][] = $_GET['id'];
}
header("Location: index.php");

