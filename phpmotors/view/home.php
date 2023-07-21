<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Motors Home Page CSE 340: Backend Web Development 1 at Brigham Young University - Idaho">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/phpmotors//css/style.css">
    <title>Home | PHP Motors</title>
</head>

<body>
    <div class="home-wrapper">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <div id="hero-area">
                <h1>Welcome to PHP Motors!</h1>
                <div class="hero-msg">
                    <h2>DMC Delorean</h2>
                    <p>3 Cup holders <br> Superman doors <br> Fuzzy dice!</p>
                </div>
                <!-- <div class="hero-image">
                    <img src="/phpmotors/images/vehicles/delorean.jpg" id="delorean" alt="DMC Delorean">
                    <img src="/phpmotors/images/site/own_today.png" id="img-btn" alt="button to buy car">
                </div> -->
            </div>
            <div id="deloreon-info">
                <div id="reviews">
                    <h2>DMC Delorean Reviews</h2>
                    <ul>
                        <li>"So fast its almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"80s livin and I love it!" (5/5)</li>
                    </ul>
                </div>
                <div id="upgrades">
                    <h2>Delorean Upgrades</h2>
                    <div id="upgrade-items">
                        <div>
                            <div class="item-img"><img src="/phpmotors/images/upgrades/flux-cap.png" alt="2d image of a flux capacitor"></div>
                            <div class="item-link"><a href="#">Flux Capacitor</a></div>
                        </div>
                        <div>
                            <div class="item-img"><img src="/phpmotors/images/upgrades/flame.jpg" alt="2d image of a flame"></div>
                            <div class="item-link"><a href="#">Flame Decals</a></div>
                        </div>
                        <div>
                            <div class="item-img"><img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="image of a bumper sticker saying 'hello world'"></div>
                            <div class="item-link"><a href="#">Bumper Stickers</a></div>
                        </div>
                        <div>
                            <div class="item-img"><img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="image of a hub cap"></div>
                            <div class="item-link"><a href="#">Hub Caps</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>