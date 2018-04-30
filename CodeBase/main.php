<?php
    if(isset($_POST['su'])) {
        header("Location: signup.php");
    }

    if(isset($_POST['ra'])) {
        header("Location: reviewApplication.php");
    }

    if(isset($_POST['s'])) {
        header("Location: search.php");
    }

    if(isset($_POST['li'])) {
        header("Location: login.php");
    }
?>
