<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myLibrary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav>

            <form method="POST">
                <input type="text" name="search" class=form-control>
                <button>search</button>
            </form>
            <button><a href='create.php'>Add book</a></button>
        </nav>
    </header>

    <?php
    include "dbConnection.php"; // Using database connection file here

    $sql = "SELECT book.id, title, release_date, name FROM book JOIN author ON book.author_id=author.id ";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_REQUEST['search'])) {
        
        $data = explode(" ", preg_replace('/\s+/', ' ', $_REQUEST['search']));


        if (!empty($data)) {
            echo "Results for '" . $_REQUEST['search'] . "'";
            $conditions = [];

            for ($i = 0; $i < count($data); $i++) {
                $conditions[] = "title LIKE '%" . $data[$i] . "%'";
                $conditions[] = "release_date LIKE '%" . $data[$i] . "%'";
                $conditions[] = "name LIKE '%" . $data[$i] . "%'";
            }

            if (!empty($conditions)) {
                
                $sql .= "WHERE " . implode(" OR ", $conditions);
            }
        }
    }

    $sql .= "ORDER BY title ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <table class="table table-dark table-hover">
            <tr>
                <th>Title</th>
                <th>Release Date</th>
                <th>Author</th>
                <th></th>
                <th></th>



            </tr>
            <?php // output data of each row 
            ?>
            <?php while ($row = $result->fetch_assoc()) {
            ?> <tr>
                    <td> <?php echo $row["title"]; ?></td>
                    <td><?php echo $row["release_date"]; ?> </td>
                    <td> <?php echo $row["name"]; ?> </td>
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