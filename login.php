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
        <form method="POST">
            <label for="username">Enter Username: </label>
            <input type="text" name='username' class="form-control">
            <input class="btn btn-outline-dark" type="submit" value="Log in">
            <?php
                if (!empty($_POST)) {
                    $_SESSION=$_POST;
                    header("Location: index.php");
                }
                ?>
        </form>
    </header>
</body>

</html>