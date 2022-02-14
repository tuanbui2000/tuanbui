<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        PHP
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        .confirm_screen {
            height: 100%;
            z-index: 3;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .blur_content {
            background-image: url("../images/confirm.jpg");

            /* Add the blur effect */
            filter: blur(8px);
            -webkit-filter: blur(8px);
            height: 100%;


            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .blur_text {
            border-radius: 12px;
            /* Fallback color */
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/opacity/see-through */
            color: white;
            font-weight: bold;
            border: 3px solid #f1f1f1;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 4;
            width: 80%;
            padding: 20px;
            text-align: center;
        }

        .confirm_screen button {
            font-size: 20px;
            height: 55px;
            width: 120px;
            display: inline-block;

            left: 50%;
            transform: translateX(-10px);
            border-radius: 12px;

            background-image: linear-gradient(to right, rgb(223, 114, 114), rgb(155, 43, 43));
            color: whitesmoke;
        }


        .class {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.6);
            text-align: center;

        }

        .class1 {

            font-size: 50px;
            color: red;
            font-weight: bold;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: max-content;


        }
    </style>
</head>


<body>
    <form action="" method="POST">
        <div class="container">
            <?php
            $title =
                ' <input name="kushi" class="kushi" type="submit" value="串">
           <input name="drink" class="drink" type="submit" value="ドリンク">';
            include 'ltm.php';
            ?>

            <?php
            if (isset($_POST['error_process'])) {
                // echo $_POST['error_process'];
                if ($_POST['error_process'] == 'yes') {

                    header('location:history.php');
                } else {
                    header("location:menu.php");
                }
            } ?>
            <div class="item">
                <?php
                //confirm button process
                if (isset($_POST["confirm-button"])) {
                    header("location:order_confirm.php");
                }
                if (isset($_POST['payment'])) {
                    if (isset($_SESSION["name1"])) {
                        echo " <div class='confirm_screen'>
                       <div class='blur_content'> </div> <div class='blur_text'>
                       <h1>
                       注文している最中で、会計よろしいですか、注文している商品は発注されていません.</h1><br>
                       <button name='error_process' value ='yes'>ok </button>
                       <button name='error_process' >cancel</button></div>
                       </div>   ";
                    } else {
                        header('location:history.php');
                    }
                }
                try {
                    // database connect
                    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




                    //kushi-drink process

                    if (!isset($_SESSION['sql'])) {
                        $_SESSION['sql'] = 'select * from products where category_id <10';
                        $_SESSION['sql_menu'] = 'select category_id,category_name from categories where category_id <10;';;
                    }

                    if (isset($_POST['drink'])) {
                        echo "<style>.drink{border:none; }</style>";
                        $_SESSION['sql'] = 'select * from products where category_id >=10';
                        $_SESSION['sql_menu'] = 'select category_id,category_name from categories where category_id >=10;';
                    } elseif (isset($_POST['kushi'])) {
                        echo "<style>.kushi{border:none; }</style>";
                        $_SESSION['sql'] = 'select * from products where category_id <10';
                        $_SESSION['sql_menu'] = 'select category_id,category_name from categories where category_id <10;';
                    }




                    //extra_memu process
                    if (isset($_POST['extra_menu'])) {

                        if ($_POST['extra_menu'] >= 10) {
                            echo "<style>.drink{border:none; }</style>";
                        } else {
                            echo "<style>.kushi{border:none; }</style>";
                        }

                        $_SESSION['sql'] = "select * from products where category_id =" . $_POST['extra_menu'];
                    }




                    $stmt = $db->prepare($_SESSION['sql_menu']);
                    $stmt->execute();

                    while ($menu = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo " <button class='extra'  name='extra_menu' value='$menu[0]'>$menu[1]</button>";
                    }

                ?>
            </div>


            <div class="item">

                <div class="wrapper">

                <?php

                    $stmt = $db->prepare($_SESSION['sql']);
                    $stmt->execute();
                    //display data
                    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "
                        <button   class='product$data[0]'";
                        if ($data[4] > 4) {
                            echo " value='$data[0]'";
                        } else {
                            echo "value='-1'";
                        }
                        echo "     style='background-image: url(../images/products/$data[0].jpg);' id=$data[0]  name='food'> ";

                        if ($data[4] < 5) {
                            echo "<style>
                                .product$data[0]{
                                    position :relative;
                                   }
                                </style>";
                            echo "<div class='class'><div class='class1'>品切れ</div></div>";
                        } else {
                            echo " <div class='blur_image'> <h2 style='background-color: rgb(0, 0, 0);
background-color: rgba(0, 0, 0, 0.4);border-radius:12px;'> $data[1]</h2>
     <hr>
     <h2>$data[2]¥</h2>
     </div>";
                        }
                        echo "</button>";
                    }



                    // selected process
                    if (isset($_POST['food']) && $_POST['food'] > 0) {
                        $order = $_POST['food'];



                        // to 5th 
                        if (!isset($_SESSION["name1"])) {
                            $_SESSION["name1"] = $order;
                            $_SESSION["value1"] = 0;
                        } elseif (isset($_SESSION["name1"]) && $_SESSION["name1"] != $order) {
                            if (!isset($_SESSION["name2"])) {
                                $_SESSION["name2"] = $order;
                                $_SESSION["value2"] = 0;
                            } elseif (isset($_SESSION["name2"]) && $_SESSION["name2"] != $order && $order != $_SESSION["name1"]) {
                                if (!isset($_SESSION["name3"])) {
                                    $_SESSION["name3"] = $order;
                                    $_SESSION["value3"] = 0;
                                } elseif (isset($_SESSION["name3"]) && $_SESSION["name3"] != $order && $order != $_SESSION["name1"] && $order != $_SESSION["name2"]) {
                                    if (!isset($_SESSION["name4"])) {
                                        $_SESSION["name4"] = $order;
                                        $_SESSION["value4"] = 0;
                                    } elseif (isset($_SESSION["name4"]) && $_SESSION["name4"] != $order && $order != $_SESSION["name1"] && $order != $_SESSION["name2"] && $order != $_SESSION["name3"]) {
                                        if (!isset($_SESSION["name5"])) {
                                            $_SESSION["name5"] = $order;
                                            $_SESSION["value5"] = 0;
                                        } elseif (isset($_SESSION["name5"])) {
                                            if ($_SESSION["name5"] != $order && $_SESSION["name4"] != $order && $order != $_SESSION["name1"] && $order != $_SESSION["name2"] && $order != $_SESSION["name3"]) {
                                                # code...
                                                echo "<script type='text/javascript'>alert('注文できる商品の種類は5種類までです。');</script>";
                                            }
                                            // alert
                                        }
                                    }
                                }
                            }
                        }










                        if (isset($_SESSION["name1"]) && $_SESSION["name1"] == $order && $_SESSION["value1"] < 5) {
                            $_SESSION["value1"] += 1;
                        } elseif (isset($_SESSION["name2"]) && $_SESSION["name2"] == $order && $_SESSION["value2"] < 5) {
                            $_SESSION["value2"] += 1;
                        } elseif (isset($_SESSION["name3"]) && $_SESSION["name3"] == $order && $_SESSION["value3"] < 5) {
                            $_SESSION["value3"] += 1;
                        } elseif (isset($_SESSION["name4"]) && $_SESSION["name4"] == $order && $_SESSION["value4"] < 5) {
                            $_SESSION["value4"] += 1;
                        } elseif (isset($_SESSION["name5"]) && $_SESSION["name5"] == $order && $_SESSION["value5"] < 5) {
                            $_SESSION["value5"] += 1;
                        } else {
                            if (isset($_SESSION["name5"]) && $_SESSION["name5"] == $order || isset($_SESSION["name4"]) && $_SESSION["name4"] == $order || isset($_SESSION["name1"]) && $order == $_SESSION["name1"] || isset($_SESSION["name2"]) && $order == $_SESSION["name2"] || isset($_SESSION["name3"]) && $order == $_SESSION["name3"]) {

                                //alert
                                echo "<script type='text/javascript'>alert('最大注文個数は5個です。');</script>";
                            }
                        }
                    }






                    $result = $db->query('SELECT product_id FROM orders WHERE order_id=' . $_SESSION["order_id"]);
                } catch (PDOException $e) {
                    header("location:db_error.php");
                    print('database not connected ' . $e->getMessage());
                } catch (Exception $e) {
                    print('予期せぬerorr ' . $e->getMessage());
                }
                $db = null;
                ?>
                </div>





                <div class="confirm">

                    <?Php
                    //plus-minus process
                    //plus
                    if (isset($_POST['plus'])) {
                        $plus = $_POST['plus'];
                        $plus_extra = 'value' . $plus;
                        if ($_SESSION[$plus_extra] < 5) {
                            $_SESSION[$plus_extra] += 1;
                        } else {
                            echo "<script type='text/javascript'>alert('最大注文個数は5個です。');</script>";
                        }
                    }
                    //minus
                    if (isset($_POST['minus'])) {
                        $minus = $_POST['minus'];
                        $minus_extra = 'value' . $minus;

                        $_SESSION[$minus_extra] -= 1;

                        if ($_SESSION[$minus_extra] == 0) {
                            $minus_name = 'name' . $minus;
                            unset($_SESSION[$minus_name]);
                            unset($_SESSION[$minus_extra]);
                        }
                        if (!isset($_SESSION["name1"]) && isset($_SESSION["name2"])) {
                            $_SESSION["name1"] = $_SESSION["name2"];
                            $_SESSION["value1"] = $_SESSION["value2"];
                            unset($_SESSION['name2']);
                            unset($_SESSION['value2']);
                        }
                        if (!isset($_SESSION["name2"]) && isset($_SESSION["name3"])) {
                            $_SESSION["name2"] = $_SESSION["name3"];
                            $_SESSION["value2"] = $_SESSION["value3"];
                            unset($_SESSION['name3']);
                            unset($_SESSION['value3']);
                        }
                        if (!isset($_SESSION["name3"]) && isset($_SESSION["name4"])) {
                            $_SESSION["name3"] = $_SESSION["name4"];
                            $_SESSION["value3"] = $_SESSION["value4"];
                            unset($_SESSION['name4']);
                            unset($_SESSION['value4']);
                        }
                        if (!isset($_SESSION["name4"]) && isset($_SESSION["name5"])) {
                            $_SESSION["name4"] = $_SESSION["name5"];
                            $_SESSION["value4"] = $_SESSION["value5"];
                            unset($_SESSION['name5']);
                            unset($_SESSION['value5']);
                        }
                    }



                    //order
                    if (isset($_SESSION["name1"]) && isset($_SESSION["value1"]) && $_SESSION["value1"] > 0) {

                        echo " <div class='selected'>
                        <img src='../images/products/" . $_SESSION['name1'] . ".jpg' > 
                        <button name='minus' value='1' class='btn'><i class='fa fa-minus'></i></button>
                        <button type='text' class='btn1'>" . $_SESSION['value1'] . "</button>
                        <button name='plus' value='1' class='btn' ><i class='fa fa-plus'></i></button>
                        </div> ";
                    }
                    if (isset($_SESSION["name2"]) && isset($_SESSION["value2"]) && $_SESSION["value2"] > 0) {
                        echo " <div class='selected'>
                        <img src='../images/products/" . $_SESSION['name2'] . ".jpg' > 
                        <button name='minus' value='2' class='btn'><i class='fa fa-minus'></i></button>
                        <button type='text' class='btn1'>" . $_SESSION['value2'] . "</button>
                        <button name='plus' value='2' class='btn' ><i class='fa fa-plus'></i></button>
                        </div> ";
                    }
                    if (isset($_SESSION["name3"]) && isset($_SESSION["value3"]) && $_SESSION["value3"] > 0) {
                        echo " <div class='selected'>
                        <img src='../images/products/" . $_SESSION['name3'] . ".jpg' > 
                        <button name='minus' value='3' class='btn'><i class='fa fa-minus'></i></button>
                        <button type='text' class='btn1'>" . $_SESSION['value3'] . "</button>
                        <button name='plus' value='3' class='btn' ><i class='fa fa-plus'></i></button>
                        </div> ";
                    }
                    if (isset($_SESSION["name4"]) && isset($_SESSION["value4"]) && $_SESSION["value4"] > 0) {
                        echo " <div class='selected'>
                        <img src='../images/products/" . $_SESSION['name4'] . ".jpg' > 
                        <button name='minus' value='4' class='btn'><i class='fa fa-minus'></i></button>
                        <button type='text' class='btn1'>" . $_SESSION['value4'] . "</button>
                        <button name='plus' value='4' class='btn' ><i class='fa fa-plus'></i></button>
                        </div> ";
                    }
                    if (isset($_SESSION["name5"]) && isset($_SESSION["value5"]) && $_SESSION["value5"] > 0) {
                        echo " <div class='selected'>
                        <img src='../images/products/" . $_SESSION['name5'] . ".jpg' > 
                        <button name='minus' value='5' class='btn'><i class='fa fa-minus'></i></button>
                        <button type='text' class='btn1'>" . $_SESSION['value5'] . "</button>
                        <button name='plus' value='5' class='btn' ><i class='fa fa-plus'></i></button>
                        </div> ";
                    }





                    //confirm button
                    if (isset($_SESSION['name1']) || isset($_SESSION['name2']) || isset($_SESSION['name3']) || isset($_SESSION['name4']) || isset($_SESSION['name5'])) {
                        echo '<input type="submit" name="confirm-button" value="確認">';
                    }



                    //payment button

                    if ($result->rowCount() > 0) {
                        echo "
                    <input type='submit' name='payment' value='会計' style='  height: 60px;
                    width: 120px;   border-radius: 50%; position: fixed;
                        bottom: 50px;
                        left: 80px;
                        font-size: 120%;color:whitesmoke;'>";
                    }

                    ?>




                </div>
            </div>

        </div>




    </form>


</body>

</html>