<?php

    /**
     * Title: PDO Prepare Statements Sample
     * Author: Patrick Cole
     * Version: 1.0.20180112
     * Description: Each section represents a test in learning prepare
     * statments with PDO.
     * Source: https://phpro.org/tutorials/Introduction-to-PHP-PDO.html
    **/

    /**
     * Configuration
     * Description: Variables related to the database connection.
    **/
    $hostname = 'localhost';
    $username = 'patrick';
    $password = 'admin1';
    $database = 'pdo_test';

    try {

        $dbh = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

        echo '<p>Connected to Database</p>';

        /**
         * Section: SQL variables and statement
        **/
        $data = array('animal_id' => 6, 'animal_name' => 'bruce');
        $stmt = $dbh->prepare("SELECT * FROM animals WHERE animal_id = :animal_id AND animal_name = :animal_name");

        /**
         * Section: Bind parameters to statement
        **/
        $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
        $stmt->bindParam(':animal_name', $animal_name, PDO::PARAM_STR, 5);

        /*** reassign the animal_id ***/
        $data = array('animal_id' => 3, 'animal_name' => 'bruce');

        /*** execute the prepared statement ***/
        $stmt->execute( $data );

        /*** loop over the results ***/
        while($row = $stmt->fetch()) {

            echo $row['animal_id'].'<br />';
            echo $row['animal_type'].'<br />';
            echo $row['animal_name'].'<br />';
        }

        /*** reassign the animal_id ***/
        $data = array('animal_id' => 4, 'animal_name' => 'bruce');

        /*** execute the prepared statement ***/
        $stmt->execute( $data );

        /*** loop over the results ***/
        while($row = $stmt->fetch()) {

            echo $row['animal_id'].'<br />';
            echo $row['animal_type'].'<br />';
            echo $row['animal_name'].'<br />';
        }

        /*** reassign the animal_id ***/
        $data = array('animal_id' => 9, 'animal_name' => 'bruce');
        
        /*** execute the prepared statement ***/
        $stmt->execute( $data );

        /*** loop over the results ***/
        while($row = $stmt->fetch()) {

            echo $row['animal_id'].'<br />';
            echo $row['animal_type'].'<br />';
            echo $row['animal_name'];
        }

        /**
         * Section: Clean Up Tasks
         * Description: Close the connection to the database and perform any additional
         * clean up tasks.
        **/
        $dbh = null;
    } catch ( PDOException $error ){

        echo $error->getMessage();
    }
?>