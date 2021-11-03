<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header>
        <nav>
            <h1><a href='index.php'>My library</a></h1>
        </nav>
        <?php
        include "loginpages.php";
        ?>
    </header>
    <!--siging database -------------------------------------------------------------------------------------->
    <?php
    include "dbConnection.php"; // Using database connection file here

    $sql = "SELECT id, name FROM author ORDER BY name ASC";
    $result = $conn->query($sql);

    ?>

    <!-- form to get the data -->
    <form method="POST">
        <h2> Add book </h2>


        <label for="title">Enter book title: </label>
        <input type="text" name='title' id="title" class="form-control" required>
        <br />

        <label for="release_year">Enter release year: </label>
        <input type="text" name='release_year' id="release_year" class="form-control" required>
        <br />

        <label for="author_id">Choose an author: </label>
        <select name="author_id" id="author_id" class="form-select" aria-label="Default select example" required>
            <option value="">...</option>
            <?php
            // author menu
            while ($row = $result->fetch_assoc()) {
                ?> <option value=<?php echo $row["id"] ?> required> <?php echo $row["name"] ?> </option>
            <?php
            } ?>

        </select>
        <br />

        <input class="btn btn-outline-dark" type="submit" value="Submit">

    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // collect value of input field
        $data = $_REQUEST;
        
        if (empty($data['title'])) {
            ?> <p class="request_error"> <?php echo "Title is empty"; ?> </p> <?php
        } elseif (empty($data['release_year'])) {
            ?> <p class="request_error"> <?php echo "Release year is empty"; ?> </p> <?php
        } elseif (empty($data['author_id'])) {
            ?> <p class="request_error"> <?php echo "Please choose an author"; ?> </p> <?php
        } else {
            $sql = "INSERT INTO book (title, release_year, author_id) VALUES ('" . mysqli_real_escape_string($conn, $data['title']) . "', " . $data['release_year'] . ", " . $data['author_id'] . ")";

            if ($conn->query($sql) === true) {
                ?> <p class="request_done"> <?php echo "New book added successfully"; ?>
    </p>
    <?php // header("Location: index.php"); // redirects to read page
            } else {
                ?> <p class="request_error"> <?php echo "Invalid format of release year"; ?> </p>
    <?php
            }
        }
    }
    $conn->close();
    ?>
</body>

</html>