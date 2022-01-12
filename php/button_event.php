
<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
      
<head>
    <title>
        How to call PHP function
        on the click of a Button ?
    </title>
</head>
  
<body style="text-align:center;">
      
    <h1 style="color:green;">
        GeeksforGeeks
    </h1>
      
    <h4>
        How to call PHP function
        on the click of a Button ?
    </h4>
  
    <?php
      
        if(isset($_POST['button1'])) {
            echo "This is Button1";
        }
        if(isset($_POST['button2'])) {
            echo "This is Button2 that is selected";
        }
    ?>
      
    <form method="post">
        <input type="submit" name="button1" value="Button1"/>
          
        <input type="submit" name="button2" value="Button2"/>
    </form>
</head>
  <body>
  <form action="" method="POST">
    <input style="background-image:url(../images/products/1.jpg);" type="submit" value="0" name="mybutton">
    <input type="submit" value="1" name="mybutton">
    <button name="mybutton" type="submit" value="fav_HTML">HTML</button>
    <input type="submit" value="2" name="mybutton">
</form>
<div class="choose"></div>
<style>
    input{
        height: 200px;
        width: 200px;
        border-radius: 12px;
        background-position:50% 50%;
    background-size: cover;
    }
</style>
<?php 
echo "Favorite animal is " . $_SESSION["first"] . ".";
   if (isset($_POST["mybutton"]))
   {
       echo $_POST["mybutton"];
   }
   
   echo $_SESSION['first'];
   echo $_SESSION['seconnd'];
   
?>
  </body>
</html>