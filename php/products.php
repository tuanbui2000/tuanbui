<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        商品管理
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <style>
                    .remaining {
                       display: inline-flex;
                        position: relative;
                        color: whitesmoke;
                        font-weight: bold;
                        height: 30px;                        
                        border: solid grey;
                        border-radius: 12px;
                        margin-left: 20px;
                        margin-top: 3px;
                      width: 450px ;
                      background-image: linear-gradient(to right bottom, #748559, rgb(157, 187, 87));
                      font-size: 20px;
                    }
                  
                    .data0{
                      
                        background-color: rgb(176, 179, 39);
                        border-radius: 12px;
                        width: 45px;
                        text-align: center;
                    }
                    .data1{
                      position: absolute;
                      top: 50%;
                      transform: translateY(-50%);
                      left: 60px;
                    }
                    .data2{
                        position: absolute;
                       top: 0;
                       right: 25px;
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
                <input name="products" style="border:none; " type="submit" value="商品">
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
                <button name='products' style="padding-inline:20px;border:none;" class='extra'>在庫</button>
              <?php
               if($_SESSION['permission']<3){
               echo " <button name='products_import' style='padding-inline:20px;' class='extra'>納品</button>";
               }
               ?>
            </div>


            <div class="item" >
                <!-- 処理するところ -->
                <?php
                    include 'logout.php'; 
                try {
                    // database connect
                    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql_syntax = 'SELECT  product_id, product_name, remaining_quantities from products ';
                    $stmt = $db->prepare($sql_syntax);
                    $stmt->execute();

                    //display data
                    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                        if($data[2])
                        echo "<div class='remaining'>
                      <div class='data0' >$data[0]</div>  
                      <div class='data1' >$data[1]</div>  
                      <div class='data2' >$data[2]   個</div>  

                  
                    </div>     ";
                    }
                    


                    $db = null;
                } catch (PDOException $e) {
                    // header("location:db_error.php");
                    print('database not connected ' . $e->getMessage());
                } catch (Exception $e) {
                    print('予期せぬerorr ' . $e->getMessage());
                }

                echo "<h1 style=' position:absolute; padding: 0; margin: 0; right:20px; top :25px;  font-size:35px;'>".$_SESSION['emp_name']."</h1>";
                ?>
              
            </div>




        </div>
               
    </form>
</body>

</html>