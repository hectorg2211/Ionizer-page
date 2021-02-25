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
    add_to_table($conn, 'entry_test', ['Name','Number'], ['Hector', 20]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take data example</title>
</head>
<body>
    <form method="post" action="take_data.php">
        <label for="id">Ionizer ID</label>
        <input type="number" name="id" id="id" placeholder="Ionizer ID">
        <label for="line">Line</label>
        <select name="line" id="line">
            <?php
                $linesQuery = optionQueries("line", "line", "ionizer_location_status", "ORDER BY line ASC");
                $lines = mysqli_query($conn, $linesQuery);
                if (!empty($lines) AND mysqli_num_rows($lines) > 0) {
                    //Output data of each row
                    while($row = mysqli_fetch_assoc($lines)) {
                      echo "<option value=\"" . $row['line']. "\">" . $row['line'] . "</option>";
                    };
                };
            ?>
        </select>
        <label for="building">Building</label>
        <select name="building" id="building">
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
            <option value="d">D</option>
        </select>
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="working">Working</option>
            <option value="damaged">Not Working</option>
            <option value="damaged">Alarmed</option>
            <option value="damaged">Not tested</option>
        </select>
        <label for="remark">Remark</label>
        <textarea name="remark" id="remark" cols="30" rows="10"></textarea>
        <input type="submit" value="Add">

        <?php
            $ionizer_id = "";
            $ionizer_line = "";
            $ionizer_building = "";
            $ionizer_status = "";
            $ionizer_remark = "";
            $columns = "";
            $values = "";

            $ionizer_id = 1;
            if (isset($_POST['id'])){
                $ionizer_id = $_POST['id'];
                $ionizer_line = $_POST['line'];
                $ionizer_building = $_POST['building'];
                $ionizer_status = $_POST['status'];
                $ionizer_remark = $_POST['remark'];
                $columns = ["ionizer_id", "line", "building", "status", "remark"];
                $values = [$ionizer_id, $ionizer_line, $ionizer_building, $ionizer_status, $ionizer_remark];
                add_to_table($conn, 'ionizer_entries', $columns, $values);
            }

            echo $ionizer_id . "\n" . 
            $ionizer_line . "\n" .
            $ionizer_building . "\n" .
            $ionizer_status . "\n" .
            $ionizer_remark . "\n" ;

            
        ?>
    </form>
</body>
</html>
