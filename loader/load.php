<?php

$page = 'home/home';

if(isset($_GET['section'])) {
    $section = $_GET['section'];
}

if(isset($_GET['page'])) {
    $page = $_GET['page'];
}

$allowed_pages = [
    'schoolList',
    'departmentList',
    'programList',
    'studentList',
    'studentAdd',
    'studentUpdate',
    'studentDelete',
    'processStudentData',
    'processStudentDataChanges',
    'schoolCreate',
    'schoolUpdate',
    'schoolDelete',
    'processSchoolData',
    'processDataChanges',
    'chooseSchool',
    'chooseSchoolDepProg',
    'processSchoolChoice',
    'processSchoolDepProgChoice',
    '500',
    '404',
];

if(in_array($page, $allowed_pages)) {
    if(file_exists("{$section}/{$page}.php")) {
        $file = "{$section}/{$page}.php";
    } else {
        $file = "404/404.php";
    }
} else {
    $file = "home/home.php";
}


require_once $file;