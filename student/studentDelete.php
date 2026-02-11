<?php
    require_once("data/db.php");
    session_start();
    session_regenerate_id();

    $studentID = $_GET['studid'];

    if($studentID) {
        $dbStatement = $db->prepare("SELECT * FROM students WHERE studid = :studentID");
        $dbStatement->execute(['studentID' => $studentID]);
        $student = $dbStatement->fetch();
    }
?>

<h1>Delete Student</h1>

<span>
    <?php echo $_SESSION['messages']['updateSuccess'] ?? null; ?>
    <?php echo $_SESSION['messages']['updateError'] ?? null; ?>
</span>

<?php if (!empty($_SESSION['messages']['updateSuccess'])): ?>
    <a href="index.php?section=student&page=studentList" class="btn btn-primary">Back to Student List</a>
<?php else: ?>

<form action="index.php?section=student&page=processStudentData" method="post">
    <table>
        <tr>
            <td style="width: 10em;">Student ID:</td>
            <td style="width: 30em;"><input type="text" id="studentID" name="studentID" value="<?php echo $student['studid']; ?>" readonly class="data-input"></td>
        </tr>
        <tr>
            <td>Student Last Name:</td>
            <td><input type="text" id="studentLastName" name="studentLastName" value="<?php echo $student['studlastname']; ?>" readonly class="data-input"></td>
            <td>
                <span>
                    <?php echo $_SESSION['errors']['studentLastName'] ?? null; ?>
                </span>
            </td>                
        </tr>
        <tr>
            <td>Student First Name:</td>
            <td><input type="text" id="studentFirstName" name="studentFirstName" value="<?php echo $student['studfirstname']; ?>" readonly class="data-input"></td>
            <td>
                <span>
                    <?php echo $_SESSION['errors']['studentFirstName'] ?? null; ?>
                </span>
            </td>                
        </tr>
        <tr>
            <td colspan="2">
                <a href="index.php?section=student&page=studentList" class="btn btn-primary">
                    Cancel Operation
                </a>                
                <button type="submit" name="confirmDelete" class="btn btn-danger">
                    Confirm Operation
                </button>
            </td>
        </tr>
    </table>
    <?php endif ?>
</form>