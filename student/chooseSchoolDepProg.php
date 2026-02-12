<?php
    require_once("data/db.php");
    session_start();
    session_destroy();

    $dbStatement = $db->prepare("SELECT * FROM colleges");
    $dbStatement->execute();
    $schools = $dbStatement->fetchAll();

    
    $dbStatement = $db->prepare("SELECT * FROM departments");
    $dbStatement->execute();
    $departments = $dbStatement->fetchAll();
    
    
    $dbStatement = $db->prepare("SELECT * FROM programs");
    $dbStatement->execute();
    $programs = $dbStatement->fetchAll();

?>

<h1>Student Section</h1>
<form action="index.php?section=student&page=processSchoolDepProgChoice" method="post">
    <table>
        <tr>
            <td>
                <select name="schoolID" id="schoolID" class="school-select">
                    <option value=null selected hidden disabled>Select School</option>
                    <?php foreach ($schools as $school): ?>
                    <option value="<?php echo $school['collid']; ?>"
                        <?php if(!empty($_GET['schoolID']) && $_GET['schoolID'] == $school['collid']) echo 'selected'; ?>>
                        <?php echo $school['collfullname']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="selectSchool" class="btn btn-primary">Select School</button>
                <?php if(!empty($_GET['errorSchool']) && ($_GET['stage'] ?? '') === 'school'): ?>
                <span style="color:red; margin-left:10px;"><?php echo htmlspecialchars($_GET['errorSchool']); ?></span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</form>

<form action="index.php?section=student&page=processSchoolDepProgChoice" method="post">
    <input type="hidden" name="schoolID" value="<?php echo htmlspecialchars($_GET['schoolID'] ?? ''); ?>">
    <table>
        <tr>
            <td>
                <select name="departmentID" id="departmentID" class="school-select"
                        <?php if(empty($_GET['schoolID'])) echo 'disabled'; ?>>
                    <option value=null selected hidden disabled>Select Department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?php echo $department['deptid']; ?>"
                            <?php if(!empty($_GET['departmentID']) && $_GET['departmentID'] == $department['deptid']) echo 'selected'; ?>>
                            <?php echo $department['deptfullname']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="selectDepartment" class="btn btn-primary"
                <?php if(empty($_GET['schoolID'])) echo 'disabled style="background-color:gray;"'; ?>>Select Department</button>
                <?php if(!empty($_GET['errorDepartment']) && ($_GET['stage'] ?? '') === 'department'): ?>
                <span style="color:red; margin-left:10px;"><?php echo htmlspecialchars($_GET['errorDepartment']); ?></span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</form>

<form action="index.php?section=student&page=processSchoolDepProgChoice" method="post">
    <input type="hidden" name="schoolID" value="<?php echo htmlspecialchars($_GET['schoolID'] ?? ''); ?>">
    <input type="hidden" name="departmentID" value="<?php echo htmlspecialchars($_GET['departmentID'] ?? ''); ?>">

    <table>
        <tr>
            <td>
                <select name="programID" id="programID" class="school-select"
                        <?php if(empty($_GET['departmentID'])) echo 'disabled'; ?>>
                    <option value=null selected hidden disabled>Select Program</option>
                    <?php foreach ($programs as $program): ?>
                        <option value="<?php echo $program['progid']; ?>"
                            <?php if(!empty($_GET['programID']) && $_GET['programID'] == $program['progid']) echo 'selected'; ?>>
                            <?php echo $program['progfullname']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="selectProgram" class="btn btn-primary"
                        <?php if(empty($_GET['departmentID'])) echo 'disabled style="background-color:gray;"'; ?>>Select Program</button>
                <?php if(!empty($_GET['errorProgram']) && ($_GET['stage'] ?? '') === 'program'): ?>
                <span style="color:red; margin-left:10px;"><?php echo htmlspecialchars($_GET['errorProgram']); ?></span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</form>