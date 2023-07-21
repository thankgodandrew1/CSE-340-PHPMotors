<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1) {
    header('Location: /phpmotors/index.php/');
}
?>
<?php
// Build a dynamic dropdown for car classification
$classificationList = '<select class="selectClass" name="classificationId">';
$classificationList .= "<option value='' selected>Choose Car Classification</option>";

foreach ($classifications as $classification) {
    $classificationId = $classification['classificationId'];
    $classificationName = $classification['classificationName'];

    $selected = '';

    if (isset($_POST['classificationId']) && $classificationId == $_POST['classificationId']) {
        $selected = 'selected';
    }

    $classificationList .= '<option value="' . $classificationId . '" ' . $selected . '>' . $classificationName . '</option>';
}

$classificationList .= '</select>';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors CSE 340: Backend Web Development 1 at Brigham Young University - Idaho">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Vehicles | PHP Motors</title>
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
            <h2>Add new Vehicle</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="post" class="register" id="vehicle-form">
                <p>*All Fields are Required</p>
                <label>
                    <?= $classificationList; ?>
                </label>

                <div class="form-flex">
                    <label>Make*
                        <input type="text" name="invMake" <?php if (isset($invMake)) {
                                                                echo "value='$invMake'";
                                                            } ?> required>
                    </label>

                    <label>Model*
                        <input type="text" name="invModel" <?php if (isset($invModel)) {
                                                                echo "value='$invModel'";
                                                            } ?> required>
                    </label>
                </div>

                <label>Description*
                    <textarea name="invDescription" cols="100" rows="4" class="desc" required><?php if (isset($invDescription)) {
                                                                                                    echo "$invDescription";
                                                                                                }  ?></textarea>
                </label>
                <div class="form-flex">
                    <label>Image Path*
                        <input type="text" name="invImage" value="/phpmotors/images/no-image.png" <?php if (isset($invImage)) {
                                                                                                        echo "value='$invImage'";
                                                                                                    } ?> required>
                    </label>

                    <label>Thumbnail Path*
                        <input type="text" name="invThumbnail" value="/phpmotors/images/no-image.png" <?php if (isset($invThumbnail)) {
                                                                                                            echo "value='$invThumbnail'";
                                                                                                        } ?> required>
                    </label>
                </div>

                <div class="form-flex">
                    <label>Price*
                        <input type="number" name="invPrice" <?php if (isset($invPrice)) {
                                                                    echo "value='$invPrice'";
                                                                } ?> required>
                    </label>

                    <label>Color*
                        <input type="text" name="invColor" id="invColor" <?php if (isset($invColor)) {
                                                                                echo "value='$invColor'";
                                                                            } ?> required>
                    </label>
                </div>
                <button type="submit">Add Vehicle</button>
                <input type="hidden" name="action" value="addVehicle">
            </form>

        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>