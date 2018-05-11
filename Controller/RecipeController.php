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

}

?>
