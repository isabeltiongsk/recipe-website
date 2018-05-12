<?php
require ("Model/RecipeModel.php");

//Contains non-database related function for the Recipe page
class RecipeController {

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
                            <th>Origin: </th>
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
    function InsertRecipe(){
        
    }
    function UpdateRecipe($id){
        
    }
    function DeleteRecipe($id){
        
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
    //</editor-fold>
}

?>
