<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>
        ユーザー管理
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <style>
        .wrap {
            padding: 20px;

        }

        .user_manage {
            display: block;
            margin: 2px;
            border-radius: 12px;
            border: solid whitesmoke;
            margin-left: 20px;
            width: 250px;
            background-color: rgb(170, 36, 170);
            font-size: 28px;
            color: whitesmoke;
        }

        .user_manage:hover {
            padding-right: 10px;
            width: 270px;
            margin-left: 10px;
        }

        .table {
            margin-left: -7px;

            padding: 10px;
            border-radius: 12px;
            font-weight: bold;
            color: whitesmoke;
            background-color: brown;
            font-size: 20px;
            float: left;
        }

        /* .number{
            
            padding: 5px;
        } */

        .tb_detail {
            text-align: center;
            box-sizing: border-box;
            border-radius: 12px;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            height: 440px;
            width: 500px;
            position: fixed;
            top: 27%;
            right: 20px;
            padding: 50px;
            overflow: auto;




        }

        .prod {
            position: relative;
            display: block;
            margin: 0 auto;
            border: none;
            width: 350px;
            font-size: 20px;
            color: whitesmoke;
            background-color: rgb(204, 157, 109);
            border-radius: 5px;
        }

        .prod:hover {
            background-color: peachpuff;
        }

        .e-d {
            padding: 5px 10px;
            font-size: 30px;
            background-image: linear-gradient(to right bottom, #ffa400, #00aefd);
            border: none;
            color: whitesmoke;
            border-radius: 12px;
            margin: 5px;

        }

        .order_edit {
            padding: 10px;
            position: fixed;
            top: 27%;
            right: 520px;
            width: 250px;

            text-align: center;
            box-sizing: border-box;
            border-radius: 12px;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            height: 200px;
        }

        .text {
            border: none;
            color: whitesmoke;
            background-color: rgb(211, 157, 131);
            font-size: 30px;
            border-radius: 12px;
            width: 200px;
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
                <input name="user_manage" style="border:none; " type="submit" value="ユーザー">
                <input name="products" type="submit" value="商品">
                <input name="menu_manage" type="submit" value="メニュー">
                <input name="proceeds" type="submit" value="売上">
               

                <?php
                //menu-bar redirect
                if (isset($_POST['user_manage'])) {
                    unset($_SESSION['table']);
                    header("location:user_manage.php");
                }
                if (isset($_POST['products'])) {
                    unset($_SESSION['table']);
                    header("location:products.php");
                }
                if (isset($_POST['menu_manage'])) {
                    unset($_SESSION['table']);
                    header("location:menu_manage.php");
                }
                if (isset($_POST['proceeds'])) {
                    unset($_SESSION['table']);
                    header("location:proceeds.php");
                }
   
                ?>
    </div>

            <div class="item">

                <input type="submit" style="border:none; margin-top :25px;" name="manage" value="管理"> <br>
            </div>





            <div class="item">
                <!-- menubar -->
                <button name='client' style="padding-inline:20px;border:none;" class='extra'>客</button>
                <button name='employees_manage' style="padding-inline:20px;" class='extra'>従業員</button>
                <?php

                if (isset($_POST['employees_manage'])) {
                    header("location:employee_manage.php");
                }
                ?>

            </div>


            <div class="item">


                <!-- 処理するところ -->

                <?php
    include 'logout.php'; 
                try {
                    // database connect
                    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //here
                    if (isset($_POST['ch-tb'])) {

                        if (isset($_POST['to-tb']) && $_POST['to-tb'] > 0) {

                            $stmt = $db->prepare("select distinct order_id from orders where table_id=" . $_POST['to-tb'] . "");
                            $stmt->execute();

                            //display data
                            while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                                $cate =   $data[0];
                            }
                            if (isset($cate)) {
                                $stmt = $db->prepare("UPDATE orders SET table_id =" . $_POST['to-tb'] . ",order_id=(select distinct order_id from orders where table_id=" . $_POST['to-tb'] . ") where table_id=" . $_SESSION['table'] . "");
                            } else {
                                $stmt = $db->prepare("UPDATE orders SET table_id =" . $_POST['to-tb'] . " where table_id=" . $_SESSION['table'] . "");
                            }

                            $stmt->execute();
                            unset($_SESSION['table']);
                            header("location:user_manage.php");
                        }
                    }
                    $sql = "select distinct table_id,order_id from orders ";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    //display data
                    echo "<div class='wrap' >";
                    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "
                            <button  value='$data[0]' name='table_detail' class='user_manage'>
                            <div class='table'>table: $data[0]</div> <div class='number' style='padding-top:5px;font-size:30px;'>ID: $data[1]</div> </button>";
                    }
                    echo "</div>";



                    if (isset($_POST['table_detail']) || isset($_POST["no"]) || isset($_POST["prod"])) {
                        if (isset($_POST['table_detail'])) {
                            $_SESSION["table"] = $_POST['table_detail'];
                        }
                        echo "<div class='tb_detail'>";

                        echo "
<div style='
 position: fixed;font-size: 30px; z-index:5; margin-top: -49px;  background-color: violet; width:400px;border-radius:12px;color:whitesmoke;
'> table: " . $_SESSION["table"] . " </div>
";
                        $stmt = $db->prepare("SELECT product_name, order_quantities, product_price, orders.product_id from products inner join orders on products.product_id = orders.product_id where  table_id=" . $_SESSION["table"]);
                        $stmt->execute();
                        $sho = 0;
                        //display data
                        while ($tb = $stmt->fetch(PDO::FETCH_NUM)) {

                            echo " 
                             <button class='prod' name='prod' value='$tb[3]'>
                           <div style='float:left;'>  ● $tb[0]</div>
                           <div style='float:left;position:absolute;
                           right:60px;top: 50%;
                           transform: translateY(-50%);'> $tb[1] 個  </div>
                           <div  style='
                           position:absolute;
                           right:3px;top: 50%;
                           transform: translateY(-50%);'> ￥$tb[2]</div>
                               </button>";

                            $sho += $tb[2];
                        }
                        //total process
                        $zei = $sho / 100 * 8;
                        $go = round($sho + $zei);
                        echo "<h2>";
                        echo "<hr>";
                        echo "小計 :   ¥$sho <br>";
                        echo "(内税対象額  : ¥$sho )<br>";
                        echo " 8%内税    : ¥$zei <br>";
                        echo  " 合計     : ¥$go ";
                        echo "</h2>";
                        if ($_SESSION['permission'] < 3) {
                            echo "
                             <button class='e-d' name='edit'>変更</button>
                             <button class='e-d' name='dele' >削除</button>";
                        }
                        echo "</div> ";
                    }






                    if (isset($_POST['edit'])) {

                        echo "<div class='tb_detail'>";



                        echo "<button name='tb-ch' style=' font-size: 20px;' class='e-d'>テーブルチェンジ</button>";
                        echo "<button name='or-de' style=' font-size: 20px;' class='e-d'>注文変更</button>";

                        echo "</div";
                    }


                    if (isset($_POST['tb-ch'])) {
                        echo "<div class='tb_detail'>";
                        echo "<h1  style='margin-left:70px; width:max-content; '>from:   " . $_SESSION["table"] . " </h1>";
                        echo " <label><h1>to:<input value='' class='text' name='to-tb'  type='text' ></h1> </label>";
                        echo "<button name='ch-tb' style=' font-size: 20px; margin-top: 60px;' class='e-d'>チェンジ</button>";
                        echo "<button name='no' style=' font-size: 20px; margin-top: 60px;' class='e-d'>キャンセル</button>";
                        echo "</div";
                    }



                    if (isset($_POST['dele'])) {
                        echo "<div class='tb_detail'>";
                        echo "<h1>このテーブル削除よろしいですか。</h1>
<button style='margin-top:100px;' class='e-d' name='yes'>はい</button>
<button class='e-d' name='no' >いいえ</button>";


                        echo "</div";
                    }

                    if (isset($_POST['yes'])) {
                        $db->exec("DELETE from orders where table_id=" . $_SESSION["table"]);
                    }
                    if ($_SESSION['permission'] < 3) {

                        if (isset($_POST["prod"])) {
                            echo   "<div class='order_edit'>";


                            $stmt = $db->prepare("SELECT product_name, order_quantities,orders.product_id from products inner join orders on products.product_id = orders.product_id where  orders.product_id= " . $_POST["prod"] . " and table_id=" . $_SESSION['table']);
                            $stmt->execute();
                            $sho = 0;
                            //display data
                            while ($tb = $stmt->fetch(PDO::FETCH_NUM)) {

                                echo "<h3>$tb[0]</h3>";
                                echo "<input type='text' name='nu-ch' style='width: 150px' class='text' value='$tb[1]'>個";
                                echo "<input name='pr-id' type='hidden' value=$tb[2]>";
                            }
                            if ($_SESSION['permission'] < 3) {
                                echo "<button style='margin-top: 20px;' name='bt-ch' class='e-d' >変更</button>";
                            }

                            echo "</div>";
                        }
                    }


                    if (isset($_POST["bt-ch"])) {
                        if (isset($_POST["nu-ch"])) {
                            $ql = "UPDATE orders set order_quantities=" . $_POST["nu-ch"] . " where table_id=" . $_SESSION['table'] . " and product_id=" . $_POST['pr-id'];

                            if ($_POST["nu-ch"] == 0) {
                                $ql = "delete from orders where table_id=" . $_SESSION['table'] . " and product_id=" . $_POST['pr-id'];
                            }
                            $stmt = $db->prepare($ql);

                            // execute the query
                            $stmt->execute();
                        }
                    }


                    $db = null;
                } catch (PDOException $e) {
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