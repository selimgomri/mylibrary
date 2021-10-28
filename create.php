<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
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

    $sql = "SELECT id, name FROM author";
    $result = $conn->query($sql);

    ?>

    <!-- form to get the data -->
    <form method="POST">
        <h2> Add book </h2>
        <label for="title">Enter book title: </label>
        <input type="text" name='title' id="title" required>
        <br />

        <label for="release_year">Enter release date: </label>
        <input type="text" name='release_year' id="release_year" required>
        <br />

        <label for="author_id">Choose an author: </label>
        <select name="author_id" id="author_id" required>
            <option value="">...</option>
            <?php
            // author menu
            while ($row = $result->fetch_assoc()) {
            ?> <option value=<?php echo $row["id"] ?> required> <?php echo $row["name"] ?> </option>
            <?php } ?>

        </select>
        <br />

        <input type="submit" value="submit">

    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // collect value of input field
        $data = $_REQUEST;

        if (empty($data['title']) || empty($data['release_year']) || empty($data['author_id'])) {
            ?> <p class="request_error"> <?php echo "data is empty";?> </p> <?php
        } else {

            $sql = "INSERT INTO book (title, release_year, author_id) VALUES ('" . mysqli_real_escape_string($conn, $data['title']) . "', " . $data['release_year'] . ", " . $data['author_id'] . ")";



            if ($conn->query($sql) === TRUE) {
                ?> <p class="request_done"> <?php echo "New book added successfully"; ?> 
                </p>
                <?php // header("Location: index.php"); // redirects to read page
            } 
            else {
            ?> <p class="request_error"> <?php echo "Error: " . $sql . "<br>" . $conn->error; ?> </p>
            <?php
            }
        }
    }
    $conn->close();
    ?>



</body>

</html>