<?php
  include 'add_entry.php';
  $serverName = "localhost";
  $username = "hectorg2211";
  $password = "quen12hot";
  $dbname = "test";

  // In case JS is needed
  //$array = array();

  // Connection to the database
  $conn = mysqli_connect($serverName, $username, $password, $dbname);

  // Check connection
  if (!$conn) die("Connection failed: " . mysqli_connect_errno());

  // Display al the table data
  $result = filterUpdate($conn);

  // Query the lines for the filter options
  $linesQuery = optionQueries("line", "line", "ionizer_location_status", "ORDER BY line ASC");
  $lines = mysqli_query($conn, $linesQuery);

  // Query the buildings for the filter options
  $plantQuery = optionQueries("plant", "plant", "ionizer_location_status"); 
  $plant = mysqli_query($conn, $plantQuery);

  // Query the Status for the filter options
  $statusQuery = optionQueries("status", "status", "ionizer_entries");
  $status = mysqli_query($conn, $statusQuery);

  // Filter updates function
  function filterUpdate($conn, $column="", $filter=""){
    $linesQuery = "SELECT ionizer_id, line, building, status,remark
                    FROM ionizer_entries\n";
    if ($column) {
      $linesQuery .= "WHERE $column = \"$filter\"";
    }

    $linesQuery .= ";";

    $lines = mysqli_query($conn, $linesQuery);
    //echo $linesQuery;
    return $lines;
  }
  
  /* The following function adds table rows depending on the table given by
  the filters and adds the class "second" for some rows to change its color */
  function showTable($table) {
  if (!empty($table) AND mysqli_num_rows($table) > 0) {
    //Output data of each row
    //print_r($table);
    $rowClass = 1;
    while($row = mysqli_fetch_assoc($table)) {
        if ($rowClass % 2 == 0) $class = ' class="second"';
        else $class = '';
        
        echo "
            <tr$class>
                <td>$row[ionizer_id]</td>
                <td>$row[line]</td>
                <td>$row[building]</td>
                <td title=\"$row[remark]\">$row[status]</td>
            </tr>";
        
        $rowClass++;
      };
    };
  };
  
  if (isset($_POST['id_entry'])){
              //print_r($_POST);
                $ionizer_id = $_POST['id_entry'];
                $ionizer_line = $_POST['line_entry'];
                $ionizer_building = $_POST['building_entry'];
                $ionizer_status = $_POST['status_entry'];
                $ionizer_remark = $_POST['remark_entry'];
                $columns = ["ionizer_id", "line", "building", "status", "remark"];
                $values = [$ionizer_id, $ionizer_line, $ionizer_building, $ionizer_status, $ionizer_remark];
                add_to_table($conn, 'ionizer_entries', $columns, $values);
            }
              
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="stylesheet" href="./css/css/all.css" />
    <link rel="icon" 
      type="image/png" 
      href="./extra/samsung.png">
    <title>Ionizer status</title>
  </head>
  <body>
    <!-- Search icon -->
    <div class="icon_1 show_filter">
      <i class="fas fa-search-minus"></i>
    </div>

    <!-- Add entry icon -->
    <div class="icon_2 show_entry">
      <i class="fas fa-plus"></i>
    </div>

    <!-- History icon -->
    <div class="icon_3 show_entry">
      <i class="fas fa-book-medical"></i>
    </div>


    <!-- Pop up window for filtering -->
    <div class="filter_window hidden" style="margin: 0">
      <button class="close">&times;</button> <!-- X use in window for closing -->

      <div class="filter">
        <h2>Filters</h2>

        <!-- Filter form options -->
        <form method="post" action="index.php" class="filter_form">

          <!-- ID filter -->
          <div class="option">
            <label for="id_filter">Ionizer ID</label>
            <input type="number" name="id_filter" id="id_filter" class="ionizer_id" placeholder="Ionizer ID">
          </div>

          <!-- Line Filter -->
          <div class="option">
            <label for="filter">Line</label>
            <select name="line_filter" id="">
              <option value="all">All</option>
              <!-- The following code adds options tags with its corresponding values
              to the main select tag of the filter -->
              
              <?php
                if (!empty($lines) AND mysqli_num_rows($lines) > 0) {
                  //Output data of each row
                  while($row = mysqli_fetch_assoc($lines)) {
                    echo "<option value=\"" . $row['line']. "\">" . $row['line'] . "</option>";
                  };
                };
              ?>
            </select>
          </div> 
          <!--xxx Line Filter xxx-->
          
          <!-- Building filter -->
          <div class="option">
            <label for="building">Building</label>
            <select name="building_filter" id="">
              <option value="all">All</option>

                <?php
                  if (!empty($plant) AND mysqli_num_rows($plant) > 0) {
                    //Output data of each row
                    while($row = mysqli_fetch_assoc($plant)) {
                      echo "<option value=\"" . $row['plant']. "\">" . $row['plant'] . "</option>";
                    };
                  };
                ?>
            </select>
          </div>
          <!--xxx Building filter xxx-->

          <!-- Repair Status Filter -->
          <div class="option">
            <label for="status">Status</label>
            <select name="status_filter" id="">
              <option value="all">All</option>
                <?php
                  if (!empty($status) AND mysqli_num_rows($status) > 0) {
                    //Output data of each row
                    while($row = mysqli_fetch_assoc($status)) {
                      echo "<option>" . $row['status'] . "</option>";
                    };
                  };
                ?>
            </select>
          </div>
          <!--xxx Repair Status Filter xxx-->

          <div class="option">
            <input type="submit" value="Apply" class="sub" />
          </div>

        </form>
        <!--xxx Filter form options xxx-->
      </div>
    </div>
    <!--xxx Pop up window for filtering xxx-->

    <!-- Pop up window for entry -->
    <div class="entry_window hidden" style="margin: 0">
      <button class="close">&times;</button> <!-- X use in window for closing -->

      <div class="entry">
        <h2>Add entry</h2>

        <!-- Entry options -->
        <form method="post" action="index.php" class="entry_form">

          <div class="option">
            <label for="id">Ionizer ID</label>
            <input type="number" name="id_entry" id="id" class="ionizer_id" placeholder="Ionizer ID" required >
          </div>

          <div class="option">
            <label for="line" class="lbl_line">Line</label>
            <select name="line_entry" id="line">
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
          </div>

          <div class="option">
            <label for="building">Building</label>
            <select name="building_entry" id="building">
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>
          </div>

          <div class="option">
            <label for="status">Status</label>
            <select name="status_entry" id="status">
                <option value="working">Working</option>
                <option value="damaged">Not Working</option>
                <option value="damaged">Alarmed</option>
                <option value="damaged">Not tested</option>
            </select>
          </div>

          <div class="option">
            <label for="remark" class="remark">Remark</label>
            <textarea name="remark_entry" id="remark" cols="30" rows="10"></textarea>
          </div>
          
          <div class="option">
            <input type="submit" value="Add" class="sub">
          </div>
          
        </form>
        <!--xxx Entry options xxx-->

      </div>
    </div>
    <!--xxx Pop up window for entry xxx-->

    <!-- Background for pop up window -->
    <div class="overlay hidden"></div>

    <!-- History window -->
    <section class="history hidden">
      <table class="history_table">
            <caption>Change history</caption>
            <tr>
              <th>Ionizer ID</th>
              <th>Line</th>
              <th>Building</th>
              <th>Status</th>
              <th>Change date</th>
              <th>Type</th>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
            </tr>
        </table>
    </section>
    <!-- xxx History window xxx -->

    <!-- Whole table -->
    <section class="main">
      <table>
        <thead>
          <caption>
            <h1>Ionizer status table</h1>
          </caption>

          <tr class="thead">
            <th>Ionizer ID</th>
            <th>Line</th>
            <th>Building</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
        <!-- Here go the table rows -->
          <div class="rowsphp">
            <!-- Code for updating with filter -->
            <?php
              if (isset($_POST['id_filter']) && $_POST['id_filter'] != ""){
                $filter = $_POST['id_filter'];
                $linesFilter = filterUpdate($conn, "ionizer_id", $filter);
                showTable($linesFilter);
              }else if (isset($_POST['line_filter']) && $_POST['line_filter'] != "all"){
                $filter = $_POST['line_filter'];
                $linesFilter = filterUpdate($conn, "line", $filter);
                showTable($linesFilter);
              }else if (isset($_POST['building_filter']) && $_POST['building_filter'] != "all"){
                $filter = $_POST['building_filter'];
                $linesFilter = filterUpdate($conn, "building", $filter);
                showTable($linesFilter);
              }else if (isset($_POST['status_filter']) && $_POST['status_filter'] != "all"){
                $filter = $_POST['status_filter'];
                $linesFilter = filterUpdate($conn, "status", $filter);
                showTable($linesFilter);                    
              }else {
                // This display the entire table
                  showTable($result);              
              };

              mysqli_close($conn);
            ?>
            <!--xxx Code for updating with filter xxx-->

          </div>
        </tbody>
      </table>
    </section>
    <!--xxx Whole Table xxx-->

    <script src="script.js"></script>
  </body>
</html>
