<?php 
include("include/fonction.php");
$sql="SELECT * FROM departments ORDER BY dept_name ASC";
$emp_no = $_GET['emp_no'] ?? '';
$resultat=get_all_line($sql);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
        <?php echo $_SESSION['dept_name']; ?>
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