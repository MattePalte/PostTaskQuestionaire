<?php

/*
Save a new answer in the sqlite database
save_answer(string: username, int: task_code, int: question_code, int: answer)
*/
function save_answer($username, $task_code, $question_code, $answer_score) {
    //echo "$username submitted an answer.<br>";
    $db = new SQLite3('answers.db');
    $stm = $db->prepare("INSERT INTO ANSWERS(Username, Task_Code, Question_Code, Answer_Score, 'Date') VALUES (?, ?, ?, ?, ?)");
    $today = date("Y-m-d H:i:s");  
    $stm->bindParam(1, $username);
    $stm->bindParam(2, $task_code);
    $stm->bindParam(3, $question_code);
    $stm->bindParam(4, $answer_score);
    $stm->bindParam(5, $today);
    $res = $stm->execute();
}


/*
Read from a csv file given task's description
*/
function get_task($task_index) {
    $file = fopen('tasks.csv', 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
        //$line[0] = '1004000018' in first iteration
        //print_r($line);
        $task_code = $line[0];
        $task_description = $line[1];
        if ($task_code == $task_index) {
            // task found 
            //echo "Code $task_code : $task_description <br>";
            break;
        }
    }
    fclose($file);
    return $task_description;
}

/*
Read from a csv file the next task
*/
function get_tasks_code_list() {
    $file = fopen('tasks.csv', 'r');
    $list_of_codes = array();
    while (($line = fgetcsv($file)) !== FALSE) {
        //$line[0] = '1004000018' in first iteration
        //print_r($line);
        $task_code = $line[0];
        array_push($list_of_codes, $task_code);
    }
    fclose($file);
    //print_r($list_of_codes);
    return $list_of_codes;
}

function get_next_index($task_index) {
    $list_of_codes = get_tasks_code_list();
    if (count($list_of_codes) > 0) {
        $i = 0;
        while ($i < count($list_of_codes) - 1) {
            $current_code = $list_of_codes[$i];
            $next_code = $list_of_codes[$i + 1];
            if ($current_code == $task_index) {
                //echo "NEXTTTT -> ".$next_code;
                return $next_code;
            }
            $i = $i + 1;
        }
        // return first element otherwise
        // this happen when we have finished the elements
        // so when we are at the last element
        echo "NEXTTTT $list_of_codes[0] -> ".$list_of_codes[0];
        return $list_of_codes[0];
    } 
}


?>