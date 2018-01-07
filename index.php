<?php

    /*
     * Title: PDO Introduction Sample
     * Author: Patrick Cole
     * Description: This sample is to get me started on connecting to databases
     * using PDO with real examples provided by the source tutorial.
     * Source: https://phpro.org/tutorials/Introduction-to-PHP-PDO.html
    */

    # First, let's check what drivers are available in our PHP installation:
    echo '<ul>';
    
    foreach(PDO::getAvailableDrivers() as $driver){

        echo '<li>' . $driver . '</li>';
    }

    echo '</ul>';

    /* 
        The results were:
        mysql
        odbc
        sqlite
    */

    # Let's now establish a connection:
    $hostname = 'localhost';
    $username = 'patrick';
    $password = 'admin1';

    try {

        $dbh = new PDO("mysql:host=$hostname;dbname=pdo_test", $username, $password);
        echo '<p>Connected to Database</p>';
    } catch ( PDOException $error ){

        echo $error->getMessage();
    }
?>