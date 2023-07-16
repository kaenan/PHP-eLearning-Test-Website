<?php
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <title>Document</title>
</head>
<body>
    <div class="header-container">
        <label class="header-title">Kaenan Sutcliffe eLearning</label>

        <div class="buttons-container">
            <button class="nav-button" onclick="homeButton()">Home</button>
            <button class="nav-button" onclick="accountButton()">Account</button>
            <?php if ($_SESSION['admin'] == 1){ ?>
                <button class="nav-button" onclick="adminPage()">Admin</button>
            <?php } ?>
        </div>
    </div>
</body>

<script>
    function homeButton(){
        window.location.href = '../pages/index.php';
    }

    function accountButton(){
        <?php 
        if (array_key_exists('id', $_SESSION) && $_SESSION['id'] != null){ ?>
            window.location.href = '../pages/account.php';
        <?php } else { ?>
            window.location.href = '../pages/index.php';
        <?php } ?>
    }

    function adminPage(){
        window.location.href = '../pages admin/admin home.php';
    }

</script>
</html>