 <?php

 include("Controller\RecipeController.php");
$dbconnect = mysqli_connect("localhost", "root", "", "recipedb");
$id='';
// redirect back to index paage if no id has been set
if(isset($_GET['id'])){
    
    include ("header.php");
}
echo $_GET['id'];
$details_sql="SELECT * FROM recipe WHERE id=".$_GET['id'];
if($details_query=mysqli_query($dbconnect,$details_sql)){
$details_rs=mysqli_fetch_assoc($details_query);
    ?>
<h1><?php echo $details_rs['name']; ?></h1>
<p>$<?php echo $details_rs['price'];?></p>
<p><?php echo $details_rs['ingredient'];?></p>
<p><?php echo $details_rs['instruction'];?></p>

<?php
}
include("footer.php");
?>

