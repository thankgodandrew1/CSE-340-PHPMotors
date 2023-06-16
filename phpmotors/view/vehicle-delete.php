<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1) {
    header('Location: /phpmotors/index.php/');
    exit;
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
    <title>
        <?php if (isset($invInfo['invMake'])) {
            echo "Delete $invInfo[invMake] $invInfo[invModel]";
        } ?> | PHP Motors
    </title>

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
            <h1><?php if (isset($invInfo['invMake'])) {
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
                } ?>
            </h1>
            <p class="msg">Confirm Vehicle Deletion. The delete is permanent.</p>
            <form action="/phpmotors/vehicles/" method="post" class="register" id="vehicle-form">
                <!-- <p>*All Fields are required</p> -->

                <div class="form-flex">
                    <label>Make*
                        <input type="text" name="invMake" <?php if (isset($invInfo['invMake'])) {
                                                                echo "value='$invInfo[invMake]'";
                                                            } ?> readonly>
                    </label>

                    <label>Model*
                        <input type="text" name="invModel" <?php if (isset($invInfo['invModel'])) {
                                                                echo "value='$invInfo[invModel]'";
                                                            } ?> readonly>
                    </label>
                </div>

                <label>Description*
                    <textarea name="invDescription" cols="100" rows="4" class="desc" readonly>
                        <?php if (isset($invInfo['invDescription'])) {
                            echo $invInfo['invDescription'];
                        } ?>
                    </textarea>
                </label>
                <button type="submit" name="submit">Delete Vehicle</button>
                <input type="hidden" name="action" value="deleteVehicle">

                <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                echo $invInfo['invId'];
                                                            } ?>">
            </form>

        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>