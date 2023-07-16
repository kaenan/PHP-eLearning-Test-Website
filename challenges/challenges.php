<?php 
    include("../database.php");

    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Account parameters.
    $id = $_SESSION['id'];

    // Queries
    $challenges_query = "SELECT * FROM `challenges`";

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $challenges = mysqli_query($conn, $challenges_query);
    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
    }
?>