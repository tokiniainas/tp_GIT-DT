<?php
include("include/fonction.php");

$emp_no    = $_GET['emp_no'];
$dept_no   = $_GET['dept_no'];
$from_date = $_GET['from_date'];

$get_date = get_date_departement($emp_no);
$erreur = false;

if (!empty($get_date) && $from_date < $get_date['from_date']) {
    $erreur = true;
} else {
    $resultat = change_departement($emp_no, $dept_no, $from_date);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php if ($erreur): ?>
        <p style="color:red;">
            Erreur : la date de début du nouveau département ne peut pas être antérieure
            à la date de début du département actuel (<?= htmlspecialchars($get_date['from_date']) ?>).
        </p>
    <?php else: ?>
        <p>Le département de l'employé a bien été mis à jour.</p>
    <?php endif; ?>

    <a href="fiche.php?emp_no=<?= htmlspecialchars($emp_no) ?>">Retour à la fiche employé</a>
</body>
</html>