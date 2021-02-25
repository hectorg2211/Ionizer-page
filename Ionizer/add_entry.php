<?php
    $serverName = "localhost";
    $username = "hectorg2211";
    $password = "quen12hot";
    $dbname = "test";

    // Connection to the database
    $conn = mysqli_connect($serverName, $username, $password, $dbname);

    // Check connection
    if (!$conn) die("Connection failed: " . mysqli_connect_errno());
    //echo "Connected successfully";

    function add_to_query($query, $elements, $quotes=false) {
        $q = $quotes ? "'": "";
        for ($i = 0; $i < count($elements); $i++){
            $query .= $q . $elements[$i] . $q;
            if ($i != count($elements) - 1) {
                $query .= " ,";
            };
        };
        return $query;
    }

    function add_to_table($conn, $table, $columns, $values){
        /* This function adds elements to a selected table 
        $conn: A database connection
        $table: String containing table name
        $columns: List of strings with column names
        $values: List of strings with values for each column
        */

        $query = "INSERT INTO $table (";
        $query = add_to_query($query, $columns);

        $query .= ")
                  VALUES (";

        $query = add_to_query($query, $values, true);
        $query .= ");";
        //echo $query;
        mysqli_query($conn, $query);
        //echo $query;
    };

    function optionQueries($column, $alias, $table, $extra=""){
        $elements = "SELECT DISTINCT $column AS $alias
                      FROM $table
                      $extra;";
        //echo $elements;
        return $elements;
    };

?>

