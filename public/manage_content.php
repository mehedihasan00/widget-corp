<?php
    $dbhost = "localhost";
    $dbuser = "widget_cms";
    $dbpass = "secretpassword";
    $dbname = "widget_corp";

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Test if connection work
    if(mysqli_connect_errno()) {
        die("Database connection failed: " . 
            mysqli_connect_error() . 
             "(" . mysqli_connect_errno() . ")"
        );
    } 

?>
<?php require_once("../includes/functions.php") ?>
<?php 
    // 2. Perform database query
    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE visible = 1 ";
    $query .= "ORDER BY position ASC";

    $result = mysqli_query($connection, $query);
    // Test if database query show an error
    if(!$result) {
        die("Database query failed!");
    }
?>
<?php include("../includes/layouts/header.php") ?>
<div id="main">
    <div id="navigation">
        <ul>
            <?php 
                // 3. Use return data if any
                while($subject = mysqli_fetch_assoc($result)) {
                    // Output data from each row
            ?>  
                <li><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?></li>
            <?php 
                } 
            ?>
        </ul>
    </div>
    <div id="page">
        <h2>Manage Content</h2>
       
    </div>
</div>
<?php 
    // 4. Release return data
    mysqli_free_result($result);
?>
<?php include("../includes/layouts/footer.php") ?>
<?php 
    // Close the database connection
    if(isset($connection)) {
        mysqli_close($connection);
    }
?>