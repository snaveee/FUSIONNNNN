<?php
    require_once("data/db.php");
    session_start();
    session_regenerate_id();

    $studentID = $_GET['studid'];

    $dbStatement = $db->prepare("SELECT * FROM students WHERE studid = :studentID");
    $dbStatement->execute(['studentID' => $studentID]);
    $student = $dbStatement->fetch();
?>
<h1>Student Update</h1>
<span>
    <?php echo $_SESSION['messages']['updateSuccess'] ?? null; ?>
    <?php echo $_SESSION['messages']['updateError'] ?? null; ?>
</span>
<form action="index.php?section=student&page=processStudentDataChanges" method="post">
    <table>
        <tr>
            <td style="width: 10em;">Student ID:</td>
            <td style="width: 30em;"><input type="text" id="studentID" name="studentID" value="<?php echo $student['studid']; ?>" readonly class="data-input"></td>
        </tr>
        <tr>
            <td>Student Last Name:</td>
            <td><input type="text" id="studentLastName" name="studentLastName" value="<?php echo $student['studlastname']; ?>" class="data-input"></td>
            <td>
                <span>
                    <?php echo $_SESSION['errors']['studentLastName'] ?? null; ?>
                </span>
            </td>                
        </tr>
        <tr>
            <td>Student First Name:</td>
            <td><input type="text" id="studentFirstName" name="studentFirstName" value="<?php echo $student['studfirstname']; ?>" class="data-input"></td>
            <td>
                <span>
                    <?php echo $_SESSION['errors']['studentFirstName'] ?? null; ?>
                </span>
            </td>                
        </tr>

        <!-- <tr>
            <td>Student Program ID:</td>
            <td><input type="text" id="studentProgramID" name="studentProgramID" value="<?php //  echo $student['studprogid']; ?>" class="data-input"></td>
            <td>
                <span>
                    <?php // echo $_SESSION['errors']['studentProgramID'] ?? null; ?>
                </span>
            </td>                
        </tr> -->

        <!-- <tr>
            <td>Student College ID:</td>
            <td><input type="text" id="studentCollegeID" name="studentCollegeID" value="<?php // echo $student['studcollid']; ?>" class="data-input"></td>
            <td>
                <span>
                    <?php // echo $_SESSION['errors']['studentCollegeID'] ?? null; ?>
                </span>
            </td>                
        </tr> -->

        <!-- <tr>
            <td>Student Year Level:</td>
            <td><input type="text" id="studentYear" name="studentYear" value="<?php // echo $student['studyear']; ?>" class="data-input"></td>
            <td>
                <span>
                    <?php // echo $_SESSION['errors']['studentYear'] ?? null; ?>
                </span>
            </td>                
        </tr> -->

        <tr>
            <td colspan="2">
                <button type="submit" name="saveChanges" class="btn">
                    Update Student Entry
                </button>
                <button type="submit" name="clearChanges" class="btn">
                    Reset Form
                </button>
                <a href="index.php?section=student&page=studentList" class="btn btn-danger">
                    Exit
                </a>
            </td>
        </tr>
    </table>
</form>