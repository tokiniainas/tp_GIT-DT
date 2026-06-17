<?php
include("include/fonction.php");
$nb_employes = get_all_line("
SELECT gender, COUNT(*) AS nombre_employes
FROM employees
GROUP BY gender;");

$salaire_moyen_employe = get_all_line("
SELECT t.title, ROUND(AVG(s.salary), 2) AS salaire_moyen
FROM titles AS t
JOIN salaries AS s ON t.emp_no = s.emp_no
GROUP BY t.title
ORDER BY salaire_moyen DESC;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <title>Statistiques employés</title>
    <style>body{background-color:#f5f6f8;}.result-card{border:none;border-radius:0.75rem;box-shadow:0 0.25rem 1rem rgba(0,0,0,0.06);}.table thead th{background-color:#212529;color:#fff;font-weight:500;border:none;}.table tbody tr:hover{background-color:#f1f3f5;}</style>
</head>
<body>
    <div class="container py-5">

        <div class="card result-card mb-4">
            <div class="card-body p-4">
                <h5 class="mb-3"><i class="bi bi-people"></i> Nombre d'employés par genre</h5>
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Genre</th>
                            <th>Nombre d'employés</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nb_employes as $row) { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['gender']) ?></td>
                                <td><?= htmlspecialchars($row['nombre_employes']) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card result-card">
            <div class="card-body p-4">
                <h5 class="mb-3"><i class="bi bi-cash-stack"></i> Salaire moyen par emploi</h5>
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Emploi</th>
                            <th>Salaire moyen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salaire_moyen_employe as $row) { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['title']) ?></td>
                                <td><?= htmlspecialchars($row['salaire_moyen']) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>