<?php
include('include/fonction.php');
$sql ="select dep.dept_no, dep.dept_name, empl.first_name, empl.last_name,
    (select count(*) from dept_emp as de where de.dept_no = dep.dept_no and de.to_date='9999-01-01') as nb_employes
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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <title>Liste des employés</title>
</head>
<body class="bg-light">
    <div class="container py-5">
        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h4 fw-semibold mb-0">
                <i class="bi bi-people-fill text-secondary me-2"></i>Liste des employés
                <br>
                <a href="recherche.php">RECHERCHE</a>
            </h1>
            <h1 class="h4 fw-semibold mb-0">

                <a  href="nb-employes.php">Nombre d'employés</a>
            </h1>
            <p class="text-muted small mb-0">Départements et responsables</p>
        </div>
        <span class="badge bg-primary rounded-pill">
            <?= count($resultat) ?> département<?= count($resultat) > 1 ? 's' : '' ?>
        </span>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-uppercase text-muted small fw-semibold ps-4">
                            <i class="bi bi-building me-1"></i>Département
                        </th>
                        <th class="text-uppercase text-muted small fw-semibold">
                            <i class="bi bi-person me-1"></i>Prénom manager
                        </th>
                        <th class="text-uppercase text-muted small fw-semibold">
                            Nom manager
                        </th>
                        <th class="text-uppercase text-muted small fw-semibold">
                            Nombre employé
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultat as $row): ?>
                    <tr>
                        <td class="ps-4">
                            <a href="liste_employe.php?dept_no=<?= htmlspecialchars($row['dept_no']) ?>"
                            class="text-decoration-none fw-semibold">
                                <?= htmlspecialchars($row['dept_name']) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($row['first_name']) ?></td>
                        <td><?= htmlspecialchars($row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['nb_employes']) ?></td>
                        <td></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>