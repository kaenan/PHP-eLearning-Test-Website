<?php
    include("../database.php");

    // Create account parameters.
    $username = $_POST['username'];
    $hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $dob = $_POST['DOB'];

    session_start();

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $query = "INSERT INTO Accounts (username, password, email, DOB) VALUES ('$username', '$hash_pass', '$email', '$dob')";

        if ($conn->query($query)) {
            $_SESSION['id'] = $conn->insert_id;
            $id = $conn->insert_id;
        }

        header("Location:../pages/account.php", true, 301);

    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
    }
    finally{
        mysqli_close($conn);
    }
?>