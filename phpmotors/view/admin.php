<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Administrators Page CSE 340: Backend Web Development 1 at Brigham Young University - Idaho">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <title>Client Admin | PHP Motors</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <h1>
                <?php
                // var_dump($_SESSION['clientData']);
                echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname'];
                ?>
            </h1>
            <p class="logged-in">You are logged in.</p>
            <ul class="admin-ul">
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
                <li>Level: <?php echo $_SESSION['clientData']['clientLevel']; ?></li>
            </ul>
            <?php
            if (intval($_SESSION['clientData']['clientLevel']) > 1) {
                echo "<h2 class='client-inv'>Inventory Management</h2>";
                echo "<p class='client-inv'>Use this link to manage the inventory</p>";
                echo "<a href = '/phpmotors/vehicles/' class='client-inv client-inv-link'>Vehicle Management</a>";
            }
            ?>
        </main>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>