<?php
include("include/fonction.php");
$emp_no = $_GET['emp_no'];
$dept_no   = $_GET['dept_no'];
$from_date=$_GET['from_date'];
$name=$_GET['dept_name'];
$resultat = change_departement($emp_no, $dept_no, $from_date);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

     <p>Le département de l'employé a bien été mis à jour.</p>
    <a href="fiche.php?emp_no=<?= htmlspecialchars($emp_no) ?>">Retour à la fiche employé</a>
</body>
</html>