<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors CSE 340: Backend Web Development 1 at Brigham Young University - Idaho">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Car Classification | PHP Motors</title>
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
            <h2>Add Classification!</h2>
            <form action="/phpmotors/vehicles/index.php" method="post" class="login register">
                <label for="classificationName"><b>Classification Name:</b></label>
                <input type="text" name="classificationName" id="classificationName" placeholder="SUV">
                <?php if (!empty($errorMsg)) : ?>
                    <p class="error-message"><?php echo $errorMsg; ?></p>
                <?php endif; ?>

                <button type="submit">Add Classification</button>
                <input type="hidden" name="action" value="addClassification">
            </form>
        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>