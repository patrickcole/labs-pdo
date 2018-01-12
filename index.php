<?php

    /**
     * Title: PDO Introduction Sample
     * Author: Patrick Cole
     * Description: This sample is to get me started on connecting to databases
     * using PDO with real examples provided by the source tutorial. This file is
     * formatted in a manner with comments for each test/section to show progress.
     * Ideally in a production environment the comments would be less related to
     * testing and more indicative of actual logic and functionality.
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

        /**
         * Section: Check available PDO drivers
         * Description: Loop through the PDO object and see what drivers are available.
        **/
        echo '<ul>';
        foreach(PDO::getAvailableDrivers() as $pdoDriver){

            echo '<li>' . $pdoDriver . '</li>';
        }
        echo '</ul>';

        /**
         * Section: Database Connection
         * Description: Establish database connection through a PDO object. Also provide
         * a success message to the front-end for debugging.
         **/
        $dbh = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        echo '<p>Connected to Database</p>';

        /**
         * Section: SQL Insert Sample
         * Description: A simple INSERT command to get started with PDO->exec(). Note: the
         * exec() method is best suited for statements in which no result set is expected.
         * --------------------------
         * Status: Section Completed
         * --------------------------
         * $insertCount_int = $dbh->exec("INSERT INTO animals(animal_type, animal_name) VALUES ('kiwi', 'troy')");
         * echo '<p>' . $insertCount_int . ' row(s) updated.</p>';
        **/

        /**
         * Section: SQL Update Sample
         * Description: Using existing data, perform an update command using a specific
         * condition. Again, no result set is needed so a PDO->exec() is fine.
         * --------------------------
         * Status: Section Completed
         * --------------------------
         * $count = $dbh->exec("UPDATE animals SET animal_name='bruce' WHERE animal_name='troy'");
         * echo '<p>' . $count . ' rows updated.</p>';
        **/

        /**
         * Section: SQL Select Data
         * Description: Display all data from the table and using PDO->query(). The 
         * resulting set will then be iterated over using foreach to print each result.
        **/
        $selectCommand = "SELECT * FROM animals";

        # Perform the query into a PDOStatement object:
        $queryStatement = $dbh->query($selectCommand);

        # Assign the fetch mode:
        $queryResult = $queryStatement->fetch(PDO::FETCH_OBJ);

        /**
         * Section: Fetch Modes (ASSOC, NUM, BOTH)
         * Description: Sample output using the modes listed above.
         * --------------------------
         * Status: Section Completed
         * --------------------------
         * echo '<ul>';
         * foreach ( $queryResult as $key => $val ){
         * 
         * echo '<li><strong>' . $key . ' - ' . $val . '</li>';
         * }
         * echo '</ul>';
        **/

        /**
         * Section: Fetch Modes (OBJ)
         * Description: Sample output using FETCH_OBJ
        **/
        echo $queryResult->animal_id . "<br />";
        echo $queryResult->animal_type . "<br />";
        echo $queryResult->animal_name;

        /**
         * Section: Clean Up Tasks
         * Description: Close the connection to the database and perform any additional
         * clean up tasks.
         */
        $dbh = null;
    } catch ( PDOException $error ){

        echo $error->getMessage();
    }
?>