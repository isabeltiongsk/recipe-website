<?php
require './Controller/RecipeController.php';
$recipeController = new RecipeController();

$title = "Add new recipe";

$content ="<form action='' method='post'>
    <fieldset>
        <legend>Add a new recipe</legend>
        <label for='name'>Name: </label>
        <input type='text' class='inputField' name='txtName'/><br/>
        
        <label for='type'>Type: </label>
        <select class='inputField' name='ddlType'>
            <option value='%'>All</option>
        </select><br/>
        
        <label for='price'>Price: </label>
        <input type='text' class='inputField' name='txtPrice'/><br/>
        
        <label for='origin'>Origin: </label>
        <input type='text' class='inputField' name='txtOrigin'/><br/>
        
        <label for='image'>Image: </label>
        <select class='inputField'name='ddlImage'></select></br>
        
        <label for='review'>Review: </label>
        <textarea cols='70' rows='12' name='txtReview'></textarea></br>
        
        <input type='submit' value='Submit'>
        
    </fieldset>
</form>";
include './Templates.php';
?>

