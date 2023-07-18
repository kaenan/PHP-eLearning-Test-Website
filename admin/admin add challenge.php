<?php
    include("../database.php");

    if (array_key_exists('action', $_POST)){
        if ($_POST['action'] == "ADD")
        {
            $new_challenge = $_POST['challenge'];
            $new_challenge = htmlentities($new_challenge);
            $queries = array("INSERT INTO `challenges` (name, imagePath) VALUES('$new_challenge', '../challenge images/placeholder.jpg')");
        }
        else if ($_POST['action'] == "REMOVE")
        {
            $c_Id = $_POST['challengeId'];
            $queries = array("DELETE FROM `challenges` WHERE id='$c_Id'",
                "DELETE FROM `questions` WHERE challengeId='$c_Id'",
                "DELETE FROM `answers` WHERE challengeId='$c_Id'",
                "DELETE FROM `fakeanswers` WHERE challengeId='$c_Id'");
        }
    }

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

        foreach($queries as $q){
            mysqli_query($conn, $q);
        }

        header("Location:../pages admin/admin home.php");
        exit();
    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
        exit();
    }
?>