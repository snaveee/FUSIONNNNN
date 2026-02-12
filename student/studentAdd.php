<?php
    session_start();
    session_regenerate_id();
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Create</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body> -->
    <h1>Student Add</h1>
    <span>
        <?php echo $_SESSION['messages']['createSuccess'] ?? null; ?>
        <?php echo $_SESSION['messages']['createError'] ?? null; ?>
    </span>

    <form action="index.php?section=student&page=processStudentData" method="post">
        <table>
            <tr>
                <td style="width: 10em;">Student ID:</td>
                <td style="width: 30em;"><input type="text" id="studentID" name="studentID" value="<?= $_SESSION['input']['studentID'] ?? null; ?>" class="data-input"></td>
                <td>
                    <span>
                        <?php echo $_SESSION['errors']['studentID'] ?? null; ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>Student Last Name:</td>
                <td><input type="text" id="studentLastName" name="studentLastName" value="<?= $_SESSION['input']['studentLastName'] ?? null; ?>" class="data-input"></td>
                <td>
                    <span>
                        <?php echo $_SESSION['errors']['studentLastName'] ?? null; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td>Student First Name:</td>
                <td><input type="text" id="studentFirstName" name="studentFirstName" value="<?= $_SESSION['input']['studentFirstName'] ?? null; ?>" class="data-input"></td>
                <td>
                    <span>
                        <?php echo $_SESSION['errors']['studentFirstName'] ?? null; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td>Student Middle Name:</td>
                <td><input type="text" id="studentMiddleName" name="studentMiddleName" value="<?= $_SESSION['input']['studentMiddleName'] ?? null; ?>" class="data-input"></td>
                <td>
                    <span>
                        <?php echo $_SESSION['errors']['studentMiddleName'] ?? null; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="width: 10em;">Student College Department ID:</td>
                <td style="width: 30em;"><input type="text" id="studentCollegeDepartmentID" name="studentCollegeDepartmentID" value="<?= $_SESSION['input']['studentCollegeDepartmentID'] ?? null; ?>" class="data-input"></td>
                <td>
                    <span>
                        <?php echo $_SESSION['errors']['studentCollegeDepartmentID'] ?? null; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="width: 10em;">Student Program ID:</td>
                <td style="width: 30em;"><input type="text" id="studentProgramID" name="studentProgramID" value="<?= $_SESSION['input']['studentProgramID'] ?? null; ?>" class="data-input"></td>
                <td>
                    <span>
                        <?php echo $_SESSION['errors']['studentProgramID'] ?? null; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="width: 10em;">Student College ID:</td>
                <td style="width: 30em;"><input type="text" id="studentCollegeID" name="studentCollegeID" value="<?= $_SESSION['input']['studentCollegeID'] ?? null; ?>" class="data-input"></td>
                <td>
                    <span>
                        <?php echo $_SESSION['errors']['studentCollegeID'] ?? null; ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td style="width: 10em;">Student Year:</td>
                <td style="width: 30em;"><input type="text" id="studentYear" name="studentYear" value="<?= $_SESSION['input']['studentYear'] ?? null; ?>" class="data-input"></td>
                <td>
                    <span>
                        <?php echo $_SESSION['errors']['studentYear'] ?? null; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" name="saveNewStudentEntry" class="btn">
                        Save New Student Entry
                    </button>
                    <button type="submit" name="clearEntries" class="btn">
                        Reset Form
                    </button>
                    <a href="index.php?section=student&page=studentList" class="btn btn-danger">
                        Exit
                    </a>
                </td>
            </tr>
        </table>
    </form>