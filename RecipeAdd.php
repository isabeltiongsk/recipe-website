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
            <option value='%'>All</option>"
        .$recipeController->CreateOptionValues($recipeController->GetRecipeType()).
        
        "</select><br/>
        
        <label for='price'>Price: </label>
        <input type='text' class='inputField' name='txtPrice'/><br/>
        
        <label for='country'>Country: </label>
        <input type='text' class='inputField' name='txtCountry'/><br/>
        
        <label for='image'>Image: </label>
        <select class='inputField'name='ddlImage'>"
        .$recipeController->GetImages().
        "</select></br>
        
        <label for='review'>Review: </label>
        <textarea cols='70' rows='12' name='txtReview'></textarea></br>
        
        <input type='submit'name='submit1' value='Submit'>
        
    </fieldset>
</form>";

if(isset($_POST["txtName"]))
{
    $recipeController->InsertRecipe();
}

include './Templates.php';
?>

