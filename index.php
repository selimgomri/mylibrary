<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!--FontAwesome is required for the icons-->
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>


</head>

<body>
    <header>
        <h1>My library</h1>
        <div>
            <?php
        if (isset($_SESSION['username'])) {
            echo "Welcome " . $_SESSION['username'];
            
        } 
        else {
        ?>
            <form method="POST">
                <label for="username">Enter Username: </label>
                <input type="text" name='username' class="form-control" required>
                <input class="btn btn-outline-dark" type="submit" value="Log in">
            </form>
            <?php
                $_SESSION=$_POST;
                var_dump($_SESSION);
        }?>
        </div>

        <nav>
            <form method="POST" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <div>
                    <input type="search" name="search" class="form-control" placeholder="Search...">
                    <button><i class="fas fa-search"></i></button>
                </div>

                Book released after year
                <select name="yearFilter" class="form-select" aria-label="Default select example">
                    <option value="">..</option>
                    <?php
                    for ($i = 1900; $i < 2021; $i += 10) { ?>
                    <option value="<?php echo $i ?>"><?php echo $i; ?> </option>
                    <?php } ?>
                </select>
                included
            </form>
        </nav>
    </header>

    <?php
    include "dbConnection.php"; // Using database connection file here

    $sql = "SELECT book.id, title, release_year, name FROM book JOIN author ON book.author_id=author.id ";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_REQUEST['search'])) {
            $data = explode(" ", preg_replace('/\s+/', ' ', mysqli_real_escape_string($conn, $_REQUEST['search'])));


            if (!empty($data)) {
                echo "Results for '" . $_REQUEST['search'] . "' ";
                $conditions = [];

                for ($i = 0; $i < count($data); $i++) {
                    $conditions[] = "title LIKE '%" . $data[$i] . "%'";
                    $conditions[] = "release_year LIKE '%" . $data[$i] . "%'";
                    $conditions[] = "name LIKE '%" . $data[$i] . "%'";
                }

                if (!empty($conditions)) {
                    $sql .= "WHERE (" . implode(" OR ", $conditions) . ")";
                }
            }
        }
        if (!empty($_REQUEST['yearFilter'])) {
            $sql .= " AND release_year >= " . $_REQUEST['yearFilter'];
            echo "Since year '" . $_REQUEST['yearFilter'] . "'</br>";
        }
    }

    $sql .= " ORDER BY title ASC";


    $result = $conn->query($sql);
    ?>
    <button class="btn btn-outline-dark"><a href='create.php'>Add a new book</a></button>
    <button class="btn btn-outline-dark"><a href='addAuthor.php'>Add a new author</a></button>
    <?php
    if ($result->num_rows > 0) {
        ?>


    <table class="table table-dark table-striped">
        <tr>
            <th>Title</th>
            <th>Release year</th>
            <th>Author</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php // output data of each row
            ?>
        <?php while ($row = $result->fetch_assoc()) {
                ?> <tr>
            <td> <?php echo $row["title"]; ?></td>
            <td><?php echo $row["release_year"]; ?> </td>
            <td> <?php echo $row["name"]; ?> </td>
            <td> <a href="edit.php?id=<?php echo $row["id"] ?>"><i class="fas fa-edit"></i></a> </td>
            <td> <a href="delete.php?id=<?php echo $row["id"] ?>"><i class="fas fa-trash-alt"></i></a> </td>

        </tr>


        <?php
            } ?>
    </table>
    <?php
    } else { ?>
    0 results
    <?php }

    $conn->close();
    ?>

</body>

</html>