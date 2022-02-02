<?php
    define("DB_SERVER", "localhost");
    define("DB_USER", "widget_cms");
    define("DB_PASS", "secretpassword");
    define("DB_NAME", "widget_corp");
    // $dbhost = "localhost";
    // $dbuser = "widget_cms";
    // $dbpass = "secretpassword";
    // $dbname = "widget_corp";

    // 1. create a database connection
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    //$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Test if connection work
    if(mysqli_connect_errno()) {
        die("Database connection failed: " . 
            mysqli_connect_error() . 
             "(" . mysqli_connect_errno() . ")"
        );
    } 

?>