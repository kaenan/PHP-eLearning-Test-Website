<?php 
    include("../database.php");
    $dir = "../challenge images/";
    $ok = 1;

    if(array_key_exists('challengeId', $_POST)){
        $challengeId = $_POST['challengeId'];
    } else {
        header("Location:../pages admin/admin home.php");
        exit();
    }

    $file = $_FILES['imageName']['name'];
    $file_location = $dir . $file;
    $file_type = strtolower(pathinfo($file_location,PATHINFO_EXTENSION));

    if ($_FILES['imageName']['size'] > 500000){
        $ok = 0;
    }

    if ($file_type != "jpg" && $file_type != "jpeg" && $file_type !="png"){
        $ok = 0;
    }

    if (!file_exists($file_location) && $ok == 1){
        move_uploaded_file($_FILES['imageName']['tmp_name'], $file_location);
    }

    try 
    {
        if ($ok == 1){
            $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
            $query = "UPDATE`challenges` SET imagePath='$file_location' WHERE id='$challengeId'";
            mysqli_query($conn, $query);
        }
    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
    }

    header("Location:../pages admin/admin home.php");
    exit();
?>