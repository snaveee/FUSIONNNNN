<?php
require_once("data/db.php");

session_start();
session_regenerate_id();

$entryURL = $_SERVER['HTTP_REFERER'];

if($_POST && isset($_POST['clearEntries'])) {
    $_SESSION['input']['studentID'] = null;
    $_SESSION['input']['studentLastName'] = null;
    $_SESSION['input']['studentFirstName'] = null;
    $_SESSION['input']['studentMiddleName'] = null;
    $_SESSION['input']['studentCollegeDepartmentID'] = null;
    $_SESSION['input']['studentProgramID'] = null;
    $_SESSION['input']['studentCollegeID'] = null;
    $_SESSION['input']['studentYear'] = null;
    $_SESSION['messages']['createSuccess'] = "";
    $_SESSION['messages']['createError'] = "";    

    $_SESSION['errors']['studentID'] = "";
    $_SESSION['errors']['studentLastName'] = "";
    $_SESSION['errors']['studentFirstName'] = "";
    $_SESSION['errors']['studentMiddleName'] = "";
    $_SESSION['errors']['studentCollegeDepartmentID'] = "";
    $_SESSION['errors']['studentProgramID'] = "";
    $_SESSION['errors']['studentCollegeID'] = "";
    $_SESSION['errors']['studentYear'] = "";

    header("Location: $entryURL", true, 301);
}

