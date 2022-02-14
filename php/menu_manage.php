<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        メニュー
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <style>
        .e-d {
            padding: 5px 10px;
            font-size: 25px;
            background-image: linear-gradient(to right bottom, #ffa400, #00aefd);
            border: none;
            color: whitesmoke;
            border-radius: 12px;
            margin: 5px;

        }

        .wrap {
            color: whitesmoke;
            border-radius: 12px;
            font-size: 25px;
            min-width: 400px;
            background-color: rgb(221, 143, 143);
            padding: 0;
            display: inline-flex;
            box-sizing: border-box;


        }

        .wrap:hover {
            background-color: indianred;
        }

        .pr_img {
            height: 45px;
            width: 45px;
            background-position: 50% 50%;
            background-size: cover;
            border-radius: 11px 0 0 11px;

        }

        .pr_name {
            width: 350px;
            background-color: blueviolet;
            overflow: hidden;
            height: 45px;
            padding-top: 5px;
            box-sizing: border-box;

        }

        .pr_price {
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            width: 70px;
            height: 45px;
            border-radius: 0 11px 11px 0;
            padding: 6px 0;


        }

        .pro-detail {
            border-radius: 12px;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            height: 440px;
            width: 500px;
            position: fixed;
            top: 27%;
            right: 20px;

            padding: 5px;

        }

        .text button {
            display: inline-block;

            position: relative;
            left: 50%;
            transform: translateX(-90px);
            padding: 5px 20px;
            margin: 20px 5px;
            font-size: 20px;
            border-radius: 12px;


        }

        .pro-detail img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            display: block;
            margin: 0 auto;
            border-radius: 50%;
        }

        .pro-detail h1 {
            margin: 5px 60px;
            background-color: burlywood;
            border-radius: 12px;

            overflow: hidden;
            height: 42px;

        }

        .text {
            height: 36px;
            margin: 10px;
            font-size: 30px;
            color: whitesmoke;
            position: relative;
        }

        .text input,
        select {
            position: absolute;
            font-size: 30px;
            left: 100px;
            width: 250px;
            height: 40px;
            border-radius: 12px;
            border: none;
            color: whitesmoke;
            background-color: burlywood;
            padding-left: 10px;
        }
    </style>
</head>


