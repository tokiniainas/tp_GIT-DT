<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>recherche</title>
    </head>

    <body>
        <form action="result-search.php" method="post">
            <input type="text" name="dept_name" placeholder="departement">
            <input type="text" name="employee_name" placeholder="nom employé">

            <select name="age_min">
                <option value="">Age min</option>
                <?php for ($i = 18; $i <= 100; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?> ans</option>
                <?php endfor; ?>
            </select>

            <select name="age_max">
                <option value="">Age max</option>
                <?php for ($i = 18; $i <= 100; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?> ans</option>
                <?php endfor; ?>
            </select>

            <input type="submit" value="rechercher">

        </form>
    </body>

    </html>

</body>

</html>