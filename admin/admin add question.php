<?php
    include("../database.php");

    if (array_key_exists('action', $_POST)){

        $c_Id = $_POST['challengeId'];

        if ($_POST['action'] == "ADD")
        {
            $new_question = $_POST['question'];
            $new_question = htmlentities($new_question);
            $queries = array("INSERT INTO `questions` (challengeId, question) VALUES('$c_Id', '$new_question')");
        }
        else if ($_POST['action'] == "REMOVE")
        {
            $q_Id = $_POST['questionId'];
            $queries = array("DELETE FROM `questions` WHERE id='$q_Id' AND challengeId='$c_Id'",
                "DELETE FROM `answers` WHERE challengeId='$c_Id' AND questionId='$q_Id'",
                "DELETE FROM `fakeanswers` WHERE challengeId='$c_Id' AND questionId='$q_Id'");
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