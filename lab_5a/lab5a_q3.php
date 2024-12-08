<?php
function multiplication($multiplier) {
    $results = [];
    for ($i = 1; $i <= 12; $i++) {
        $results[] = [
            'No' => $i,
            'Multiplier' => $multiplier,
            'Answer' => $i * $multiplier,
        ];
    }
    return $results;
}

$multiplier = 2;
$table = multiplication($multiplier);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 5a Q3</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2>Chrisnanda's Multiplication Table for <?php echo $multiplier; ?></h2>
    <table>
        <tr>
            <th>No</th>
            <th>Multiplier</th>
            <th>Answer</th>
        </tr>
        <?php foreach ($table as $row): ?>
        <tr>
            <td><?php echo $row['No']; ?></td>
            <td><?php echo $row['Multiplier']; ?></td>
            <td><?php echo $row['Answer']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>