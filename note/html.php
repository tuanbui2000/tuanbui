
<!DOCTYPE html>  
<html>  
<head>  
<meta charset="utf-8">  
<title> JavaScript confirm Box by PHP </title>  

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>  
<body>  <?php
$alert_script;
$error;

//Put this POST block right at the top of the page.
if ($_POST['confirm'] !== 1) {
  $alert_script =  "<script>alert(\'You have to tick the box\')</script>";
  $error = true;
} else {
  $error = false;
}
if (!$error) {
  //complete the action code/call another file.
}

//Then wherever you're running document ready or general page scripts, you'll want to echo $alert_script

//scripts

  if (isset($alert_script)) {
     echo $alert_script;
  }
?>
<div class="">
<p>Icon buttons:</p>
<button class="btn"><i class="fa fa-plus"></i></button>
<button class="btn"> 2</button>
<button class="btn"><i class="fa fa-minus"></i></button>


<style>.btn {
  background-color: DodgerBlue; /* Blue background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 16px; /* Some padding */
  font-size: 16px; /* Set a font size */
  cursor: pointer; /* Mouse pointer on hover */
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}</style>
</div>



</body>  
</html>   .blur_wrapper{
        height:100%;
        position: relative;
    }
    .product".$_SESSION["name1"]."{ 
box-sizing: border-box;
   filter: blur(2px);
  height: 100%; 
  
    }
    .blur_image{
        
        position: absolute; 
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-weight: bold;
        text-align: center;
      }
    