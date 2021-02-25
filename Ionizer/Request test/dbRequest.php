<?php
    $serverName = "localhost";
    $username = "hectorg2211";
    $password = "quen12hot";
    $dbname = "test";

    $array = array();
    $row['line'] = 35;
    // Connection
    $conn = mysqli_connect($serverName, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT DISTINCT line AS line
              FROM ionizer_location_status
              ORDER BY line ASC;";
              
    $result = mysqli_query($conn, $query);

    

    mysqli_close($conn);
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            if(!empty($result) AND mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            // $tempArray = array("id"=>$row['id'], "serial number"=>$row["serial_no"], "year"=>$row["ionizer_year"], "model"=>$row['model'] );
            // echo "id: " . $row["id"] . "Serial number: " . $row["serial_no"] . "Ionizer year: " . $row["ionizer_year"] . "<br>";
            echo "<h1 value=\"" . $row['line']. "\">" . $row['line'] . "</h1>";
            //array_push($array, $tempArray);
        }
    } else {
        echo "0 results";
    }
        ?>
        <!-- Passing the associative array to JS (Object) -->
        <script class="dataArray">
            let x = <?php echo json_encode($array, JSON_HEX_TAG); ?>;
        </script>
        <script src="./script.js"></script>
    </body>
</html>