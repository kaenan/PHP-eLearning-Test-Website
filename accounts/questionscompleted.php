<?php 
    include("../challenges/challenges.php");
    include("../database.php");

    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Account parameters.
    $id = $_SESSION['id'];

    // Queries
    $get_query = "SELECT * FROM completedquestions WHERE userId='$id'";
    $create_query = "INSERT INTO completedquestions (userID, challengeId, questionsCompleted) VALUES('$id', 0)";

    // Return Vars
    $question_completed = 0;

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $results = $conn->query($get_query);

        if (mysqli_num_rows($results) < mysqli_num_rows($challenges)){
            $conn->query($create_query);
        }
        else {
            while ($row = mysqli_fetch_array($results)){
                $question_completed = $row['questionsCompleted'];
            }
        }

    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
    }
?>