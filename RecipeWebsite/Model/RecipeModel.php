<?php

require ("Entities/RecipeEntity.php");

//Contains database related code for the Recipe page.
class RecipeModel {

    //Get all recipe types from the database and return them in an array.
    function GetRecipeTypes() {
        require 'Credentials.php';

        //Open connection and Select database.   
        @mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        $result = mysql_query("SELECT DISTINCT type FROM recipe") or die(mysql_error());
        $types = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            array_push($types, $row[0]);
        }

        //Close connection and return result.
        mysql_close();
        return $types;
    }

    //Get recipeEntity objects from the database and return them in an array.
    function GetRecipeByType($type) {
        require 'Credentials.php';

        //Open connection and Select database.     
        @mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM recipe WHERE type LIKE '$type'";
        $result = mysql_query($query) or die(mysql_error());
        $recipeArray = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $country = $row[4];
            $image = $row[5];
            $review = $row[6];

            //Create recipe objects and store them in an array.
            $recipe = new RecipeEntity(-1, $name, $type, $price, $country, $image, $review);
            array_push($recipeArray, $recipe);
        }
        //Close connection and return result
        mysql_close();
        return $recipeArray;
    }

}

?>
