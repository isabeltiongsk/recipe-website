<?php
include './Controller/RecipeController.php';

$title = "Manage recipe objects";
$recipeController = new RecipeController();

$content = $recipeController->CreateOverviewTable();


if(isset($_GET['delete']))
{ 
    $recipeController->DeleteRecipe($_GET['delete']); 

} $content = $recipeController->CreateOverviewTable();

include './Templates.php';
?>