<body>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="container">




            <div class="item">
                <img src="../images/logo.png" alt="logo">
            </div>

            <div class="item">
                <input name="user_manage" type="submit" value="ユーザー">
                <input name="products" type="submit" value="商品">
                <input name="menu_manage" style="border:none; " type="submit" value="メニュー">
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
                    $_SESSION['sql_syntax'] = 'select product_id, product_name, product_price from products';
                    // header("location:menu_manage.php");
                }
                if (isset($_POST['proceeds'])) {
                    header("location:proceeds.php");
                }
                include 'logout.php';
                ?>
            </div>

            <div class="item">

                <input type="submit" style="border:none; margin-top :25px;" name="manage" value="管理"> <br>
            </div>





            <div class="item">
                <!-- menubar -->

                <button name='kushi' class="extra" style="padding-inline:30px;">串</button>
                <button name='drink' class="extra" style="padding-inline:10px;">ドリンク</button>
                <?php
                if ($_SESSION['permission'] < 3) {
                    echo "    <button name='signup' style=' position:absolute; right:10px; border:solid; font-size:20px;
                 ' class='e-d'>登録</button>";
                }
                
                echo "<h1 style=' position:absolute; padding: 0; margin: 0; right:20px; top :25px;  font-size:35px;'>".$_SESSION['emp_name']."</h1>";
                ?>

            </div>


            <div class="item">


                <!-- 処理するところ -->
                <?php

                try {
                    // database connect
                    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    //edit process
                    if (isset($_POST["oke"])) {
                        if (strlen($_POST["new_name"]) > 1 && strlen($_POST["new_price"]) > 1) {
                            $sql_up = "UPDATE products SET product_name='" . $_POST["new_name"] . "',product_price='" . $_POST["new_price"] . "',category_id=" . $_POST["cate"] . " WHERE product_id=" . $_POST["new_id"] . "";
                            $tmt = $db->prepare($sql_up);
                            $tmt->execute();
                        }
                    }
                    //create
                    if (isset($_POST["create"])) {
                    $query = $db->prepare("SELECT * FROM products WHERE product_name ='".$_POST["new_name"]."'");
                        $query->execute();
                        if ($query->rowCount() > 0) {
                            echo '<h1 style=" text-align:center;">The product is already existed!</h1>';
                        } else{
                        if (strlen($_POST["new_name"]) > 1 && strlen($_POST["new_price"]) > 1) {
                            $sql = "INSERT into products(product_name, product_price, category_id) value('" . $_POST["new_name"] . "', " . $_POST["new_price"] . "," . $_POST["cate"] . ")";
                            $db->exec($sql);
                        $last_id = $db->lastInsertId();
                        
                     
                            // if (isset($_POST['fileToUpload'])) {

                                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '../images/products/'.$last_id.'.jpg');
                                echo '<h1 style=" text-align:center;">商品登録出来ました。!</h1>';
                            // }
                        }}
                    }
                    //delete
                    if (isset($_POST["dele"])) {
                        $sql = "DELETE FROM products WHERE product_id=" . $_SESSION['id'] . "";
                        $db->exec($sql);
                    }



                    //kushi drink

                    if (isset($_POST['drink'])) {
                        $_SESSION['sql_syntax'] = 'select product_id, product_name, product_price from products where category_id >=10';
                    } elseif (isset($_POST['kushi'])) {
                        $_SESSION['sql_syntax'] = 'select product_id, product_name, product_price from products where category_id <10';
                    }else{
                        $_SESSION['sql_syntax'] = 'select product_id, product_name, product_price from products';
                    }
                    $stmt = $db->prepare($_SESSION['sql_syntax']);
                    $stmt->execute();





                    //display data
                    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {

                        echo "<div style ='margin:5px 20px;'>
        <button class='wrap' value='$data[0]' name='pro_de' >
    
          
            <div style='background-image: url(../images/products/$data[0].jpg);' class='pr_img'></div> 
            <div class='pr_name'>$data[1]</div> 
            <div class='pr_price'>¥$data[2] </div> 
           
            
              
              </button> </div>";
                    }




                    if (isset($_POST["pro_de"]) || isset($_POST['no'])) {
                        $stmt = $db->prepare("SELECT product_id,product_name,product_price,category_id from products where product_id=" . $_POST['pro_de']);
                        $stmt->execute();
                        echo "<div class='pro-detail' style='text-align: center;' >";
                        //display data
                        while ($pr = $stmt->fetch(PDO::FETCH_NUM)) {
                            $_SESSION['id'] = $pr[0];
                            $_SESSION['name'] = $pr[1];
                            $_SESSION['price'] = $pr[2];
                            $_SESSION['category'] = $pr[3];
                            echo " <img alt='$pr[0]' src='../images/products/$pr[0].jpg'>";
                            echo " <h1>$pr[1]</h1>";
                            echo " <h1>¥$pr[2]</h1>";
                        }
                        if ($_SESSION['permission'] < 3) {
                            echo "
                             <button class='e-d' name='edit'>変更</button>
                             <button class='e-d' name='dele' >削除</button>";
                        }
                        echo "</div>";
                    }


                    if (isset($_POST['edit']) || isset($_POST['signup'])) {
                        if (isset($_POST['signup'])) {
                            $_SESSION['id'] = $_SESSION['name'] = $_SESSION['price'] =                      $_SESSION['category'] = ' ';
                        }

                        echo "<div style='top:10%; height:540px;' class='pro-detail' >";
                        echo "<input name= 'new_id' type='hidden'value='" . $_SESSION["id"] . "'>";
                        echo " <img src='../images/products/" . $_SESSION["id"] . ".jpg'>";
                        echo '<div style="text-align:center;">Select image:  <input type="file" name="fileToUpload" ></div>';
                        echo "<div class='text'> name:<input  name='new_name' type='text' value='" . $_SESSION["name"] . "'></div>";
                        echo "<div class='text'> price:<input name='new_price' type='text' value='" . $_SESSION["price"] . "'></div>";
                        echo " <div class='text'> cate:<select  name='cate'>";
                        $stm = $db->prepare("SELECT category_id,category_name from categories");
                        $stm->execute();
                        while ($ct = $stm->fetch(PDO::FETCH_NUM)) {
                            echo "<option ";
                            if ($_SESSION['category'] == $ct[0]) {
                                echo "selected='selected' ";
                            }
                            echo "  value='$ct[0]' >$ct[1]</option>";
                        }
                        echo "</select><div>";
                        if (isset($_POST['signup'])) {
                            echo "
                        <button class='e-d' name='create'>登録</button>
                        <button class='e-d' name='cancel' >前へ</button>";
                        } else {
                            echo "
                        <button class='e-d' name='oke'>変更</button>
                        <button class='e-d' name='no' >前へ</button>";
                        }
                        echo "</div>";
                    }
                } catch (PDOException $e) {
                    //alert
                    echo "<script type='text/javascript'>alert('召し上がっているテーブルがございます。');</script>";
                    // print('database not connected ' . $e->getMessage());
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