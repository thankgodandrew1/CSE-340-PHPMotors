<?php
/*
* Proxy connection for the phpmotors database
*/

function phpmotorsConnect()
{
    $server = 'localhost';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = 'rvS(I13hB*3hK7*!';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $link = new PDO($dsn, $username, $password, $options);

        // if (is_object($link)) {
        //     echo 'It worked!';
        // }
        return $link;
    } catch (PDOException $e) {
        // echo "it didn't work, error: ".$e->getMessage();
        header('Location: /phpmotors/view/500.php');
        exit;
    }
}
