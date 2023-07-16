<?php
    include("../database.php");

    if (array_key_exists('action', $_POST)){

        $c_Id = $_POST['challengeId'];
        $q_Id = $_POST['questionId'];

        if ($_POST['action'] == "ADD")
        {
            if ($_POST['answerType'] == "real"){
                $new_answer= $_POST['answer'];
                $new_answer = htmlentities($new_answer);
                $queries = "INSERT INTO `answers` (challengeId, questionId, answer) VALUES('$c_Id', '$q_Id', '$new_answer')";
            } 
            else {
                $new_answer= $_POST['answer'];
                $new_answer = htmlentities($new_answer);
                $queries = "INSERT INTO `fakeanswers` (challengeId, questionId, fakeanswers) VALUES('$c_Id', '$q_Id', '$new_answer')";
            }
        }
        else if ($_POST['action'] == "REMOVE")
        {
            $a_Id = $_POST['answerId'];
            if ($_POST['answerType'] == "real"){
                $queries = "DELETE FROM `answers` WHERE id='$a_Id'";
            } 
            else {
                $queries = "DELETE FROM `fakeanswers` WHERE id='$a_Id'";
            }
        }
    }

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        mysqli_query($conn, $queries);

        header("Location:../pages admin/admin home.php");
        exit();
    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
        exit();
    }
?>