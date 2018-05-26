<?php

require ("Entities/RecipeEntity.php");
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"recipedb");
//Contains database related code for the Recipe page.
class RecipeModel {

    //Get all recipe types from the database and return them in an array.
    function GetRecipeTypes() {
        require ('Credentials.php');
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
        require ('Credentials.php');
        //Open connection and Select database.     
        @mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM recipe WHERE type LIKE '$type'";
        $result = mysql_query($query) or die(mysql_error());
        $recipeArray = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $country = $row[4];
            $image = $row[5];
            $review = $row[6];
            $ingredient = $row[7];
            $instruction = $row[8];

            //Create recipe objects and store them in an array.
            $recipe = new RecipeEntity($id, $name, $type, $price, $country, $image, $review, $ingredient, $instruction);
            array_push($recipeArray, $recipe);
        }
        //Close connection and return result
        mysql_close();
        return $recipeArray;
    }

    function GetRecipeById($id) {
        require ('Credentials.php');
        //Open connection and Select database.     
        @mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM recipe WHERE id = $id";
        $result = mysql_query($query) or die(mysql_error());

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $country = $row[4];
            $image = $row[5];
            $review = $row[6];
            $ingredient = $row[7];
            $instruction = $row[8];

            //Create recipe
            $recipe = new RecipeEntity($id, $name, $type, $price, $country, $image, $review, $ingredient, $instruction);
        }
        //Close connection and return result
        mysql_close();
        return $recipe;
    }

    function InsertRecipe(RecipeEntity $recipe) {
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link, "recipedb");
       
         $query = sprintf("INSERT INTO recipe
                          (name, type, price,country,image,review,ingredient,instruction)
                          VALUES
                          ('%s','%s','%s','%s','%s','%s','%s','%s')",
                $name= mysqli_real_escape_string($link, $recipe->name),
                $type= mysqli_real_escape_string($link, $recipe->type),
                $price= mysqli_real_escape_string($link, $recipe->price),
                $country= mysqli_real_escape_string($link, $recipe->country),
                $image= mysqli_real_escape_string($link, "Images/Recipe/" . $recipe->image),
                $review= mysqli_real_escape_string($link, $recipe->review),
                $ingredient= mysqli_real_escape_string($link, $recipe->ingredient),
                $instruction= mysqli_real_escape_string($link, $recipe->instruction));
        $this->PerformQuery($query);
    }
        
       

    function UpdateRecipe($id, RecipeEntity $recipe) {
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link, "recipedb");
       
        $query = sprintf("UPDATE recipe
                            SET name = '%s', type = '%s', price = '%s',
                            country = '%s', image = '%s', review = '%s', ingredient = '%s', instruction = '%s'
                          WHERE id = $id",
                mysqli_real_escape_string($link, $recipe->name),
                mysqli_real_escape_string($link, $recipe->type),
                mysqli_real_escape_string($link, $recipe->price),
                mysqli_real_escape_string($link, $recipe->country),
                mysqli_real_escape_string($link, "Images/Recipe/" . $recipe->image),
                mysqli_real_escape_string($link, $recipe->review),
                mysqli_real_escape_string($link, $recipe->ingredient),
                mysqli_real_escape_string($link, $recipe->instruction));
                          
        $this->PerformQuery($query);
    }

    function DeleteRecipe($id) {
        $query = "DELETE FROM recipe WHERE id = $id";
        $this->PerformQuery($query);
    }

    function PerformQuery($query) {
        require ('Credentials.php');
        @mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);

        //Execute query and close connection
        mysql_query($query) or die(mysql_error());
        mysql_close();
    }

}

?>
