<?php

include 'include/fonction.php';

// On utilise $_REQUEST pour que les paramètres de recherche restent disponibles
// aussi bien lors de la soumission du formulaire (POST) que lors d'un clic
// sur les liens "précédent / suivant" (GET).
$dept_name     = $_REQUEST['dept_name'] ?? '';
$employee_name = $_REQUEST['employee_name'] ?? '';
$age_min       = $_REQUEST['age_min'] ?? '';
$age_max       = $_REQUEST['age_max'] ?? '';

$has_search = ($dept_name !== '' || $employee_name !== '' || $age_min !== '' || $age_max !== '');

$resultat    = [];
$total_rows  = 0;
$total_pages = 0;
$page        = 1;
$limit       = 20;

if ($has_search) {

    $conditions = [];

    if (!empty($dept_name)) {
        $conditions[] = sprintf("dep.dept_name LIKE '%%%s%%'", $dept_name);
    }

    if (!empty($employee_name)) {
        $conditions[] = sprintf(
            "(empl.first_name LIKE '%%%s%%' OR empl.last_name LIKE '%%%s%%')",
            $employee_name,
            $employee_name
        );
    }

    if (!empty($age_min)) {
        $conditions[] = sprintf("(YEAR(CURDATE()) - YEAR(empl.birth_date)) >= %d", $age_min);
    }

    if (!empty($age_max)) {
        $conditions[] = sprintf("(YEAR(CURDATE()) - YEAR(empl.birth_date)) <= %d", $age_max);
    }

    $where_sql = !empty($conditions) ? " WHERE " . implode(" AND ", $conditions) : "";

    $from_sql = "FROM departments AS dep
                 JOIN dept_emp ON dep.dept_no = dept_emp.dept_no
                 JOIN employees AS empl ON dept_emp.emp_no = empl.emp_no ";

    // --- Comptage du nombre total de lignes (pour calculer le nombre de pages) ---
    $sql_count   = "SELECT COUNT(*) AS total " . $from_sql . $where_sql;
    $count_result = get_all_line($sql_count);
    $total_rows   = !empty($count_result) ? (int) $count_result[0]['total'] : 0;
    $total_pages  = $total_rows > 0 ? (int) ceil($total_rows / $limit) : 0;

    // --- Page courante (sécurisée : toujours un entier >= 1) ---
    $page = isset($_REQUEST['page']) ? (int) $_REQUEST['page'] : 1;
    if ($page < 1) {
        $page = 1;
    }
    if ($total_pages > 0 && $page > $total_pages) {
        $page = $total_pages;
    }
    $offset = ($page - 1) * $limit;

    // --- Requête finale avec LIMIT / OFFSET ---
    $sql = "SELECT dep.dept_name, empl.first_name, empl.last_name "
         . $from_sql
         . $where_sql
         . sprintf(" LIMIT %d OFFSET %d", $limit, $offset);

    $resultat = get_all_line($sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <title>Résultat de recherche</title>
<style>body{background-color:#f5f6f8;}.result-card{border:none;border-radius:0.75rem;box-shadow:0 0.25rem 1rem rgba(0,0,0,0.06);}.table thead th{background-color:#212529;color:#fff;font-weight:500;border:none;}.table tbody tr:hover{background-color:#f1f3f5;}.badge-count{font-size:0.85rem;}</style>
</head>

<body>
    <div class="container py-5">
        <div class="card result-card">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0"><i class="bi bi-search"></i> Résultats de recherche</h4>
                    <?php if ($has_search) { ?>
                        <span class="badge bg-secondary badge-count">
                            <?= $total_rows ?> résultat<?= $total_rows > 1 ? 's' : '' ?>
                        </span>
                    <?php } ?>
                </div>

                <?php if (!empty($resultat)) { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <?php if ($resultat[0]['dept_name'] != null) { ?>
                                        <th>Département</th>
                                    <?php } ?>
                                    <?php if ($resultat[0]['first_name'] != null) { ?>
                                        <th>Prénom</th>
                                    <?php } ?>
                                    <?php if ($resultat[0]['last_name'] != null) { ?>
                                        <th>Nom</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultat as $row) { ?>
                                    <tr>
                                        <?php if (isset($row['dept_name'])) { ?>
                                            <td><?= htmlspecialchars($row['dept_name']) ?></td>
                                        <?php } ?>
                                        <?php if (isset($row['first_name'])) { ?>
                                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                                        <?php } ?>
                                        <?php if (isset($row['last_name'])) { ?>
                                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <nav class="d-flex justify-content-between align-items-center mt-4">
                        <a href="<?= $page > 1 ? build_page_url($page - 1) : '#' ?>"
                           class="btn btn-outline-dark <?= $page <= 1 ? 'disabled' : '' ?>">
                            <i class="bi bi-arrow-left"></i> Précédent
                        </a>

                        <span class="text-muted">
                            Page <?= $page ?> / <?= $total_pages ?>
                        </span>

                        <a href="<?= $page < $total_pages ? build_page_url($page + 1) : '#' ?>"
                           class="btn btn-outline-dark <?= $page >= $total_pages ? 'disabled' : '' ?>">
                            Suivant <i class="bi bi-arrow-right"></i>
                        </a>
                    </nav>

                <?php } elseif ($has_search) { ?>
                    <div class="alert alert-warning mb-0" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> Aucun résultat trouvé.
                    </div>
                <?php } else { ?>
                    <div class="alert alert-light border mb-0" role="alert">
                        Lancez une recherche pour afficher des résultats.
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</body>

</html>
