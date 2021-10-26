<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myLibrary</title>
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
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT title, release_date, name, readers_note FROM book JOIN author ON book.author_id=author.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Release Date</th>
                <th>Author</th>
                <th>Readers_note</th>

            </tr>
            <?php // output data of each row 
            ?>
            <?php while ($row = $result->fetch_assoc()) {
            ?> <tr>
                    <td> <?php echo $row["title"]; ?></td>
                    <td><?php echo $row["release_date"]; ?> </td>
                    <td> <?php echo $row["name"]; ?> </td>
                    <td> <?php echo $row["readers_note"]; ?> </td>

                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        0 results
    <?php }

    $conn->close();
    ?>

</body>

</html>