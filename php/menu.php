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
</head>


<body>
    <form action="" method="POST">
        <div class="container">
            <?php
            $title =
                ' <input name="kushi" type="submit" value="串">
           <input name="drink" type="submit" value="ドリンク">';
            include 'ltm.php';
            ?>

            <div class="item">
                <?php
                //confirm button process
                if (isset($_POST["confirm-button"])) {
                    header("location:order_confirm.php");
                }
                if (isset($_POST['payment'])) {
                    header('location:history.php');
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
                        $_SESSION['sql'] = 'select * from products where category_id >10';
                        $_SESSION['sql_menu'] = 'select category_id,category_name from categories where category_id >10;';
                    } elseif (isset($_POST['kushi'])) {
                        $_SESSION['sql'] = 'select * from products where category_id <10';
                        $_SESSION['sql_menu'] = 'select category_id,category_name from categories where category_id <10;';
                    }




                    //extra_memu process
                    if (isset($_POST['extra_menu'])) {

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
                    
                        <button   class='product$data[0]'  value='$data[0]' style='background-image: url(../images/products/$data[0].jpg);' id=$data[0]  name='food'> 
                        <div class='blur_image'>     
                        <h2> $data[1]</h2>
                             <hr>
                             <h2>$data[2]¥</h2>
                             </div>
                             </button>";
                    }



                    // selected process
                    if (isset($_POST['food'])) {
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


                    $db = null;
                } catch (PDOException $e) {
                    print('database not connected ' . $e->getMessage());
                } catch (Exception $e) {
                    print('予期せぬerorr ' . $e->getMessage());
                }
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
                        <button name='minus' value='1' class='btn'><i class='fa fa-minus'></i></button>1
                        <button type='text' class='btn1'>" . $_SESSION['value1'] . "</button>
                        <button name='plus' value='1' class='btn' ><i class='fa fa-plus'></i></button>
                        </div> ";
                    }
                    if (isset($_SESSION["name2"]) && isset($_SESSION["value2"]) && $_SESSION["value2"] > 0) {
                        echo " <div class='selected'>
                        <img src='../images/products/" . $_SESSION['name2'] . ".jpg' > 
                        <button name='minus' value='2' class='btn'><i class='fa fa-minus'></i></button>2
                        <button type='text' class='btn1'>" . $_SESSION['value2'] . "</button>
                        <button name='plus' value='2' class='btn' ><i class='fa fa-plus'></i></button>
                        </div> ";
                    }
                    if (isset($_SESSION["name3"]) && isset($_SESSION["value3"]) && $_SESSION["value3"] > 0) {
                        echo " <div class='selected'>
                        <img src='../images/products/" . $_SESSION['name3'] . ".jpg' > 
                        <button name='minus' value='3' class='btn'><i class='fa fa-minus'></i></button>3
                        <button type='text' class='btn1'>" . $_SESSION['value3'] . "</button>
                        <button name='plus' value='3' class='btn' ><i class='fa fa-plus'></i></button>
                        </div> ";
                    }
                    if (isset($_SESSION["name4"]) && isset($_SESSION["value4"]) && $_SESSION["value4"] > 0) {
                        echo " <div class='selected'>
                        <img src='../images/products/" . $_SESSION['name4'] . ".jpg' > 
                        <button name='minus' value='4' class='btn'><i class='fa fa-minus'></i></button>4
                        <button type='text' class='btn1'>" . $_SESSION['value4'] . "</button>
                        <button name='plus' value='4' class='btn' ><i class='fa fa-plus'></i></button>
                        </div> ";
                    }
                    if (isset($_SESSION["name5"]) && isset($_SESSION["value5"]) && $_SESSION["value5"] > 0) {
                        echo " <div class='selected'>
                        <img src='../images/products/" . $_SESSION['name5'] . ".jpg' > 
                        <button name='minus' value='5' class='btn'><i class='fa fa-minus'></i></button>5
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
                    <input type='submit' name='payment' value='会計' style='  height: 50px;
                    width: 100px;   border-radius: 50%; position: fixed;
                        bottom: 50px;
                        left: 80px;
                        size: 100%;'>";
                    }

                    ?>




                </div>
            </div>

        </div>




    </form>


</body>

</html>