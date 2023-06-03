<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors CSE 340: Backend Web Development 1 at Brigham Young University - Idaho">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Account Registration | PHP Motors</title>
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
            <h1>Register</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/accounts/index.php" class="register">
                <p>* All fields are required</p>
                <label for="clientFirstname">First name*</label>
                <input type="text" id="clientFirstname" name="clientFirstname" <?php if (isset($clientFirstname)) {
                                                                                    echo "value='$clientFirstname'";
                                                                                }  ?> required>

                <label for="clientLastname">Last name*</label>
                <input type="text" id="clientLastname" name="clientLastname" <?php if (isset($clientLastname)) {
                                                                                    echo "value='$clientLastname'";
                                                                                }  ?> required>

                <label for="clientEmail">Email address*</label>
                <input type="email" id="clientEmail" name="clientEmail" <?php if (isset($clientEmail)) {
                                                                            echo "value='$clientEmail'";
                                                                        }  ?> required>

                <label for="clientPassword">Password*</label>
                <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
                <input type="password" id="clientPassword" name="clientPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Passwords must be at least 8 characters long. Contains at least 1 uppercase character, 1 number, and 1 special character." required>

                <button type="submit">Register</button>
                <input type="hidden" name="action" value="register">
            </form>
        </main>
        <hr>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>