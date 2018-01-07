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
        
        # Provide a success message to front-end:
        echo '<p>Connected to Database</p>';

        # Insert Data sample:
        $count = $dbh->exec("INSERT INTO animals(animal_type, animal_name) VALUES ('kiwi', 'troy')");
        
        # Show an updated count upon success of executed statement:
        echo '<p>' . $count . ' row(s) updated.</p>';
        
        # Close the database connection:
        $dbh = null;
    } catch ( PDOException $error ){

        echo $error->getMessage();
    }
?>