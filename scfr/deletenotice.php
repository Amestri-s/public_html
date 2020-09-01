<?php

    require "require/head.php";

    if(!(isset($_SESSION['perm'])) || !($_SESSION['perm'] >= 4)) {

                    header('Location: /scfr/auth/');

                    exit;

    }

    $id = $_GET['id'];

    $result = mysqli_query($link, "DELETE FROM resources WHERE id=$id");

    header('Location: /scfr/admin.php');

?>