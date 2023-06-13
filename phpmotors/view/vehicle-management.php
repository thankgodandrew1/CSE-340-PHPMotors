<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1) {
    header('Location: /phpmotors/index.php/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors CSE 340: Backend Web Development 1 at Brigham Young University - Idaho">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Vehicles Management | PHP Motors</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main class="register-main">
            <h2>Vehicle Management</h2>
            <p>Welcome to the vehicle management page!</p>
            <ul class="vehicle-man">
                <li><a href="/phpmotors/vehicles/index.php?action=addClassification">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles/index.php?action=addVehicle">Add Vehicle</a></li>
            </ul>
        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>