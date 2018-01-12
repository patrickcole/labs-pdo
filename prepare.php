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
        $animal_id = 6;
        $animal_name = 'bruce';
        $stmt = $dbh->prepare("SELECT * FROM animals WHERE animal_id = :animal_id AND animal_name = :animal_name");

        /**
         * Section: Bind parameters to statement
        **/
        $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
        $stmt->bindParam(':animal_name', $animal_name, PDO::PARAM_STR, 5);

        $stmt->execute();

        $result = $stmt->fetchAll();

        echo '<ul>';
        foreach($result as $row){
            
            echo '<li>' . $row['animal_id'] . ' - ' . $row['animal_type'] . ' - ' . $row['animal_name'] . '</li>';
        }
        echo '</ul>';


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