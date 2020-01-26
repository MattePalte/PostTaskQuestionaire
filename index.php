<?php
require('utils.php');

// if no session, create one
//if (!isset($_SESSION)) {
    session_start(); // start up your PHP session!
//}

if (!isset($_SESSION['username'])) {
    // first login, no username in the memory
    if (isset($_POST["username"]) && trim($_POST["username"]) != "") {
        // someone has just post a new username.. perfect save it and use it!
        $_SESSION['username'] = $_POST["username"];
        $list_of_codes = get_tasks_code_list();
        $_SESSION['current_task'] = $list_of_codes[0];
        $username = $_POST["username"];
        $current_task = $_SESSION['current_task'];
        $valid_user = True;
    } else {
        // noone post anything... unknown user has to be display :(
        $username = "Unknown";
        $valid_user = False;
    }
} else {
    // username already in the session memory, perfect! use it!
    $username = $_SESSION['username'];
    $current_task = $_SESSION['current_task'];
    $valid_user = True;
}


if ($valid_user) {
    // check if the answers are answered
    if (isset($_POST["question_1"]) && isset($_POST["question_2"]) && isset($_POST["question_3"])) {
        $task_code = $current_task;
        // question 1
        $question_code = 1;
        $answer_score = $_POST["question_1"];
        save_answer($username, $task_code, $question_code, $answer_score);
        // question 2
        $question_code = 2;
        $answer_score = $_POST["question_2"];
        save_answer($username, $task_code, $question_code, $answer_score);
        // question 3
        $question_code = 3;
        $answer_score = $_POST["question_3"];
        save_answer($username, $task_code, $question_code, $answer_score);
        // get next index
        $_SESSION['current_task'] = get_next_index($current_task);
        $current_task = $_SESSION['current_task'];
        $show_warning_answer_all = False;
    } else {
        $show_warning_answer_all = True;
    }
}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<title>Post Task Questionaire</title>
</head>
<body>
<iframe style="height: 70%; width: 100%" src="https://www.energenious.eu/"></iframe>
<div class="container">
    <?php if ($valid_user) { ?>
        <form action="logout.php" method="post">
        <h5 style="color: green;">Logged in as (scroll down to see the questions): <?php echo $username; ?> <input type="submit" value="Logout" class="button"> </h5>
        </form><?php }?>
    <form action="index.php" method="post">
        <?php if (!$valid_user) { ?>
            <br>
            <label for="username">Insert your username please: </label>
            <input id="username"  type="text" name="username">
            <h5 style="color: red;">Please insert your name and press Enter.</h5>
        <?php } else { ?>
            <h1> Task (code  <?php echo $current_task; ?>) : <?php echo get_task($current_task); ?> </h1>
            

            <?php if ( isset($show_warning_answer_all) && $show_warning_answer_all) { ?>
                <h5 style="color: red;">Please answer to all questions related to the task</h5>
            <?php } ?>
			<div id="questions">
            <table style="width:100%">
            <tr>
                <th align="left">Question</th>
                <th align="left">(strongly disagree)</th>
                <th align="left">1</th>
                <th align="left">2</th>
                <th align="left">3</th>
                <th align="left">4</th>
                <th align="left">5</th>
                <th align="left">6</th>
                <th align="left">7</th>
                <th align="left">(strongly agree)</th>
            </tr>
            <tr>
                <td>Overall, I am satisfied with the <b>ease of completing</b> the task</td>
                <td></td>
                <td><input type="radio" name="question_1" value="1"></td>
                <td><input type="radio" name="question_1" value="2"></td>
                <td><input type="radio" name="question_1" value="3"></td>
                <td><input type="radio" name="question_1" value="4"></td>
                <td><input type="radio" name="question_1" value="5"></td>
                <td><input type="radio" name="question_1" value="6"></td>
                <td><input type="radio" name="question_1" value="7"></td>
                <td></td>
            </tr>
            <tr>
                <td>Overall, I am satisfied with the <b>amount of time it took</b> to complete the task</td>
                <td></td>
                <td><input type="radio" name="question_2" value="1"></td>
                <td><input type="radio" name="question_2" value="2"></td>
                <td><input type="radio" name="question_2" value="3"></td>
                <td><input type="radio" name="question_2" value="4"></td>
                <td><input type="radio" name="question_2" value="5"></td>
                <td><input type="radio" name="question_2" value="6"></td>
                <td><input type="radio" name="question_2" value="7"></td>
                <td></td>
            </tr>
            <tr>
                <td>Overall, I am satisfied with the <b>support information</b> (online help, messages, documentation) when completing the task</td>
                <td></td>
                <td><input type="radio" name="question_3" value="1"></td>
                <td><input type="radio" name="question_3" value="2"></td>
                <td><input type="radio" name="question_3" value="3"></td>
                <td><input type="radio" name="question_3" value="4"></td>
                <td><input type="radio" name="question_3" value="5"></td>
                <td><input type="radio" name="question_3" value="6"></td>
                <td><input type="radio" name="question_3" value="7"></td>
                <td></td>
            </tr>
            </table>
			</div>
            
            <br><input type="submit" value="Submit" class="button">
        <?php } ?>
        
    </form>

<div>
</body>
</html>