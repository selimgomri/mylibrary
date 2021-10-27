<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav>
            <button><a href='http://localhost:8000'>Home</a></button>
        </nav>
    </header>

    <?php
    include "dbConnection.php"; // Using database connection file here

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // collect value of input field
        $data = $_REQUEST;

        if (empty($data)) {
            echo "data is empty";
        } else {

            $sql = "INSERT INTO book (title, release_date, author_id) VALUES ('" . mysqli_real_escape_string($conn, $data['title']) . "', " . $data['release_date'] . ", " . $data['author_id'] . ")";

            echo "New book created successfully";

            if ($conn->query($sql) === TRUE) {

                // header("Location: index.php"); // redirects to read page
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    ?>

</body>

</html>