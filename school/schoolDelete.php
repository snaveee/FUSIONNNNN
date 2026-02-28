<?php
    require_once("data/db.php");
    session_start();
    session_regenerate_id();

    $schoolID = $_GET['collid'];

    $dbStatement = $db->prepare("SELECT * FROM colleges WHERE collid = :schoolID");
    $dbStatement->execute(['schoolID' => $schoolID]);
    $school = $dbStatement->fetch();
?>
<h1>School Delete</h1>

<span class="success-message">
    <?php echo $_SESSION['messages']['updateSuccess'] ?? null; ?>
</span>
<span class="error-message">
    <?php echo $_SESSION['messages']['updateError'] ?? null; ?>
    <?php echo $_SESSION['errors']['deleteError'] ?? null; ?>
</span>
<form action="index.php?section=school&page=processDataChanges" method="post">
    <table>
        <tr>
            <td style="width: 10em;">School ID:</td>
            <td style="width: 30em;"><input type="text" id="schoolID" name="schoolID" value="<?php echo $school['collid']; ?>" readonly class="data-input"></td>
        </tr>
        <tr>
            <td>School Full Name:</td>
            <td><input type="text" id="schoolFullName" name="schoolFullName" value="<?php echo $school['collfullname']; ?>" readonly class="data-input"></td>
            <td>
                <span>
                    <?php echo $_SESSION['errors']['schoolFullName'] ?? null; ?>
                </span>
            </td>                
        </tr>
        <tr>
            <td>School Short Name:</td>
            <td><input type="text" id="schoolShortName" name="schoolShortName" value="<?php echo $school['collshortname']; ?>" readonly class="data-input"></td>
            <td>
                <span>
                    <?php echo $_SESSION['errors']['schoolShortName'] ?? null; ?>
                </span>
            </td>                
        </tr>
        <?php if(isset($_SESSION['confirmDelete']) && $_SESSION['confirmDelete']): ?>
        <tr>
            <td colspan="3">
                <div class="confirmation-warning">
                    <h3 style="color: #f10a0a;">Are you sure?</h3>
                    <p>You are about to permanently delete the school "<strong><?php echo htmlspecialchars($school['collfullname']); ?></strong>". This action cannot be undone.</p>
                </div>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td colspan="2">
                <a href="index.php?section=school&page=schoolList" class="btn btn-primary">
                    Cancel Operation
                </a>
                <?php if(!isset($_SESSION['confirmDelete']) || !$_SESSION['confirmDelete']): ?>
                <button type="submit" name="confirmDelete" class="btn btn-danger">
                    Confirm Delete
                </button>

                <?php else: ?>
                <button type="submit" name="executeDelete" class="btn btn-danger">
                    Yes, Delete This School
                </button>
                <button type="button" onclick="location.href='index.php?section=school&page=schoolList'" class="btn btn-secondary">
                    Cancel
                </button>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</form>    
