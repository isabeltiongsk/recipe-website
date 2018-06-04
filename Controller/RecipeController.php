<script>
    //Confirmation box for delete
    function showConfirm(id)
    {
        //confirmation box
        var c = confirm("Are you sure you want to delete this item?");
        
        //if true, delete item and refresh
        if(c)
            window.location = "RecipeOverview.php?delete=" + id;
    }
    
    </script>

<?php

require ("Model/RecipeModel.php");

//Contains non-database related function for the Recipe page
class RecipeController {
    
    function CreateOverviewTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Id</b></td>
                    <td><b>Name</b></td>
                    <td><b>Type</b></td>
                    <td><b>Price</b></td>
                    <td><b>Country</b></td>
                    <td><b>Info</b></td>
                </tr>";

        $recipeArray = $this->GetRecipeByType('%');

        foreach ($recipeArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td><a href='RecipeAdd.php?update=$value->id'>Update</a></td>
                        <td><a href='#' onclick='showConfirm($value->id)'>Delete</a></td>
                        <td>$value->id</td>
                        <td>$value->name</td>
                        <td>$value->type</td>    
                        <td>$value->price</td> 
                        <td>$value->country</td>   
                    </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }


    function CreateRecipeDropdownList() {
        $recipeModel = new RecipeModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please select a type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($recipeModel->GetRecipeTypes()) .
                "</select>
                     <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }

    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }
    
    function CreateRecipeTables($types)
    {
        $recipeModel = new RecipeModel();
        $recipeArray = $recipeModel->GetRecipeByType($types);
        $result = "";
        
        //Generate a recipeTable for each recipeEntity in array
        foreach ($recipeArray as $key => $recipe) 
        {
            $result = $result .
                    "<table class = 'recipeTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$recipe->image' /></th>
                            <th width = '75px' >Name: </th>
                            <td><a href='details.php?id={$recipe->id}'>$recipe->name</a></td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$recipe->type</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$recipe->price</td>
                        </tr>
                        

                        <tr>
                            <th>Country: </th>
                            <td>$recipe->country</td>
                        </tr>
                        

                        <tr>
                            <td colspan='2' >$recipe->review</td>
                        </tr>                      
                     </table>";
        }        
        return $result;
        
    }
    
    //Returns list of files in a folder.
    function GetImages() {
        //Select folder to scan
        $handle = opendir("Images/Recipe");

        //Read all files and store names in array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }

        closedir($handle);

        //Exclude all filenames where filename length < 3
        $imageArray = array();
        foreach ($images as $image) {
            if (strlen($image) > 2) {
                array_push($imageArray, $image);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }
   //<editor-fold desc="Set Methods">
    function InsertRecipe()
    {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $country = $_POST["txtCountry"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];
        $ingredient = $_POST["txtIngredient"];
        $instruction = $_POST["txtInstruction"];
        
        $recipe = new RecipeEntity(-1, $name, $type, $price, $country, $image, $review,$ingredient, $instruction);
        $recipeModel = NEW recipeModel();
        $recipeModel->InsertRecipe($recipe);
        
        
    }
    
    function UpdateRecipe($id){
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $country = $_POST["txtCountry"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];
        $ingredient = $_POST["txtIngredient"];
        $instruction = $_POST["txtInstruction"];
        
        $recipe = new RecipeEntity($id, $name, $type, $price, $country, $image, $review,$ingredient, $instruction);
        $recipeModel = new RecipeModel();
        $recipeModel->UpdateRecipe($id, $recipe);
        
    }
    function DeleteRecipe($id){
        $recipeModel = new RecipeModel();
        $recipeModel->DeleteRecipe($id);
    }
    //</editor-fold>
    
    //<editor-fold desc="Get Methods">
    function GetRecipeById($id){
        $recipeModel = new RecipeModel();
        return $recipeModel->GetRecipeById($id);
    }
    function GetRecipeByType($type){
        $recipeModel = new RecipeModel();
        return $recipeModel->GetRecipeByType($type);
    }
    function GetRecipeType(){
        $recipeModel = new RecipeModel();
        return $recipeModel->GetRecipeTypes();
    }
    
    function CreateRecipeDetail($id)
    {
        $recipeModel = new RecipeModel();
        $recipeArray = $recipeModel->GetRecipeById($id);
        $result = "";
        
        //Generate a recipeTable for each recipeEntity in array
        foreach ($recipeArray as $key => $recipe) 
        {
            $result = $result .
                    "
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$recipe->image' /></th>
                            <th width = '75px' >Name: </th>
                            <td>$recipe->name</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$recipe->type</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$recipe->price</td>
                        </tr>
                        

                        <tr>
                            <th>Country: </th>
                            <td>$recipe->country</td>
                        </tr>
                        

                        <tr>
                            <td colspan='2' >$recipe->review</td>
                        </tr>                      
                     </table>";
        }        
        return $result;
        
    }
    //</editor-fold>
}

?>
