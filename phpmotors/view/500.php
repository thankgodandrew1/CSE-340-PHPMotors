<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Server Error Page CSE 340: Backend Web Development 1 at Brigham Young University - Idaho">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/phpmotors//css/style.css">
    <title>Server Error | PHP Motors</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/header.php' ?>
        </header>
        <nav>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/nav.php' ?>
        </nav>
        <main>
            <div class="err-div">
                <h1>Server Error</h1>
                <p>Sorry our server seems to be experiencing some technical difficulties. Please check back later.</p>
            </div>
        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php' ?>
        </footer>
    </div>
</body>

</html>