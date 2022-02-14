<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        入庫
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .products {
            display: inline-flex;
            min-width: 470px;
            
        }
        .import {
            position: relative;
            width: 350px;
            font-size: 20px;
            border-radius: 12px;
            border: none;
            color: whitesmoke;
            font-weight: bold;
            background-image: linear-gradient(to right bottom, #748559, rgb(157, 187, 87));

        }

        .data0 {

            float: left;

        }

        .data1 {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
        }

        .numb {
            margin-left: 10px;
        }

        .numb input {
            border: none;
            width: 35px;
            font-size: 20px;
            margin: 0 5px;
            border-radius: 3px;
            font-weight: bold;
            text-align: center;
        }

        .numb button {
            border: none;
            font-size: 25px;
            padding: 0;
            border-radius: 10px;
            position: relative;


            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0);

            color: rgb(4, 156, 37);

            padding: 0;
            cursor: pointer;
        }

        .numb button:hover {
            top: -1px;
        }

        .im_but {
            position: fixed;
            right: 15px;
            bottom: 50px;
            font-size: 30px;
            padding: 10px 20px;
            background-image: linear-gradient(to right bottom, #ffa400, #00aefd);
            color: whitesmoke;
            font-weight: bold;
            border-radius: 50%;
            border: none;
        }
        .im_but:hover{
            border: solid whitesmoke;
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
                if (isset($_POST['remaining'])) {
                    header("location:products.php");
                }
                ?>
            </div>

            <div class="item">

                <input type="submit" style="border:none; margin-top :25px;" name="manage" value="管理"> <br>
            </div>





            <div class="item">

                <button class="extra" name="remaining" style="padding-inline:20px;">在庫</button>
                <button class="extra" name="products_import" style="padding-inline:20px;border:none;">納品</button>
            </div>


            <div class="item" style="padding-top: 5px; padding-left:10px;">


                <!-- 処理するところ -->

                <?php
                 include 'logout.php'; 
                try {
                   
                    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                   
                    $sql_syntax = 'SELECT   product_name, remaining_quantities, product_id from products ';
                    $stmt = $db->prepare($sql_syntax);
                    $stmt->execute();
                    //display data
                    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                        $pd = 'pro' . $data[2];
                        $vl = 'value' . $data[2];
                        $pl = 'plus' . $data[2];
                        $mn = 'minus' . $data[2];








                        //button event
                        if (isset($_POST["import_event"])) {
                            if (isset($_SESSION[$pd]) && isset($_POST["$vl"])  ) {
                                $sql_im = "UPDATE products SET remaining_quantities=remaining_quantities+" . $_POST["$vl"] . " WHERE product_id=" . $_SESSION[$pd];
                                // Prepare statement
                                $st = $db->prepare($sql_im);
                                // execute the query
                                $st->execute();
                                unset($_SESSION[$pd]);
                                unset($_SESSION[$vl]);
                               
                            }
                        }
                        if (isset($_POST["$vl"]) && $_POST["$vl"] < 1) {
                            unset($_SESSION[$pd]);
                            unset($_SESSION[$vl]);
                        }elseif(isset($_POST["$vl"]) && $_POST["$vl"] > 100) {
                            $_POST["$vl"]  = 100;
                        } else {

                            //plus
                            if (isset($_POST[$pl])) {
                                if ($_POST["$vl"] % 2 == 1) {
                                    $_POST["$vl"]  += 1;
                                }
                                if ($_POST["$vl"] < 100) {
                                    $_POST["$vl"]  += 2;
                                }
                            }

                            //minus
                            if (isset($_POST[$mn])) {
                                $_POST["$vl"]  -= 2;
                                // $_SESSION[$vl]  -= 2;
                                if ($_POST["$vl"] == 0) {
                                    unset($_SESSION[$pd]);
                                }
                            }
                        }



                        //display pro
                        echo "
                        <div class='products'>
                        <button name='pro$data[2]' value='$data[2]' class='import' >
                        <div class='data0'>$data[0]</div>
                        <div class='data1'>$data[1]個</div>";

                        //display text
                        if (isset($_POST[$pd]) || isset($_SESSION[$pd])) {
                            $_SESSION[$pd] = $data[2];

                            echo " </button> 
                      <div class= 'numb'><button name='$mn'><i class='fa fa-minus'></i></button> <input type='text' name='$vl' value='";

                            if (isset($_POST["$vl"])) {
                                echo $_POST["$vl"];
                            }

                            echo "'>
                      <button name='$pl' ><i class='fa fa-plus'></i></button>
                      </div>";
                        }
                        echo " </div>";
                    }


                    echo " <button class='im_but' name='import_event'>発注</button>";
              


                } catch (PDOException $e) {
                    header("location:db_error.php");
                    print('database not connected ' . $e->getMessage());
                } catch (Exception $e) {
                    print('予期せぬerorr ' . $e->getMessage());
                }
                $db = null;
                echo "<h1 style=' position:absolute; padding: 0; margin: 0; right:20px; top :25px;  font-size:35px;'>".$_SESSION['emp_name']."</h1>";
                ?>



            </div>




        </div>


    </form>
</body>

</html>