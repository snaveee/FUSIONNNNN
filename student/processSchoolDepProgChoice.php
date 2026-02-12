<?php

if($_POST) {
    $schoolID = $_POST['schoolID'] ?? null;
    $departmentID = $_POST['departmentID'] ?? null;
    $programID = $_POST['programID'] ?? null;

    $origin = $_SERVER['HTTP_REFERER'];

    if(isset($_POST['selectSchool'])) {
        if(empty($_POST['schoolID'])) {
            header("Location: index.php?section=student&page=chooseSchoolDepProg&errorSchool=Select+a+school+first.&stage=school", true, 301);
            exit;
        }

        header("Location: index.php?section=student&page=chooseSchoolDepProg&schoolID={$schoolID}&stage=school", true, 301);
        exit;
    } elseif(isset($_POST['selectDepartment'])) {
        if(empty($_POST['departmentID'])) {
            header("Location: index.php?section=student&page=chooseSchoolDepProg&schoolID={$schoolID}&departmentID={$departmentID}&errorDepartment=Select+a+department+first.&stage=department", true, 301);
            exit;
        }

        header("Location: index.php?section=student&page=chooseSchoolDepProg&schoolID={$schoolID}&departmentID={$departmentID}&stage=department", true, 301);
        exit;
    } elseif(isset($_POST['selectProgram'])) {
        if(empty($_POST['programID'])) {
            header("Location: index.php?section=student&page=chooseSchoolDepProg&schoolID={$schoolID}&departmentID={$departmentID}&errorProgram=Select+a+program+first&stage=program", true, 301);
            exit;
        }

        header("Location: index.php?section=student&page=studentList&progid={$programID}&stage=program", true, 301);
        exit;
    }   
}

?>