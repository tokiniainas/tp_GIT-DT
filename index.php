<?php
include('include/fonction.php');
$sql ="select dep.dept_no, dep.dept_name  , empl.first_name, empl.last_name
from departments as dep
join dept_manager as man
on dep.dept_no = man.dept_no
join employees as empl
on man.emp_no = empl.emp_no 
where man.to_date='9999-01-01'";
$resultat=get_all_line($sql);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste des employés</h1>
    <table border="1">
    <tr>
        <th>Nom departement</th>
        <th>Prenom manager</th>
        <th>Nom manager</th>
    </tr>
    <?php foreach($resultat as $row) { ?>
    <tr>
        <td><a href="liste_employe.php?dept_no=<?= $row['dept_no'] ?>"><?php echo $row['dept_name']; ?></a></td>
        <td><?php echo $row['first_name']; ?></td>
        <td><?php echo $row['last_name'] ?></td>
    </tr>
    <?php } ?>
    </table>
</body>
</html>