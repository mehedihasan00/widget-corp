<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 
  print_r($_POST);
  if(isset($_POST["submit"])) {
    // Process the form
    $menu_name = $_POST["menu_name"];
    $position = (int)$_POST["position"];
    $visible = (int)$_POST["visible"];

    // Escape the string
    $menu_name = mysql_prep($menu_name);

    // Perform insertation query
    $query = "INSERT INTO ";
    $query .= "subjects ( ";
    $query .= "menu_name, position, visible ";
    $query .= ") values ( ";
    $query .= "'{$menu_name}', {$position}, {$visible}";
    $query .= " )";

    $result = mysqli_query($connection, $query);
    //confirm_query($result);

    if($result) {
      //Success
      $_SESSION["message"] = "Subject created!";
      redirect_to("manage_content.php");
    } else {
      $_SESSION["message"] = "Subject creation failed!";
      redirect_to("new_subject.php");
    }
      
  } else {
    redirect_to("new_subject.php");
  }
?>
<?php 
  // 5. close database connection
  if(isset($connection)) {
    mysqli_close($connection);
  }

?>