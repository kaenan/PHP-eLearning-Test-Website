<?php
    session_start();
    $_SESSION['id'] = "";  
    $_SESSION['admin'] = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>Home</title>
</head>
<body>
    <?php include("../templates/header.php") ?>

    <div class="credentials-container">
        
        <div class="credentials-input" id="create">
            <label class="title">Create an account</label>
            <form action="../accounts/createaccount.php" method="post">
                <label>Username:</label>
                <input type="text" name="username" required>
                <label>Password:</label>
                <input type="password" name="password" required>
                <label>Email:</label>
                <input type="email" name="email" required>
                <label>Date of Birth:</label>
                <input type="date" name="DOB" required>
                <div>
                    <input type="submit" value="Create Account">
                </div>
            </form> 
            <label class="help-text">Already have an account? <button onclick="show('block', 'none')">Click Here</button> to login.</label>
        </div>

        <div class="credentials-input" id="login" style="display: none;">
            <label class="title">Login</label>
            <form action="../accounts/login.php" method="post">
            <label>Username:</label>
                <input type="text" name="username" required>
                <label>Password:</label>
                <input type="password" name="password" required>
                <div>
                    <input type="submit" value="Login">
                </div>
            </form>
            <label class="help-text">Don't have an account? <button onclick="show('none', 'block')">Click Here</button> to register.</label>
        </div>
    </div>

</body>

<script>
    function show(login, create){
        document.getElementById("login").style.display = login;
        document.getElementById("create").style.display = create;
    }
</script>
</html>