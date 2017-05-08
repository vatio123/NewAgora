<?php

/**
 * MainController class
 * it controls all the server part of the application
 */
require_once "UserControllerClass.php";
//require_once "AnswerControllerClass.php";
require_once "QuestionControllerClass.php";
require_once "TopicControllerClass.php";
//require_once "ApplyControllerClass.php";

function is_session_started() {
    if (php_sapi_name() !== 'cli') {
        if (version_compare(phpversion(), '5.4.0', '>=')) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

if (is_session_started() === FALSE)
    session_start();

$outPutData = array();

if (isset($_REQUEST['controllerType'])) {
    $action = (int) $_REQUEST['controllerType'];
    switch ($action) {
        case 0:
            $userController = new UserControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
            $outPutData = $userController->doAction();
            break;
        case 1:
            $answerController = new AnswerControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
            $outPutData = $answerController->doAction();
            break;
        case 2:
            $questionController = new QuestionControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
            $outPutData = $questionController->doAction();
            break;
        case 3:
            $reportaController = new ReportaControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
            $outPutData = $reportaController->doAction();
            break;
        case 4:
            $reportqController = new ReportqControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
            $outPutData = $reportqController->doAction();
            break;
        case 5:
            $valorationaController = new ValorationaControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
            $outPutData = $valorationaController->doAction();
            break;
        case 6:
            $valorationqController = new ValorationqControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
            $outPutData = $valorationqController->doAction();
            break;
        case 7:
            $topicController = new TopicControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
            $outPutData = $topicController->doAction();
            break;
        default:
            $errors = array();
            $outPutData[0] = false;
            $errors[] = "Sorry, there has been an error. Try later";
            $outPutData[] = $errors;
            error_log("MainControllerClass: action not correct, value: " . $_REQUEST['controllerType']);
            break;
    }
} else {
    $errors = array();
    $outPutData[0] = false;
    $errors[] = "Sorry, there has been an error. Try later";
    error_log("MainControllerClass: action does not exist");
    $outPutData[] = $errors;
}

echo json_encode($outPutData);
?>
