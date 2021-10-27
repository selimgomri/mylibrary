<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href='http://localhost:8000/create.php'>create</a></li>
                <li><a href='http://localhost:8000'>read</a></li>
                <li><a href='http://localhost:8000/aux_create.php'>create_aux</a></li>

            </ul>
        </nav>
    </header>
    <!--siging database -------------------------------------------------------------------------------------->
    <?php
    include "dbConnection.php"; // Using database connection file here


    $sql = "SELECT id, name FROM author";
    $result = $conn->query($sql);

    ?>

    <!-- form to get the data -->
    <form action="aux_create.php" method="POST">
        <h1> Add book </h1>
        <label for="title">Enter book title: </label>
        <input type="text" name='title' id="title">
        <br />

        <label for="release_date">Enter release date: </label>
        <input type="text" name='release_date' id="release_date">
        <br />

        <label for="author_id">Choose an author: </label>
        <select name="author_id" id ="author_id">
            <option value="">...</option>
            <?php
            // author menu
            while ($row = $result->fetch_assoc()) {
            ?> <option value=<?php echo $row["id"] ?>> <?php echo $row["name"] ?> </option>
            <?php } ?>

        </select>
        <br />

        <input type="submit" value="submit">

    </form>



</body>

</html>