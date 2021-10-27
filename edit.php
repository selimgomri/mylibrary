<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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

    $id = $_GET['id']; // get id through query string

    $sql = "SELECT title, release_date, author_id, name from book JOIN author ON author_id=author.id WHERE book.id='$id'"; // select query
    $result = $conn->query($sql); // select query

    //var_dump($result);
    $data = mysqli_fetch_array($result); // fetch data


    if (isset($_POST['update'])) // when click on Update button
    {
        $title = $_POST['title'];
        $releaseDate = $_POST['release_date'];
        $authorId = $_POST['author_id'];


        $edit = mysqli_query($conn, "UPDATE book JOIN author ON author_id=author.id SET title='$title', release_date='$releaseDate', author_id='$authorId' WHERE book.id='$id'");

        echo "Book successfully updated";

        if ($edit) {
            mysqli_close($conn); // Close connection
            header("index.php"); // redirects to read page
            exit;
        } else {
            echo mysqli_error();
        }
    }
    ?>

    <form method="POST">
        <h1> Edit book </h1>
        <label for="title">Edit book title: </label>
        <input type="text" name='title' value="<?php echo $data['title'] ?>">
        <br />

        <label for="release_date">Edit release date: </label>
        <input type="text" name='release_date' value="<?php echo $data['release_date'] ?>">
        <br />

        <?php // authors for the menu selection
        $sql = "SELECT id, name FROM author";
        $result = $conn->query($sql);
        ?>

        <label for="author_id">Choose an author: </label>
        <select name="author_id">
            <option value="<?php echo $data["author_id"] ?>"><?php echo $data["name"] ?></option>
            <?php
            // author menu
            while ($row = $result->fetch_assoc()) {
                if ($data["author_id"] != $row["id"]) {
                ?> <option value=<?php echo $row["id"] ?>> <?php echo $row["name"] ?> </option>
                <?php 
                }
            } ?>

        </select>
        <br />

        <input type="submit" name="update" value="update">

    </form>




</body>

</html>