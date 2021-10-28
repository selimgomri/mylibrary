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
            <h1><a href='http://localhost:8000'>My library</a></h1>
        </nav>
    </header>
    <!--siging database -------------------------------------------------------------------------------------->
    <?php
    include "dbConnection.php"; // Using database connection file here

    ?>

    <!-- form to get the data -->
    <form method="POST">
        <h2> Add author </h2>
        <label for="author">Enter author name: </label>
        <input type="text" name='name' id="name" required>
        <br />

        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // collect value of input field
        $data = $_REQUEST;

        if (empty($data['name'])) {
            ?> <p class="request_error"> <?php echo "Author name is empty"; ?> </p> <?php
        } 
        else {
            
            $sql = "INSERT INTO author (name) VALUES ('" . mysqli_real_escape_string($conn, $data['name']) ."')";

            
            if ($conn->query($sql) === TRUE) {
                ?> <p class="request_done"> <?php echo "New author added successfully"; ?>
                </p>
                <?php // header("Location: index.php"); // redirects to read page
            }
        }
    }
$conn->close();
    ?>
</body>

</html>