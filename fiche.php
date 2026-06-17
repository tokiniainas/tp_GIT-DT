<?php 
include("include/fonction.php");
$no = $_GET['emp_no'];
$resultat = get_fiche_employees($no);
$historique = get_historique_employees($no);
$historique_poste = get_historique_poste($no);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <title>Fiche employé</title>
</head>
<body class="bg-light">
    <?php include 'include/header.php'; ?>

<main class="container py-5">

    <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm mb-4">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
    <br>
   <i class="bi bi-cash-stack me-2"></i>Fiche employées
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center
                            justify-content-center fw-semibold"
                     style="width:52px; height:52px; font-size:16px; flex-shrink:0;">
                    <?= strtoupper(substr($resultat['first_name'], 0, 1) . substr($resultat['last_name'], 0, 1)) ?>
                </div>
                <div>
                    <h1 class="h5 fw-semibold mb-0">
                        <?= htmlspecialchars($resultat['first_name']) ?>
                        <?= htmlspecialchars($resultat['last_name']) ?>
                    </h1>
                    <span class="badge bg-primary bg-opacity-10 text-primary small">
                        <?= $resultat['gender'] === 'M' ? 'Homme' : 'Femme' ?>
                    </span>
                </div>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between px-0">
                    <span class="text-muted small">
                        <i class="bi bi-calendar-event me-2"></i>Date de naissance
                    </span>
                    <span class="fw-semibold small"><?= htmlspecialchars($resultat['birth_date']) ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between px-0">
                    <span class="text-muted small">
                        <i class="bi bi-briefcase me-2"></i>Date d'embauche
                    </span>
                    <span class="fw-semibold small"><?= htmlspecialchars($resultat['hire_date']) ?></span>
                </li>
            </ul>

        </div>
    </div>


    <h2 class="h6 text-uppercase text-muted fw-semibold mb-3">
        <i class="bi bi-cash-stack me-2"></i>Historique des salaires
    </h2>
    <div class="card border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-uppercase text-muted small fw-semibold ps-4">Salaire</th>
                        <th class="text-uppercase text-muted small fw-semibold">Du</th>
                        <th class="text-uppercase text-muted small fw-semibold">Au</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historique as $ligne): ?>
                    <tr>
                        <td class="ps-4 fw-semibold">
                            <?= number_format($ligne['salary'], 0, ',', ' ') ?> 
                        </td>
                        <td class="text-muted small"><?= htmlspecialchars($ligne['from_date']) ?></td>
                        <td class="text-muted small"><?= htmlspecialchars($ligne['to_date']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <h2 class="h6 text-uppercase text-muted fw-semibold mb-3">
        <i class="bi bi-person-badge me-2"></i>Historique des postes
    </h2>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-uppercase text-muted small fw-semibold ps-4">Poste</th>
                        <th class="text-uppercase text-muted small fw-semibold">Du</th>
                        <th class="text-uppercase text-muted small fw-semibold">Au</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historique_poste as $ligne): ?>
                    <tr>
                        <td class="ps-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                <?= htmlspecialchars($ligne['title']) ?>
                            </span>
                        </td>
                        <td class="text-muted small"><?= htmlspecialchars($ligne['tit_from']) ?></td>
                        <td class="text-muted small"><?= htmlspecialchars($ligne['tit_to']) ?></td>
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