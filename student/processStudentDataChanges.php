<?php
require_once("data/db.php");

session_start();
session_regenerate_id();

$entryURL = $_SERVER['HTTP_REFERER'];

if($_POST && isset($_POST['clearChanges'])) {
    $_SESSION['errors']['studentLastName'] = "";
    $_SESSION['errors']['studentFirstName'] = "";
    $_SESSION['messages']['updateSuccess'] = "";
    $_SESSION['messages']['updateError'] = "";

    header("Location: $entryURL", true, 301);
}

if($_POST && isset($_POST['saveChanges'])) {
    $studentID = $_POST['studentID'];
    $studentLastName = $_POST['studentLastName'];
    $studentFirstName = $_POST['studentFirstName'];
    $studentProgramID = $_POST['studentProgramID'];
    $studentCollegeID = $_POST['studentCollegeID'];
    $studentYear = $_POST['studentYear'];

    $_SESSION['input']['studentLastName'] = $studentLastName;
    $_SESSION['input']['studentFirstName'] = $studentFirstName;

    if(isset($_SESSION['errors'])) {
        $_SESSION['errors'] = [];
    }

    if(filter_input(INPUT_POST,'studentLastName', FILTER_VALIDATE_REGEXP, ["options"=>["regexp"=>"/^[A-z\s\-]+$/"]]) === false) {
        $_SESSION['errors']['studentLastName'] = "Invalid Last Name entry. Reverting to original value";
    } else {
        $_SESSION['errors']['studentLastName'] = "";
    }

    if(filter_input(INPUT_POST,'studentFirstName', FILTER_VALIDATE_REGEXP, ["options"=>["regexp"=>"/^[A-z\s\-]+$/"]]) === false) {
        $_SESSION['errors']['studentFirstName'] = "Invalid First Name entry. Reverting to original value";
    } else {
        $_SESSION['errors']['studentFirstName'] = "";
    }

    if(empty($_SESSION['errors']['studentLastName']) && empty($_SESSION['errors']['studentLastName'])) {
        
        $dbStatement = $db->prepare('UPDATE students SET studlastname = ?, studfirstname = ? WHERE studid = ?');
        $dbResult = $dbStatement->execute([
            $studentLastName,
            $studentFirstName,
            $studentID
        ]);

        if($dbResult) {
            $_SESSION['messages']['updateSuccess'] = "Student entry updated successfully";
            $_SESSION['messages']['updateError'] = "";
        } else {
            $_SESSION['messages']['updateError'] = "Failed to update student entry";
            $_SESSION['messages']['updateSuccess'] = "";
        }

        header("Location: $entryURL", true, 301);

    } else {
        header("Location: $entryURL", true, 301);
    }
}

?>