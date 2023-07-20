<?php
    include("../database.php");

    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Account parameters.
    $id = $_SESSION['id'];

    // Chosen Challenge
    if (array_key_exists('challenge', $_POST)){
        $challenge_id = $_POST['challenge'];
        $_SESSION['challenge'] = $challenge_id;
    }
    else
    {
        $challenge_id = $_SESSION['challenge'];
    }

    // Queries
    $get_challenge_query = "SELECT name FROM `challenges` WHERE id='$challenge_id'";
    $get_questions_query = "SELECT id, question FROM `questions` WHERE challengeId='$challenge_id'";

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $challenge = mysqli_query($conn, $get_challenge_query);
        $questions = mysqli_query($conn, $get_questions_query);

        $num_q = 1;
        $total = mysqli_num_rows($questions);
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
    <link rel="stylesheet" href="../css/challenge.css">
    <title>Challenge</title>
</head>
<body>
    <?php include("../templates/header.php") ?>
    <h1 class="challenge-title"><?php echo mysqli_fetch_array($challenge)['name'] ?></h1>

    <div class="questions-container" id="questions-container">

        <?php while ($question = mysqli_fetch_array($questions)) { 
            $qId = $question['id'];
            $answer = mysqli_fetch_array(mysqli_query($conn, "SELECT answer FROM `answers` WHERE challengeId='$challenge_id' AND questionId='$qId'"));
            $fake_answers = mysqli_fetch_array(mysqli_query($conn, "SELECT fakeanswers FROM `fakeanswers` WHERE challengeId='$challenge_id' AND questionId='$qId'")); 
            $answer_array = explode(":", $fake_answers['fakeanswers']);
            array_push($answer_array, $answer['answer']);
            shuffle($answer_array);
            ?>
            <div class="question" id="<?php echo $num_q; ?>" <?php if ($num_q > 1) echo "style=\"display: none;\"" ?>>
                <h2 class="question-title"> <?php echo $question['question'] . " (" . $num_q . " / " . $total . ")"; ?></h2>

                <?php foreach ($answer_array as $q) { ?>
                        <label class="question-input"> <?php echo $q; ?>
                            <input type="radio" name="<?php echo $num_q ?>" <?php echo "onclick=\"answerQuestion('$num_q', '$q')\""?>></input>
                            <span class="checkmark"></span>
                        </label>
                <?php } ?>
            </div>
            
        <?php $num_q += 1; 
    } ?>

    </div>

    <div class="final-score-container" id="final-score-container" style="display: none;">
        <label id="score" class="score">score</label>

        <div>
            <?php for($i = 0; $i < $num_q; $i++) {
                echo "<label id=\"$i-answer\"></label>";
            } ?>
        </div>
    </div>

    <div class="question-nav-buttons-container">
        <button class="question-nav-button" id="prev-button" onclick="changeQuestion(currentQuestion - 1, -1)">Previous Question</button>
        <button class="question-nav-button" id="next-button" onclick="changeQuestion(currentQuestion + 1, 1)">Next Question</button>
        <button class="question-nav-button" id="answers-button" onclick="checkAnswers()">Check Answers</button>
        <button class="question-nav-button" id="tryagain-button" onclick="window.location.href = 'challenge.php'" style="display: none;">Try Again</button>
        <form action="../challenges/submitchallenge.php" method="post" id="submit-form" style="display: none;">
            <input id="score-input" type="number" name="score" style="display: none;">
            <input class="question-nav-button" id="submit-button" type="submit" value="Submit">
        </form>
    </div>

</body>
<script>

    const numQuestions = <?php echo $num_q - 1?>;
    const questions = [];
    const answers = [];
    const submittedAnswers = [];

    <?php
    $questions = mysqli_query($conn, "SELECT question FROM `questions` WHERE challengeId='$challenge_id'");
    while ($question_array = mysqli_fetch_array($questions)){
        $i = $question_array['question'];
        $i= html_entity_decode($i);
        echo "questions.push(\"$i\");";
    }

    $answers = mysqli_query($conn, "SELECT answer FROM `answers` WHERE challengeId='$challenge_id'");
    while ($answer_array = mysqli_fetch_array($answers)){
        $i = $answer_array['answer'];
        $i= html_entity_decode($i);
        echo "answers.push(\"$i\");";
    }
    ?>

    currentQuestion = 1;
    correctAnswers = 0;

    function changeQuestion(x, y){
        if (x < 1 || x > numQuestions) return;

        document.getElementById(String(x - y)).style.display = "none";
        document.getElementById(String(x)).style.display = "block";
        currentQuestion += y;
    }

    function checkAnswers(){
        for (i = 0; i < answers.length; i++){
            document.getElementById((i).toString() +"-answer").innerHTML = (i+1).toString() + ". " + questions[i];
            if (answers[i] == submittedAnswers[i]){
                correctAnswers++;

                document.getElementById((i).toString()+"-answer").style.color = "green"
            } else {
                document.getElementById((i).toString()+"-answer").style.color = "red"
            }
        }

        changeHTML();
    }

    function changeHTML(){
        document.getElementById("prev-button").style.display = "none";
        document.getElementById("next-button").style.display = "none";
        document.getElementById("answers-button").style.display = "none";
        document.getElementById("questions-container").style.display = "none";

        document.getElementById("final-score-container").style.display = "flex";
        document.getElementById("tryagain-button").style.display = "block";
        document.getElementById("submit-form").style.display = "block";
        document.getElementById("score").innerHTML = correctAnswers + " / " + <?php echo $total ?>;
        document.getElementById("score-input").value = correctAnswers;
    }

    function answerQuestion(id, a){
        submittedAnswers[id-1] = a;
    }
    
</script>
</html>