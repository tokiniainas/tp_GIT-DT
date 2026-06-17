<?php
include("include/fonction.php");

$emp_no = isset($_GET['emp_no']) ? (int) $_GET['emp_no'] : 0;

if (!$emp_no) {
    die("Employé non spécifié.");
}

$employe = get_one_line("SELECT first_name, last_name FROM employees WHERE emp_no = $emp_no");

$dept = get_one_line("
    SELECT dept_no
    FROM dept_emp
    WHERE emp_no = $emp_no AND to_date = '9999-01-01'
");

$dept_no = $dept['dept_no'] ?? null;

$departement     = null;
$ancien_manager  = null;
$message         = '';

if ($dept_no) {
    $departement = get_one_line("SELECT dept_name FROM departments WHERE dept_no = '$dept_no'");

    $ancien_manager = get_one_line("
        SELECT e.first_name, e.last_name, dm.from_date
        FROM dept_manager AS dm
        JOIN employees AS e ON dm.emp_no = e.emp_no
        WHERE dm.dept_no = '$dept_no' AND dm.to_date = '9999-01-01'
    ");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['from_date']) && $dept_no) {

    $from_date = $_POST['from_date'];

    // Clôture l'ancien manager à la date de début du nouveau
    mysqli_query(dbconnect(), "
        UPDATE dept_manager
        SET to_date = '$from_date'
        WHERE dept_no = '$dept_no' AND to_date = '9999-01-01'
    ");

    // Insère le nouvel employé comme manager actuel
    mysqli_query(dbconnect(), "
        INSERT INTO dept_manager (emp_no, dept_no, from_date, to_date)
        VALUES ($emp_no, '$dept_no', '$from_date', '9999-01-01')
    ");

    $message = 'success';

    // Recharge le manager actuel (qui est maintenant le nouvel employé)
    $ancien_manager = get_one_line("
        SELECT e.first_name, e.last_name, dm.from_date
        FROM dept_manager AS dm
        JOIN employees AS e ON dm.emp_no = e.emp_no
        WHERE dm.dept_no = '$dept_no' AND dm.to_date = '9999-01-01'
    ");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <title>Devenir manager</title>
</head>
<body class="bg-light">
    <?php include 'include/header.php'; ?>

<main class="container py-5">

    <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm mb-4">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <h1 class="h5 fw-semibold mb-3">
                <i class="bi bi-person-up me-2"></i>Devenir manager
            </h1>

            <?php if ($dept_no) { ?>

                <p class="text-muted small mb-1">
                    Département concerné :
                    <span class="fw-semibold"><?= $departement['dept_name'] ?> (<?= $dept_no ?>)</span>
                </p>

                <p class="text-muted small mb-1">
                    Futur manager :
                    <span class="fw-semibold"><?= $employe['first_name'] ?> <?= $employe['last_name'] ?></span>
                </p>

                <p class="text-muted small mb-3">
                    Manager actuel :
                    <?php if ($ancien_manager) { ?>
                        <span class="fw-semibold"><?= $ancien_manager['first_name'] ?> <?= $ancien_manager['last_name'] ?></span>
                        depuis le <?= date('d/m/Y', strtotime($ancien_manager['from_date'])) ?>
                    <?php } else { ?>
                        <span class="fw-semibold">Aucun</span>
                    <?php } ?>
                </p>

                <?php if ($message === 'success') { ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-1"></i>
                        <?= $employe['first_name'] ?> est maintenant le manager du département.
                    </div>
                <?php } ?>

                <form method="post" class="row g-3 align-items-end">
                    <div class="col-auto">
                        <label for="from_date" class="form-label small text-muted">Date de début</label>
                        <input type="date" id="from_date" name="from_date" class="form-control" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2 me-1"></i>Valider
                        </button>
                    </div>
                </form>

            <?php } else { ?>
                <div class="alert alert-warning mb-0">
                    Cet employé n'est associé à aucun département actuellement.
                </div>
            <?php } ?>

        </div>
    </div>

</main>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
