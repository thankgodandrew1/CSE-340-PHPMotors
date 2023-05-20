<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors CSE 340: Backend Web Development 1 at Brigham Young University - Idaho">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Account Login | PHP Motors</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main class="register-main">
            <h1>Sign in</h1>

            <form action="/phpmotors/accounts/index.php" method="POST" class="register login">
                <label for="clientEmail">Email:</label>
                <input type="email" id="clientEmail" name="clientEmail" required>

                <label for="clientPassword">Password:</label>
                <input type="password" id="clientPassword" name="clientPassword" required>

                <button type="submit">Login</button>
            </form>
            <p class="register-link">No Account? <a href="/phpmotors/accounts/index.php?action=registration">Register Here</a></p>
        </main>
        <hr>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>