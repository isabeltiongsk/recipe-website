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
<p><img src="<?php echo $details_rs['image'] ;?>"  height="300" width="400"/></p> 
<h1><?php echo $details_rs['name']; ?></h1>
<p style="font-size:1.25em;color:#0e3c68;font-weight:bold;">Ingredient budget: $<?php echo $details_rs['price'];?></p>
<p style="font-size:1.25em;color:#0e3c68;font-weight:bold;"><?php echo nl2br ($details_rs['ingredient']);?></p>
<p style="font-size:1.25em;color:#0e3c68;font-weight:bold;"><?php echo nl2br ($details_rs['instruction']);?></p>

<?php
}
include("footer.php");
?>

