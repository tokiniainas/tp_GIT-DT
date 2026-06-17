<?php 
include('include/fonction.php');
$no = $_GET['dept_no'];

$resultat = get_employees_by_dept($no);
$emp = get_one_line("SELECT title, from_date, to_date, DATEDIFF(to_date, from_date) AS duree_jours
FROM titles
ORDER BY duree_jours DESC
LIMIT 1;");
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


<main class="container py-5">
    <?php if ($emp) { ?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex align-items-center justify-content-between">
        <div>
            <p class="text-uppercase text-muted small fw-semibold mb-1">
                <i class="bi bi-trophy me-1"></i>Poste occupé le plus longtemps
            </p>
            <h5 class="fw-semibold mb-0"><?= $emp['title'] ?></h5>
            <p class="text-muted small mb-0">
                Du <?= date('d/m/Y', strtotime($emp['from_date'])) ?>
                au <?= date('d/m/Y', strtotime($emp['to_date'])) ?>
            </p>
        </div>
        <span class="badge bg-success rounded-pill fs-6">
            <?= round($emp['duree_jours'] / 365, 1) ?> ans
        </span>
    </div>
</div>
<?php } ?>

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h4 fw-semibold mb-0">
                <i class="bi bi-people-fill text-secondary me-2"></i>Liste des employés
            </h1>
            <p class="text-muted small mb-0">Annuaire du personnel</p>
        </div>
        <span class="badge bg-primary rounded-pill">
            <?= count($resultat) ?> employé<?= count($resultat) > 1 ? 's' : '' ?>
        </span>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-uppercase text-muted small fw-semibold ps-4">
                            <i class="bi bi-person me-1"></i>Prénom
                        </th>
                        <th class="text-uppercase text-muted small fw-semibold">
                            Nom
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultat as $row): ?>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-semibold"
                                    style="width:36px; height:36px; font-size:13px; flex-shrink:0;">
                                    <?= strtoupper(substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1)) ?>
                                </div>
                                <a href="fiche.php?emp_no=<?= $row['emp_no'] ?>"><?= htmlspecialchars($row['first_name']) ?></a>
                            </div>
                        </td>
                        <td class="fw-semibold"><?= htmlspecialchars($row['last_name']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>