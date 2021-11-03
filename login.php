<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header>
        <?php
    if (isset($_SESSION['username'])) {
        echo "Welcome " . $_SESSION['username'];
    }
    else {
        ?>

        <form method="POST" >
            <label for="username">Enter Username: </label>
            <input type="text" name='username' class="form-control" required>
            <input class="btn btn-outline-dark" type="submit" value="Log in">
            <form>
            <?php
            $_SESSION=$_POST;
            var_dump($_SESSION);
            header("Location: index.php");
    }?>

    </header>
</body>

</html>