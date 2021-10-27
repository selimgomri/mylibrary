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
            </ul>
        </nav>
    </header>

    <?php
    include "dbConnection.php"; // Using database connection file here

    $sql = "SELECT book.id, title, release_date, name, readers_note FROM book JOIN author ON book.author_id=author.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Release Date</th>
                <th>Author</th>
                <th>Readers_note</th>
                <th>Edit</th>
            </tr>
            <?php // output data of each row 
            ?>
            <?php while ($row = $result->fetch_assoc()) {
            ?> <tr>
                    <td> <?php echo $row["title"]; ?></td>
                    <td><?php echo $row["release_date"]; ?> </td>
                    <td> <?php echo $row["name"]; ?> </td>
                    <td> <?php echo $row["readers_note"]; ?> </td>
                    <td> <button><a href="edit.php?id=<?php echo $row["id"] ?>">EDIT</a></button> </td>
                    <td> <button><a href="delete.php?id=<?php echo $row["id"] ?>">DELETE</a></button> </td>



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