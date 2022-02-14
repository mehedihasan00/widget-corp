<?php 
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}
function confirm_query($result_set) {
    if(!$result_set) {
        die("Database query failed!");
    }
}
function find_all_subjects() {
    global $connection;
     // 2. Perform database query
     $query = "SELECT * ";
     $query .= "FROM subjects ";
     //$query .= "WHERE visible = 1 ";
     $query .= "ORDER BY position ASC";

     $subject_set = mysqli_query($connection, $query);
     // Test if database query show an error
     confirm_query($subject_set);
     return $subject_set;
}
function find_pages_for_subject($subject_id) {
    global $connection;
    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE visible = 1 ";
    $query .= "AND subject_id = {$safe_subject_id} ";
    $query .= "ORDER BY position ASC";       
    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set);
    return $page_set;
}
function find_subject_by_id($subject_id) {
    global $connection;
     // 2. Perform database query
     $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);

     $query = "SELECT * ";
     $query .= "FROM subjects ";
     $query .= "WHERE id = {$safe_subject_id} ";
     $query .= "LIMIT 1";

     $subject_set = mysqli_query($connection, $query);
     confirm_query($subject_set);
    
     if($subject = mysqli_fetch_assoc($subject_set)) {
        return $subject;
     } else {
        return null;
     }   
}
function find_page_by_id($page_id) {
    global $connection;
     // 2. Perform database query
     $safe_page_id = mysqli_real_escape_string($connection, $page_id);

     $query = "SELECT * ";
     $query .= "FROM pages ";
     $query .= "WHERE id = {$safe_page_id} ";
     $query .= "LIMIT 1";

     $page_set = mysqli_query($connection, $query);
     confirm_query($page_set);
    
     if($page = mysqli_fetch_assoc($page_set)) {
        return $page;
     } else {
        return null;
     }   
}

function find_selected_page() {
    global $current_subject;
    global $current_page;
    if(isset($_GET["subject"])) {
        //$selected_subject_id = $_GET["subject"];
        //$selected_page_id = null;
        $current_subject = find_subject_by_id($_GET["subject"]);
        $current_page = null;
    } else if($_GET["page"]) {
        //$selected_page_id = $_GET["page"];
        //$selected_subject_id = null;
        $current_page = find_page_by_id($_GET["page"]);
        $current_subject = null;
    } else {
        //$selected_subject_id = null;
        //$selected_page_id = null;
        $current_page = null;
        $current_subject = null;
    }
}

function navigation($subject_array, $page_array) {
    $output = "<ul class=\"subjects\">";
        $subject_set = find_all_subjects();
                // 3. Use return data if any
        while($subject = mysqli_fetch_assoc($subject_set)) {
            // Output data from each row
            $output .= "<li ";
            if($subject_array && $subject["id"] == $subject_array["id"]) {
                $output .= "class=\"selected\"";
            }
            $output .= ">";
            $output .= "<a href=\"manage_content.php?subject=";
            $output .= urlencode($subject["id"]);
            $output .= "\">";
            $output .= $subject["menu_name"] . " (" . $subject["id"] . ")";
            $output .= "</a>";
            $page_set = find_pages_for_subject($subject["id"]);
            $output .= "<ul class=\"pages\">";
            while($page = mysqli_fetch_assoc($page_set)) { 
                $output .= "<li ";
                if($page_array && $page["id"] == $page_array["id"]) {
                    $output .= "class=\"selected\"";
                }
                $output .= ">";
                $output .= "<a href=\"manage_content.php?page=";
                $output .= urlencode($page["id"]);
                $output .= "\">";
                $output .= $page["menu_name"];
                $output .= "</a>";
                $output .= "</li>";
            }
                mysqli_free_result($page_set);
                $output .= "</ul>";
                $output .= "</li>"; 
        }
        mysqli_free_result($subject_set);
    $output .= "</ul>";

    return $output;
}
?>