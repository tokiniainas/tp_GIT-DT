<?php

include 'include/fonction.php';

if (isset($_POST['dept_name']) || isset($_POST['employee_name']) || isset($_POST['age_min']) || isset($_POST['age_max'])) {

    $conditions = [];

    $sql = "SELECT dep.dept_name, empl.first_name, empl.last_name
            FROM departments AS dep
            JOIN dept_emp ON dep.dept_no = dept_emp.dept_no
            JOIN employees AS empl ON dept_emp.emp_no = empl.emp_no ";

    if (!empty($_POST['dept_name'])) {
        $conditions[] = sprintf("dep.dept_name LIKE '%%%s%%'", $_POST['dept_name']);
    }

    if (!empty($_POST['employee_name'])) {
        $conditions[] = sprintf("(empl.first_name LIKE '%%%s%%' OR empl.last_name LIKE '%%%s%%')",
            $_POST['employee_name'],
            $_POST['employee_name']
        );
    }

    if (!empty($_POST['age_min'])) {
        $conditions[] = sprintf("(YEAR(CURDATE()) - YEAR(empl.birth_date)) >= %d", $_POST['age_min']);
    }

    if (!empty($_POST['age_max'])) {
        $conditions[] = sprintf("(YEAR(CURDATE()) - YEAR(empl.birth_date)) <= %d", $_POST['age_max']);
    }

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $resultat = get_all_line($sql);
}else {
    $resultat = [];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <title>resultat</title>
</head>

<body>
    <table>
        <?php if (!empty($resultat)) { ?>
            <tr>
                <?php if ($resultat[0]['dept_name'] != null) { ?>
                    <th>Departement</th>
                <?php } ?>
                <?php if ($resultat[0]['first_name'] != null) { ?>
                    <th>First Name</th>
                <?php } ?>
                <?php if ($resultat[0]['last_name'] != null) { ?>
                    <th>Last Name</th>
                <?php } ?>
            </tr>
            <?php foreach ($resultat as $row){ ?>
                <tr>
                    <?php if (isset($row['dept_name'])){ ?>
                        <td><?= htmlspecialchars($row['dept_name']) ?></td>
                    <?php } ?>
                    <?php if (isset($row['first_name'])){ ?>
                        <td><?= htmlspecialchars($row['first_name']) ?></td>
                    <?php } ?>
                    <?php if (isset($row['last_name'])){ ?>
                        <td><?= htmlspecialchars($row['last_name']) ?></td>
                    <?php } ?>
                </tr>
            <?php }
        } 
        else{ ?>
            <tr>
                <td>Aucun résultat</td>
            </tr>
        <?php } ?>


    </table>
</body>

</html>