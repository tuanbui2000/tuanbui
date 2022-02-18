<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
       売上
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <style>
.wrapper{
    box-sizing: border-box;
    
    border-radius: 12px;

  position: relative;
  display: inline-block;
  position: relative;
  left: 50%;
  transform: translateX(-50%);
  width: 500px;
  padding:1px 0;
  background-image: linear-gradient( to right  bottom,rgb(250, 161, 126), rgb(219, 86, 179));
}     
  

.name{
    width:max-content;
    position: relative;

}
.number{
position: absolute;
top: 50%;
right: 50px;
transform: translate(50%,-50%);
right: 40px;



}
    </style>
</head>


<body>

    <form action="" method="POST">
        <div class="container">
           
          
            
             
             <div class="item">
                 <img src="../images/logo.png" alt="logo">
             </div>
             
             <div class="item">
             <input name="user_manage" type="submit" value="ユーザー">
             <input name="products" type="submit" value="商品">
             <input name="menu_manage" type="submit" value="メニュー">
             <input name="proceeds" style="border:none; " type="submit" value="売上">
             
            <?php
             //menu-bar redirect
             if (isset($_POST['user_manage'])) {
                header("location:user_manage.php");
            }
            if (isset($_POST['products'])) {
                header("location:products.php");
            }
            if (isset($_POST['menu_manage'])) {
                header("location:menu_manage.php");
            }
            if (isset($_POST['proceeds'])) {
                header("location:proceeds.php");
            }
            echo "<h1 style=' position:absolute; padding: 0; margin: 0; right:20px; top :25px;  font-size:35px;'>".$_SESSION['emp_name']."</h1>";
            include 'logout.php';
            ?>
             </div>
             
             <div class="item">
              
                 <input type="submit" style="border:none; margin-top :25px;" name="manage" value="管理"> <br>
                 </div>
                
                
                 
                 

            <div class="item">
                <!-- menubar -->

            </div>


            <div class="item" style='padding:5px;box-sizing: border-box;'>
    

            <!-- 処理するところ -->
<?php
  try {

    $sql="SELECT product_name,  sum(order_quantities) from products inner join proceeds on products.product_id = proceeds.product_id group by product_name with rollup";
    // database connect
    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // begin the transaction
    $stmt = $db->prepare($sql);
    $stmt->execute();
    //display data
    echo"<h1 class='wrapper'><div class='name'>商品名</div><div  class='number' >数量</div>
    </h1>";
    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
echo"<h2 class='wrapper'> ";
if(strlen($data[0])<1){
echo "<div class='name'>total</div>";
}else{
    echo "<div class='name'>$data[0]</div>";

}

echo"<div  class='number' >$data[1]</div>
</h2>";



    }
} catch (PDOException $e) {
    header("location:db_error.php");
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    print('予期せぬerorr ' . $e->getMessage());
}

$db = null;

?>
            

            </div>




        </div>


    </form>
</body>

</html>