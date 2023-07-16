<?php
    include("../database.php");

    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Account parameters.
    $id = $_SESSION['id'];

    $challenge_id = $_SESSION['challenge'];
    $score = $_POST['score'];

    $get_query = "SELECT id FROM `completedquestions` WHERE userId='$id' AND challengeId='$challenge_id'";
    $create_query = "INSERT INTO `completedquestions` (userId, challengeId, score) VALUES('$id', '$challenge_id', '$score')";
    $update_query = "UPDATE `completedquestions` SET score='$score' WHERE userId='$id' AND challengeId='$challenge_id'";

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $result = mysqli_query($conn, $get_query);

        if (mysqli_num_rows($result) < 1){
            mysqli_query($conn, $create_query);
        } else {
            mysqli_query($conn, $update_query);
        }
    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
    }

    header("Location:../pages/account.php", true, 301);
?>