if($_POST && isset($_POST['saveNewStudentEntry'])) { 
    $studentID = $_POST['studentID'];
    $studentLastName = $_POST['studentLastName'];
    $studentFirstName = $_POST['studentFirstName'];
    $studentMiddleName = $_POST['studentMiddleName'];
    $studentCollegeDepartmentID = $_POST['studentCollegeDepartmentID'];
    $studentProgramID = $_POST['studentProgramID'];
    $studentCollegeID = $_POST['studentCollegeID'];
    $studentYear = $_POST['studentYear'];

    $_SESSION['input']['studentID'] = $studentID;
    $_SESSION['input']['studentLastName'] = $studentLastName;
    $_SESSION['input']['studentFirstName'] = $studentFirstName;
    $_SESSION['input']['studentMiddleName'] = $studentMiddleName;
    $_SESSION['input']['studentCollegeDepartmentID'] = $studentCollegeDepartmentID;
    $_SESSION['input']['studentProgramID'] = $studentProgramID;
    $_SESSION['input']['studentCollegeID'] = $studentCollegeID;
    $_SESSION['input']['studentYear'] = $studentYear;

    if(!$_SESSION['errors']) {
        $_SESSION['errors'] = [];
    }

    if(filter_input(INPUT_POST,'studentID', FILTER_VALIDATE_INT) === false) {
        $_SESSION['errors']['studentID'] = "Invalid ID entry or format";
    } else {
        $_SESSION['errors']['studentID'] = "";
    } 

    if(filter_input(INPUT_POST,'studentLastName', FILTER_VALIDATE_REGEXP, ["options"=>["regexp"=>"/^[A-z\s\-]+$/"]]) === false) {
        $_SESSION['errors']['studentLastName'] = "Invalid Last Name entry or format";
    } else {
        $_SESSION['errors']['studentLastName'] = "";
    }

    if(filter_input(INPUT_POST,'studentFirstName', FILTER_VALIDATE_REGEXP, ["options"=>["regexp"=>"/^[A-z\s\-]+$/"]]) === false) {
        $_SESSION['errors']['studentFirstName'] = "Invalid First Name entry or format";
    } else {
        $_SESSION['errors']['studentFirstName'] = "";
    }

    if(filter_input(INPUT_POST,'studentMiddleName', FILTER_VALIDATE_REGEXP, ["options"=>["regexp"=>"/^[A-z\s\-]+$/"]]) === false) {
        $_SESSION['errors']['studentMiddleName'] = "Invalid Middle Name entry or format";
    } else {
        $_SESSION['errors']['studentMiddleName'] = "";
    }

    if(filter_input(INPUT_POST,'studentCollegeDepartmentID', FILTER_VALIDATE_INT) === false) {
        $_SESSION['errors']['studentCollegeDepartmentID'] = "Invalid ID entry or format";
    } else {
        $_SESSION['errors']['studentCollegeDepartmentID'] = "";
    }

    if(filter_input(INPUT_POST,'studentProgramID', FILTER_VALIDATE_INT) === false) {
        $_SESSION['errors']['studentProgramID'] = "Invalid ID entry or format";
    } else {
        $_SESSION['errors']['studentProgramID'] = "";
    }

    if(filter_input(INPUT_POST,'studentCollegeID', FILTER_VALIDATE_INT) === false) {
        $_SESSION['errors']['studentCollegeID'] = "Invalid ID entry or format";
    } else {
        $_SESSION['errors']['studentCollegeID'] = "";
    }

    if(filter_input(INPUT_POST,'studentYear', FILTER_VALIDATE_INT) === false) {
        $_SESSION['errors']['studentYear'] = "Invalid ID entry or format";
    } else {
        $_SESSION['errors']['studentYear'] = "";
    }

    if(empty($_SESSION['errors']['studentID']) && empty($_SESSION['errors']['studentLastName']) && empty($_SESSION['errors']['studentFirstName']) &&
       empty($_SESSION['errors']['studentMiddleName']) &&  empty($_SESSION['errors']['studentCollegeDepartmentID']) && 
       empty($_SESSION['errors']['studentProgramID']) && empty($_SESSION['errors']['studentCollegeID']) && empty($_SESSION['errors']['studentYear'])) {
        $dbStatement = $db->prepare("INSERT INTO students (studid, studlastname, studfirstname, studmidname, studcolldeptid, studprogid, studcollid, studyear) 
                                     VALUES (:studid, :studlastname, :studfirstname, :studmidname, :studcolldeptid, :studprogid, :studcollid, :studyear)");
        $dbResult = $dbStatement->execute([
            'studid' => $studentID,
            'studlastname' => $studentLastName,
            'studfirstname' => $studentFirstName,
            'studmidname' => $studentMiddleName,
            'studcolldeptid' => $studentCollegeDepartmentID,
            'studprogid' => $studentProgramID,
            'studcollid' => $studentCollegeID,
            'studyear' => $studentYear
        ]);

        if($dbResult) {
            $_SESSION['messages']['createSuccess'] = "Student entry added successfully";
            $_SESSION['messages']['createError'] = "";
        } else {
            $_SESSION['messages']['createError'] = "Failed to add student entry";
            $_SESSION['messages']['createSuccess'] = "";
        }        

        header("Location: $entryURL", true, 301);
    } else {
        header("Location: $entryURL", true, 301);
    }
}

if($_POST && isset($_POST['confirmDelete'])) {
    $studentID = $_POST['studentID'];

    $dbStatement = $db->prepare('DELETE FROM students WHERE studid = ?');
    $dbResult = $dbStatement->execute([$studentID]);

    if($dbResult) {
        $_SESSION['messages']['updateSuccess'] = "Student entry deleted successfully";
        $_SESSION['messages']['updateError'] = "";

        $_SESSION['input']['studentID'] = null;
        $_SESSION['input']['studentLastName'] = null;
        $_SESSION['input']['studentFirstName'] = null;
        $_SESSION['input']['studentMiddleName'] = null;
        $_SESSION['input']['studentCollegeDepartmentID'] = null;
        $_SESSION['input']['studentProgramID'] = null;
        $_SESSION['input']['studentCollegeID'] = null;
        $_SESSION['input']['studentYear'] = null;
    } else {
        $_SESSION['messages']['updateError'] = "Failed to delete student entry";
        $_SESSION['messages']['updateSuccess'] = "";
    }
    header("Location: $entryURL", true, 301);
    exit;
}