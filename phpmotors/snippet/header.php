<div id="header">
    <img src="/phpmotors//images/site/logo.png" alt="PHP Motors logo">
    <div>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
             echo "<span><a href='/phpmotors/accounts/index.php/'>Welcome " . $_SESSION['clientData']['clientFirstname'] . ' | ' . "</a></span>";
            echo "<a href='/phpmotors/accounts/index.php?action=Logout' title='Logout from PHP Motors'>Log Out</a>";
        } else {
            echo "<a href='/phpmotors/accounts/index.php?action=login' id='account' title='Login or Register with PHP Motors'>My Account</a>";
        } ?>
        <a href="/phpmotors/search" title="Search PHP Motors">&#x1F50D;</a>
    </div>
</div>
