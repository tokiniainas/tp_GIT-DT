<?php 
include('include/fonction.php');
$no = $_GET['dept_no'];

$resultat = get_employees_by_dept($no);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <table border="1">
            <tr>
                <th>First name</th>
                <th>Last name</th>
            </tr>
            <?php foreach ($resultat as $row ) { ?>
            <tr>
        <td><?php echo $row['first_name']; ?></td>
        <td><?php echo $row['last_name'] ?></td>
        </tr>    
        <?php }?>
        </table>
    </main>
</body>
</html>