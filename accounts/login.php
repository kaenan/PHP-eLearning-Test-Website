<?php
    include("../database.php");

    // Login parameters.
    $username = $_POST['username'];
    $pass = $_POST['password'];

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $query = "SELECT id, username, password, admin FROM Accounts WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            header("Location:../pages/index.php", true, 301);
            exit();
        }

        while ($row = mysqli_fetch_array($result)){
            if (password_verify($pass, $row['password'])){

                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['admin'] = $row['admin'];
                header("Location:../pages/account.php", true, 301);
                exit();
            }
        }

        header("Location:../pages/index.php", true, 301);
        exit();
    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
    }
?>