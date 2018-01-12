<?php

    require('classes/DB.php');

    try {

        $result = DB::getInstance()->query("SELECT * FROM animals");

        foreach($result as $row){

            print $row['animal_type'] . ' - ' . $row['animal_name'] . '<br />';
        }
    } catch ( PDOException $e ){

        echo $e->getMessage();
    }

?>