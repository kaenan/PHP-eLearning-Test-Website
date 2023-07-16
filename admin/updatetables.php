<?php 
    include("../database.php");

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
        header("Location:../pages/index.php");
        exit();
    }

    if (array_key_exists('challengeTitle', $_POST)){
        $c_id = $_POST['challengeId'];
        $update = $_POST['challengeTitle'];
        $update = htmlentities($update);

        $query = "UPDATE `challenges` SET name='$update' WHERE id='$c_id'";
        mysqli_query($conn, $query);
    }

    if (array_key_exists('questionTitle', $_POST)){
        $c_id = $_POST['questionId'];
        $update = $_POST['questionTitle'];
        $update = htmlentities($update);

        $query = "UPDATE `questions` SET question='$update' WHERE id='$c_id'";
        mysqli_query($conn, $query);
    }

    if (array_key_exists('answerTitle', $_POST)){
        $c_id = $_POST['answerId'];
        $update = $_POST['answerTitle'];
        $update = htmlentities($update);

        $query = "UPDATE `answers` SET answer='$update' WHERE id='$c_id'";
        mysqli_query($conn, $query);
    }

    if (array_key_exists('fakeanswerTitle', $_POST)){
        $c_id = $_POST['fakeanswerId'];
        $update = $_POST['fakeanswerTitle'];
        $update = htmlentities($update);

        $query = "UPDATE `fakeanswers` SET fakeanswers='$update' WHERE id='$c_id'";
        mysqli_query($conn, $query);
    }



    header("Location:../pages admin/admin home.php");
    exit();
?>