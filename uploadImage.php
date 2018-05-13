<?php
$title = "Upload new image";

$content = '<form action="" method="post" enctype="multipart/form-data">
    <label for="file">Filename: </label>
    <input type="file" name="file" id="file"></br>
    <input type="submit" name="upload" value="upload">
</form>';

// check file type is valid
if(isset($_POST["upload"])){
$fileType = $_FILES["file"]["type"];

if(($fileType == "image/gif") ||
    ($fileType == "image/jpg") ||
    ($fileType == "image/jpeg") ||
    ($fileType == "image/png")) 
{
    //check if file exists
    if(file_exists("Image/Recipe/" . $_FILES["file"]["name"]))
    {
        echo "File already exists";
    }
    else
    {
        move_uploaded_file($_FILES["file"]["tmp_name"], "Images/Recipe/" . $_FILES["file"]["name"]);
        echo "Uploaded in" . "Images/Recipe/" . $_FILES["file"]["name"];
    }
}
}
    
include './Templates.php';
?>

