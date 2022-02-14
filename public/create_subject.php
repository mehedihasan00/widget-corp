<?php require_once("../includes/db_connection.php"); ?>
<?php 
    print_r($_POST);
    $menu_name = $_POST["menu_name"];
    $position = (int)$_POST["position"];
    $visible = (int)$_POST["visible"];
    echo $menu_name;
if(isset($_POST) && $_POST != null) {
    global $connection;
    $query = "INSERT INTO ";
    $query .= "subjects ( ";
    $query .= "menu_name, position, visible ";
    $query .= ") values ( ";
    $query .= "'{$menu_name}', {$position}, {$visible}";
    $query .= " )";

    //$insert_subject = mysqli_query($connection, $query);
    // confirm_query($insert_subject);
    if (mysqli_query($connection, $query)) {
        echo "<br/>". "New record created successfully";
      } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
      }
      
      mysqli_close($connection);
} else {
    echo "Query didn't happend!";
}


?>