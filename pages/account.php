<?php
    include("../database.php");

    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $userId = $_SESSION['id'];

    $query = "SELECT * FROM `challenges`";

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $challenges = mysqli_query($conn, $query);
    } 
    catch (mysqli_sql_exception)
    {
        echo "Could not connect.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/account.css">
    <title>Account Page</title>
</head>
<body>
    <?php include("../templates/header.php") ?>

    <div class="title-container">
        <label>Challenges</label>
    </div>
    
    <div class="account-challenges">
        <?php while ($row = mysqli_fetch_array($challenges)){?>
            <div class="challenge">
                <div class="challenge-element">
                    <label class="challenge-name"> <?php echo $row['name']; ?> </label>
                </div>
                <div class="challenge-element">
                    <img src= "<?php echo $row['imagePath'] ?>" class="challenge-image">
                </div>
                <div class="challenge-element">
                    <form action="challenge.php" method="post">
                        <input style="display: none;" type="text" name="challenge" value="<?php echo $row['id']; ?>"></label>
                        <input type="submit" class="challenge-button" value="Play">
                    </form>
                </div>
                <div class="challenge-score-container">
                    <?php 
                    $challengeId = $row['id'];
                    $score = mysqli_query($conn, "SELECT score FROM `completedquestions` WHERE userId='$userId' AND challengeId='$challengeId'");
                    if (mysqli_num_rows($score) > 0){ 
                        $s = mysqli_fetch_array($score)['score'];
                        $possible = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM `questions` WHERE challengeId='$challengeId'"));
                        echo "<label>$s / $possible</label>";
                    } else {
                        echo "<label>Not Attempted</label>";
                    } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>