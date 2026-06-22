<?php 
include("include/fonction.php");
$sql="SELECT * FROM departments ORDER BY dept_name ASC";
$emp_no = $_GET['emp_no'] ?? '';
$resultat=get_all_line($sql);

    $sql = "
        SELECT d.dept_name 
        FROM dept_emp as de
        JOIN departments as d ON de.dept_no = d.dept_no
        WHERE de.emp_no='%s' 
    ";
    $sql = sprintf($sql, $emp_no);

    $get_id=get_one_line($sql);
    $get_date=get_date_departement($emp_no);
    

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <?php echo $get_id['dept_name']; ?>
    <?php echo $get_date['from_date']; ?>
    <form action="affiche_departement.php" method="GET">
        <input type="hidden" name="emp_no" value="<?= htmlspecialchars($emp_no) ?>">
    <p>
    <select name="dept_no" id="dept_no">
        <?php foreach($resultat as $row): ?>
            <option value="<?= $row['dept_no'] ?>"><?= htmlspecialchars($row['dept_name']) ?></option>
        <?php endforeach; ?>
    </select>

    Date de début
    <input type="date" name="from_date" id="from_date">
    <input type="submit" value="envoyer">
    </p>
        </form>
</body>
</html>