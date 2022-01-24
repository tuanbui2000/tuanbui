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
                <button name='products' style="padding-inline:20px;" class='extra'>在庫</button>
                <button name='products_import' style="padding-inline:20px;" class='extra'>納品</button>

            </div>


            <div class="item">
                <!-- 処理するところ -->
                <?php

                try {
                    // database connect
                    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql_syntax = 'SELECT  products.product_id, product_name, remaining_quantities  from products inner join remaining on products.product_id = remaining.product_id ';
                    $stmt = $db->prepare($sql_syntax);
                    $stmt->execute();

                    //display data
                    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "<div class='remaining'>
                      <button name='$data[0]' style='width:35px;margin-right: 5px; height: 100%;border-radius:12px;border:none; background-color:burlywood;'>$data[0]</button>  $data[1] 
                      <div class='data2'>$data[2]個</div>
                    </div>     ";
                    }


                    $db = null;
                } catch (PDOException $e) {
                    header("location:db_error.php");
                    print('database not connected ' . $e->getMessage());
                } catch (Exception $e) {
                    print('予期せぬerorr ' . $e->getMessage());
                }


                ?>
                <style>
                    .remaining {
                        position: relative;
                        color: whitesmoke;
                        font-weight: bold;
                        height: 25px;                        
                        border: solid grey;
                        border-radius: 12px;
                        margin-left: 20px;
                        margin-top: 1px;
                       width: 350px;
                    }
                    .data2{
                        position: absolute;
                       top: 0;
                       right: 25px;
                    }
                   
                </style>
            </div>




        </div>

        <input type='submit' name='logout' value='ログアウト' style='  height: 50px;
                    width: 100px;   border-radius: 50%; position: fixed;
                        bottom: 50px;
                        left: 30px;
                        size: 100%;'>
    </form>
</body>

</html>