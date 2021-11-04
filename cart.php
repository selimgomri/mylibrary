<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!--FontAwesome is required for the icons-->
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <nav>
            <h1><a href='index.php'>My library</a></h1>
            <?php @include "loginpages.php"; ?>
            <h2>Cart</h2>
        </nav>
    </header>
    <table class="table table-dark table-striped">
        <tr>
            <th>Title</th>
            <th>Release year</th>
            <th>Author</th>
        </tr>

        <?php 
        foreach($row=$_SESSION['cartItem'] as $k => $v) {
        ?>
        <tr>
            <td> <?php echo $row[$k]["title"]; ?></td>
            <td><?php echo $row[$k]["release_year"]; ?> </td>
            <td> <?php echo $row[$k]["name"]; ?> </td>
        </tr>
        <?php
        } ?>
    </table>






</body>

</html>