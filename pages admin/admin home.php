<?php 
    include("../database.php");
    include("../challenges/challenges.php");

    if ($_SESSION['admin'] != 1){
        header("Location:../pages/index.php");
        exit();
    }

    if (array_key_exists('challenge', $_POST)){
        $challenge_id = $_POST['challenge'];
        $challenge_name = $_POST['challengeName'];
    }
    else
    {
        $challenge_id = null;
        $challenge_name = null;
    }

    if (array_key_exists('question', $_POST)){
        $question_id = $_POST['question'];
        $question_name = $_POST['questionName'];
    }
    else
    {
        $question_id = null;
        $question_name = null;
    }

    if (array_key_exists('answer', $_POST)){
        $answer_id = $_POST['answer'];
        $answer_name = $_POST['answerName'];
    }
    else
    {
        $answer_id = null;
        $answer_name = null;
    }

    if (array_key_exists('fakeanswer', $_POST)){
        $fake_answer_id = $_POST['fakeanswer'];
        $fake_answer_name = $_POST['fakeanswerName'];
    }
    else
    {
        $fake_answer_id = null;
        $fake_answer_name = null;
    }

    try 
    {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
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
    <link rel="stylesheet" href="../css/admin.css">
    <title>Document</title>
</head>
<body>
    <div class="popup-container" id="popup-container" style="display: none;">
        <div class="popup">
            <div class="popup-form-container">
                <form action="../admin/admin add challenge.php" method="post" id="challenge-remove-form" style="display: none;">
                    <label>Are you sure you want to remove this challenge and ALL its associated questions and answers?</label>
                    <input type="text" name="challengeId" id="remove-c-challengeId" style="display: none;">
                    <div class="popup-buttons">
                        <input type="submit" value="Remove" class="popup-button" id="remove-button">
                    </div>
                    <input type="text" value="REMOVE" style="display: none;" name="action">
                </form>

                <form action="../admin/admin add question.php" method="post" id="question-remove-form" style="display: none;">
                    <label>Are you sure you want to remove this question and ALL its associated answers?</label>
                    <input type="text" style="display: none;" name="challengeId" id="remove-q-challengeId">
                    <input type="text" style="display: none;" name="questionId" id="remove-q-questionId">
                    <input type="text" value="REMOVE" style="display: none;" name="action">
                    <div class="popup-buttons">
                        <input type="submit" value="Remove" class="popup-button" id="remove-button">
                    </div>
                </form>

                <form action="../admin/admin add answer.php" method="post" id="answer-remove-form" style="display: none;">
                    <label>Are you sure you want to remove this answer?</label>
                    <input type="text" name="answerId" style="display: none;" id="remove-a-answerId">
                    <input type="text" value="REMOVE" style="display: none;" name="action">
                    <input type="text" style="display: none;" name="answerType" value="real">
                    <div class="popup-buttons">
                        <input type="submit" value="Remove" class="popup-button" id="remove-button">
                    </div>
                </form>

                <form action="../admin/admin add answer.php" method="post" id="fakeanswer-remove-form" style="display: none;">
                    <label>Are you sure you want to remove this fake answer?</label>
                    <input type="text" name="answerId" style="display: none;" id="remove-fa-answerId">
                    <input type="text" value="REMOVE" style="display: none;" name="action">
                    <input type="text" style="display: none;" name="answerType" value="fake">
                    <div class="popup-buttons">
                        <input type="submit" value="Remove" class="popup-button" id="remove-button">
                    </div>
                </form>

                <form action="../admin/admin upload image.php" method="post" id="challenge-upload-image" style="display: none;" enctype="multipart/form-data">
                    <label>Upload an image to be used as the challenge thumbnail.</label>
                    <input type="file" name="imageName">
                    <input type="text" name="challengeId" style="display: none;" id="upload-challengeId">
                    <div class="popup-buttons">
                        <input type="submit" value="Upload" class="popup-button" id="remove-button">
                    </div>
                </form>

                <div class="popup-buttons">
                    <button class="popup-button" onclick="closePopup()">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php include("../templates/header.php"); ?>

    <div class="container">

        <div class="admin-buttons">
            <button onclick="addChallenge()">Create new challenge</button>
        </div>

        <div class="show-tables" id="show-tables">
            <div>
                <table>
                    <tr>
                        <th class="id-column">Challenge ID</th>
                        <th class="contents-column">Name</th>
                        <th class="edit-column"></th>
                        <th class="remove-column"></th>
                        <th class="other-column"></th>
                        <th class="other-column"></th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($challenges)) {
                        $c_id = $row['id'];
                        $c_name = $row['name']; ?>
                            <tr>
                            <td><?php echo $c_id ?></td>
                            <td><?php echo $c_name ?></td>
                            <td>
                                <form action="admin home.php" method="post">
                                    <input type="text" <?php echo "value=\"$c_id\"" ?> style="display: none;" name="challenge">
                                    <input type="text" <?php echo "value=\"$c_name\"" ?> style="display: none;" name="challengeName">
                                    <input type="submit" value="Edit">
                                </form>
                            </td>
                            <td>
                                <button onclick="removeChallenge(<?php echo $c_id; ?>)">Remove</button>
                            </td>
                            <td>
                                <button onclick="addQuestion(<?php echo $c_id; ?>)">Add question</button>
                            </td>
                            <td>
                                <button onclick="addChallengeImage(<?php echo $c_id; ?>)">Upload image</button>
                            </td>
                            </tr>
                    <?php } ?>
                </table>

                <!-- Show selected challenge's questions -->
                <?php if ($challenge_id != null) {
                    $questions = mysqli_query($conn, "SELECT * FROM `questions` WHERE challengeId='$challenge_id'");
                ?>
                    <!-- Change challenge name -->
                    <form action="../admin/updatetables.php" method="post" class="change-form">
                        <label>Challenge Name: </label>
                        <input type="text" name="challengeId" <?php echo "value=\"$challenge_id\"" ?> style="display: none;" >
                        <input type="text" name="challengeTitle" <?php echo "value=\"$challenge_name\"" ?> required>
                        <input type="submit" value="Change">
                    </form>

                    <table>
                        <tr>
                            <th class="id-column">Question ID</th>
                            <th class="contents-column">Question</th>
                            <th class="edit-column"></th>
                            <th class="remove-column"></th>
                            <th class="other-column"></th>
                            <th class="other-column"></th>
                        </tr>
                        <?php while ($row = mysqli_fetch_array($questions)){
                            $q_id = $row['id'];
                            $q = $row['question']; ?>
                            <tr>
                                <td><?php echo $q_id ?></td>
                                <td><?php echo $q ?></td>
                                <td>
                                    <!-- Show this questions answers and fake answers -->
                                    <form action="admin home.php" method="post">
                                        <input type="text" <?php echo "value=\"$challenge_id\"" ?> style="display: none;" name="challenge">
                                        <input type="text" <?php echo "value=\"$challenge_name\"" ?> style="display: none;" name="challengeName">
                                        <input type="text" <?php echo "value=\"$q_id\"" ?> style="display: none;" name="question">
                                        <input type="text" <?php echo "value=\"$q\"" ?> style="display: none;" name="questionName">
                                        <input type="submit" value="Edit">
                                    </form>
                                </td>
                                <td>
                                    <!-- Remove this question and all associated answers and fake answers -->
                                    <button onclick="removeQuestion(<?php echo $challenge_id . ', ' . $q_id; ?>)">Remove</button>
                                </td>
                                <td>
                                    <!-- Add new answer -->
                                    <button onclick="addAnswer(<?php echo $challenge_id . ', ' . $q_id; ?>, 'real')">Add answer</button>
                                </td>
                                <td>
                                    <!-- Add new fake answer -->
                                    <button onclick="addAnswer(<?php echo $challenge_id . ', ' . $q_id; ?>, 'fake')">Add fake answer</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } ?>

                <?php if ($question_id != null) {
                    $answers = mysqli_query($conn, "SELECT * FROM `answers` WHERE challengeId='$challenge_id' AND questionId='$question_id'");
                    $fakeanswers = mysqli_query($conn, "SELECT * FROM `fakeanswers` WHERE challengeId='$challenge_id' AND questionId='$question_id'");
                ?>
                    <!-- Change question name -->
                    <form action="../admin/updatetables.php" method="post" class="change-form">
                        <label>Question: </label>
                        <input type="text" name="questionId" <?php echo "value=\"$question_id\"" ?> style="display: none;">
                        <input type="text" name="questionTitle" <?php echo "value=\"$question_name\"" ?> required>
                        <input type="submit" value="Change">
                    </form>

                    <table>
                        <tr>
                            <th class="id-column">Answers ID</th>
                            <th class="contents-column">Answer</th>
                            <th class="edit-column"></th>
                            <th class="remove-column"></th>
                            <th class="other-column"></th>
                            <th class="other-column"></th>
                        </tr>
                        <?php while ($row = mysqli_fetch_array($answers)){
                            $a_id = $row['id'];
                            $a = $row['answer']; ?>
                            <tr>
                                <td><?php echo $a_id; ?></td>
                                <td><?php echo $a; ?></td>
                                <td>
                                    <!-- Edit answer -->
                                    <form action="admin home.php" method="post">
                                        <input type="text" <?php echo "value=\"$challenge_id\"" ?> style="display: none;" name="challenge">
                                        <input type="text" <?php echo "value=\"$challenge_name\"" ?> style="display: none;" name="challengeName">
                                        <input type="text" <?php echo "value=\"$question_id\"" ?> style="display: none;" name="question">
                                        <input type="text" <?php echo "value=\"$question_name\"" ?> style="display: none;" name="questionName">
                                        <input type="text" <?php echo "value=\"$a_id\"" ?> style="display: none;" name="answer">
                                        <input type="text" <?php echo "value=\"$a\"" ?> style="display: none;" name="answerName">
                                        <input type="submit" value="Edit">
                                    </form>
                                </td>
                                <td>
                                    <!-- Remove Answer -->
                                    <button onclick="removeAnswer(<?php echo $a_id; ?>)">Remove</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <table>
                        <tr>
                            <th class="id-column">Fake Answers ID</th>
                            <th class="contents-column">Fake Answers</th>
                            <th class="edit-column"></th>
                            <th class="remove-column"></th>
                            <th class="other-column"></th>
                            <th class="other-column"></th>
                        </tr>
                        <?php while ($row = mysqli_fetch_array($fakeanswers)){
                            $fa_id = $row['id'];
                            $fa = $row['fakeanswers']; ?>
                            <tr>
                                <td><?php echo $fa_id ?></td>
                                <td><?php echo $fa ?></td>
                                <td>
                                    <!-- Edit fake answer -->
                                    <form action="admin home.php" method="post">
                                        <input type="text" <?php echo "value=\"$challenge_id\"" ?> style="display: none;" name="challenge">
                                        <input type="text" <?php echo "value=\"$challenge_name\"" ?> style="display: none;" name="challengeName">
                                        <input type="text" <?php echo "value=\"$question_id\"" ?> style="display: none;" name="question">
                                        <input type="text" <?php echo "value=\"$question_name\"" ?> style="display: none;" name="questionName">
                                        <input type="text" <?php echo "value=\"$fa_id\"" ?> style="display: none;" name="fakeanswer">
                                        <input type="text" <?php echo "value=\"$fa\"" ?> style="display: none;" name="fakeanswerName">
                                        <input type="submit" value="Edit">
                                    </form>
                                </td>
                                <td>
                                    <!-- Remove Answer -->
                                    <button onclick="removeFakeAnswer(<?php echo $fa_id; ?>)">Remove</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } ?>

                <?php if ($answer_id != null) { ?>
                    <!-- Change answer -->
                    <form action="../admin/updatetables.php" method="post" class="change-form">
                        <label>Answer: </label>
                        <input type="text" name="answerId" <?php echo "value=\"$answer_id\"" ?> style="display: none;">
                        <input type="text" name="answerTitle" <?php echo "value=\"$answer_name\"" ?> required>
                        <input type="submit" value="Change">
                    </form>
                <?php } ?>

                <?php if ($fake_answer_id != null) { ?>
                    <!-- Change fake answer -->
                    <form action="../admin/updatetables.php" method="post" class="change-form">
                        <label>Fake Answers (Seperated by ':'): </label>
                        <input type="text" name="fakeanswerId" <?php echo "value=\"$fake_answer_id\"" ?> style="display: none;">
                        <input type="text" name="fakeanswerTitle" <?php echo "value=\"$fake_answer_name\"" ?> required>
                        <input type="submit" value="Change">
                    </form>
                <?php } ?>
            </div>
        </div>

        <div class="add-container">
            <!-- Add new challenge -->
            <div class="add-sub-container" id="add-challenge" style="display: none;">
                <div>
                    <button onclick="backButton('show-tables', 'add-challenge')">Back</button>
                </div>
                    <form action="../admin/admin add challenge.php" method="post">
                        <label>New Challenge: </label>
                        <textarea rows="10" cols="30" name="challenge" required></textarea>
                        <input type="submit" value="Create">
                        <input type="text" value="ADD" style="display: none;" name="action">
                    </form>
            </div>

            <!-- Add new question section -->
            <div class="add-sub-container" id="add-question" style="display: none;">
                <div>
                    <button onclick="backButton('show-tables', 'add-question')">Back</button>
                </div>
                    <form action="../admin/admin add question.php" method="post">
                        <label>New Question: </label>
                        <textarea rows="10" cols="30" name="question" required></textarea>
                        <input type="submit" value="Add">
                        <input type="text" id="q-challengeId" name="challengeId" style="display: none;">
                        <input type="text" value="ADD" style="display: none;" name="action">
                    </form>
            </div>

            <!-- Add new answer section -->
            <div class="add-sub-container" id="add-answer" style="display: none;">
                <div>
                    <button onclick="backButton('show-tables', 'add-answer')">Back</button>
                </div>
                    <form action="../admin/admin add answer.php" method="post">
                        <label>New Answer: </label>
                        <textarea rows="10" cols="30" name="answer" required></textarea>
                        <input type="submit" value="Add">
                        <input type="text" id="a-challengeId" name="challengeId" style="display: none;">
                        <input type="text" id="a-questionId" name="questionId" style="display: none;">
                        <input type="text" value="ADD" style="display: none;" name="action">
                        <input type="text" style="display: none;" id="answerType" name="answerType">
                    </form>
            </div>
        </div>
    </div>

</body>

<script>
    function addChallenge(){
        document.getElementById("show-tables").style.display = "none";
        document.getElementById("add-challenge").style.display = "block";

        document.getElementById("add-question").style.display = "none";
        document.getElementById("add-answer").style.display = "none";
    }

    function addQuestion(challengeId){
        document.getElementById("show-tables").style.display = "none";
        document.getElementById("add-question").style.display = "block";
        document.getElementById("q-challengeId").value = challengeId;
    }

    function addAnswer(challengeId, questionId, type){
        document.getElementById("show-tables").style.display = "none";
        document.getElementById("add-answer").style.display = "block";
        document.getElementById("a-challengeId").value = challengeId;
        document.getElementById("a-questionId").value = questionId;
        document.getElementById("answerType").value = type;
    }

    function backButton(backTo, current){
        document.getElementById(current).style.display = "none";
        document.getElementById(backTo).style.display = "block";
    }

    function closePopup(){
        document.getElementById("popup-container").style.display = "none";
        document.getElementById("challenge-remove-form").style.display = "none";
        document.getElementById("question-remove-form").style.display = "none";
        document.getElementById("answer-remove-form").style.display = "none";
        document.getElementById("fakeanswer-remove-form").style.display = "none";
        document.getElementById("challenge-upload-image").style.display = "none";
    }

    function openPopup(){
        document.getElementById("popup-container").style.display = "block";
    }

    function removeChallenge(id){
        openPopup();

        document.getElementById("challenge-remove-form").style.display = "block";
        document.getElementById("remove-c-challengeId").value = id;
    }

    function removeQuestion(cId, qId){
        openPopup();

        document.getElementById("question-remove-form").style.display = "block";
        document.getElementById("remove-q-challengeId").value = cId;
        document.getElementById("remove-q-questionId").value = qId;
    }

    function removeAnswer(aId){
        openPopup();

        document.getElementById("answer-remove-form").style.display = "block";
        document.getElementById("remove-a-answerId").value = aId;
    }

    function removeFakeAnswer(aId){
        openPopup();

        document.getElementById("fakeanswer-remove-form").style.display = "block";
        document.getElementById("remove-fa-answerId").value = aId;
    }

    function addChallengeImage(cId){
        openPopup();
        document.getElementById("challenge-upload-image").style.display = "block";
        document.getElementById("upload-challengeId").value = cId;
    }

</script>
</html>