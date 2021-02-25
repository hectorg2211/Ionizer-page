<?php
    include 'add_entry.php';
    $serverName = "localhost";
    $username = "hectorg2211";
    $password = "quen12hot";
    $dbname = "test";

    // Connection
    $conn = mysqli_connect($serverName, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    add_to_table($conn, 'entry_test', ['Name','Number'], ['Cesar', 50]);
    mysqli_close($conn);
?>

