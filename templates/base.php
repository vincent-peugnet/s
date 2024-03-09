<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>découpage</title>
    <link rel="stylesheet" href="base.css">
</head>
<body>
    <h1>Découpage</h1>
    <?php
    $sequences = array_diff(scandir('./src/'), array('..', '.'));
    foreach ($sequences as $sequence) {
        include('sequence.php');
    }
    ?>
</body>
</html>
