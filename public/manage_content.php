<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<div id="main">
    <div id="navigation">
        <?php
            echo navigation($current_subject, $current_page);
        ?>
        <a href="new_subject.php">+ Add a subject</a>
    </div>
    <div id="page">
        <?php if($current_subject) { ?>
            <h2>Manage Subject</h2>
            Subject's Menu Name: <?php echo $current_subject["menu_name"]; ?>
        <?php } else if($current_page) { ?>
            <h2>Manage Page</h2>
        Page's Menu Name: <?php echo $current_page["menu_name"]; ?>
        <?php } else { ?>
            <h2>Please select a subject or a page</h2>
        <?php } ?>

    </div>
</div>
<?php include("../includes/layouts/footer.php") ?>