<!DOCTYPE html>
<html>

<head>
    <title>
       商品管理
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
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
             <input name="proceeds" type="submit" value="売上">
             
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
            if (isset($_POST['products_import'])) {
                header("location:products_import.php");
            }
            ?>
             </div>
             
             <div class="item">
              
                 <input type="submit" style="border:none; margin-top :25px;" name="manage" value="管理"> <br>
                 </div>
                
                
                 
                 
<!-- menubar -->
            <div class="item">
            <button name='products' style="padding-inline:20px;" class='extra' >在庫</button>
            <button name='products_import' style="padding-inline:20px;" class='extra' >納品</button>
             
            </div>


            <div class="item">
    

            <!-- 処理するところ -->

            
            </div>




        </div>


    </form>
</body>

</html>