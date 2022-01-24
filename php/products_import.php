<!DOCTYPE html>
<html>

<head>
    <title>
       入庫
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
            if (isset($_POST['remaining'])) {
                header("location:products.php");
            }
            ?>
             </div>
             
             <div class="item">
              
                 <input type="submit" style="border:none; margin-top :25px;" name="manage" value="管理"> <br>
                 </div>
                
                
                 
                 

            <div class="item">
          
             <button class="extra" name="remaining" style="padding-inline:20px;"  >在庫</button>
             <button class="extra" name="products_import" style="padding-inline:20px;"  >納品</button>
            </div>


            <div class="item">
    

            <!-- 処理するところ -->





            </div>




        </div>


    </form>
</body>

</html>