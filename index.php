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
        
        # Correct SQL command:
        // $selectCommand = "SELECT * FROM animals";

        # Perform the query into a PDOStatement object:
        // $queryStatement = $dbh->query($selectCommand);

        /**
         * Section: Fetch Result Class
         * Description: A sample Animal class to handle the database result.
        **/
        class Animal {

            public $animal_id;
            public $animal_type;
            public $animal_name;

            public function capitalizeType(){
                
                return ucwords($this->animal_type);
            }
        }

        # Assign the fetch mode:
        # For all fetch modes except CLASS use this:
        // $queryResult = $queryStatement->fetch(PDO::FETCH_OBJ);
        
        # To use a class, use this:
        // $queryResult = $queryStatement->fetchALL(PDO::FETCH_CLASS, 'Animal');

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
         * --------------------------
         * Status: Section Completed
         * --------------------------
         * echo $queryResult->animal_id . "<br />";
         * echo $queryResult->animal_type . "<br />";
         * echo $queryResult->animal_name;
        **/

        /**
         * Section: Fetch Class Result Sample
         * Description: Using the Animal class and PDO::FETCH_CLASS, render the results.
         * echo '<ul>';
         * foreach( $queryResult as $animal ){
         * 
         * echo '<li>' . $animal->capitalizeType() . '</li>';
         * }
         * echo '</ul>';
        **/

        /**
         * Section: PDO Error Reporting
         * Description: This sets the error reporting attribute.
         * ERRMODE_EXCEPTION - Errors are caught in exception.
         * ERRMODE_WARNING - Errors are displayed as warnings.
         * ERRMODE_SILENT - Does not display SQL statement errors.
         */
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

        /**
         * Section: Error sample
         * Description: This section uses the incorrect SQL statement to trigger 
         * a PDO error.
         */
        $selectCommand = "SELECT username FROM animals";
        
        echo '<ul>';
        foreach($dbh->query($selectCommand) as $row){

            echo '<li>' . $row['animal_type' ] . ' - ' . $row['animal_name'] . '</li>';
        }
        echo '</ul>';

        /**
         * Section: PDO Error Data
         * Description: Display the error code and information related to error.
         */
        echo '<p>Error code: ' . $dbh->errorCode() . '</p>';
        echo '<ul>';
        foreach( $dbh->errorInfo() as $error ){
            
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';


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