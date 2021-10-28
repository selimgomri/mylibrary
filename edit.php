<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <h1><a href='http://localhost:8000'>Mylibrary</a></h1>
        </nav>
    </header>
    <!--siging database -------------------------------------------------------------------------------------->
    <?php

    include "dbConnection.php"; // Using database connection file here

    $id = $_GET['id']; // get id through query string

    $sql = "SELECT title, release_year, author_id, name from book JOIN author ON author_id=author.id WHERE book.id='$id'"; // select query
    $result = $conn->query($sql); // select query


    $data = mysqli_fetch_array($result); // fetch data


    if (isset($_POST['update'])) // when click on Update button
    {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $releaseYear = $_POST['release_year'];
        $authorId = $_POST['author_id'];


        $edit = mysqli_query($conn, "UPDATE book SET title='$title', release_year='$releaseYear', author_id='$authorId' WHERE book.id='$id'");

        echo "Book successfully updated";

        if ($edit) {
            mysqli_close($conn); // Close connection
            header("index.php"); // redirects to read page
            exit;
        } else {
            echo mysqli_error($conn);
        }
    }
    ?>

    <form method="POST">
        <h1> Edit book </h1>
        <label for="title">Edit book title: </label>
        <input type="text" name='title' value="<?php echo $data['title'] ?>">
        <br />

        <label for="release_year">Edit release date: </label>
        <input type="text" name='release_year' value="<?php echo $data['release_year'] ?>">
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