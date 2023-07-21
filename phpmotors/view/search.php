<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION["status"] = "searchString";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors CSE 340: Backend Web Development 1 at Brigham Young University - Idaho">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Search | PHP Motors</title>
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

        <main>
            <h1>Search our inventory</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/search/index.php" class="search">
                <div class="search-label">
                    <label for="searchString">What are you looking for today?</label>
                    <input type="text" name="searchString" id="searchString" required <?php if (isset($searchString)) {
                                                                                            echo "value='$searchString'";
                                                                                        } ?>>

                </div>
                <button type="submit" class="searchBtn">Search</button>
                <input type="hidden" name="action" value="search">
            </form>
            <div id="results">
                <?php
                if (isset($searchDisplay)) {
                    echo $searchDisplay;
                }
                ?>
            </div>
        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>