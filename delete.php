    <!--siging database -------------------------------------------------------------------------------------->
    <?php

    include "dbConnection.php"; // Using database connection file here

    $id = $_GET['id']; // get id through query string

    mysqli_query($conn, "DELETE FROM book WHERE id=$id");
    mysqli_close($conn); // Close connection
    header("Location: index.php"); // redirects to read page
