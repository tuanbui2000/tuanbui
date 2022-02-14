<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>order_confirm
    </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .order1 {

            color: whitesmoke;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: fixed;
            bottom: 50px;
            right: 50px;
            font-size: 150%;
            background-image: linear-gradient(to right, rgb(226, 218, 102), rgb(43, 155, 43));

        }

        .confirm_display {
            display: grid;

            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));

        }

        .confirm_display h1 {
            width: max-content;
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            font-size: 50px;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 12px;
        }

        .mi_pl_button {
            border-radius: 10px;
            position: relative;


            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0);
            border: none;
            color: rgb(4, 156, 37);
            font-size: 50px;
            padding: 0;
            cursor: pointer;
        }


        .order_confirm {
            margin: 10px;
            background-position: 50% 50%;
            background-size: cover;
            border-radius: 12px;
            width: 200px;
            height: 200px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;


        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <div class="container">
            <?php $title = '<h1>注文確認</h1>';
            include 'ltm.php' ?>

            <div class="item">
                <?php
                if (isset($_POST['order'])) {
                    //database insert here

                    try {


                        // database connect
                        $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // begin the transaction
                        $db->beginTransaction();
                        // our SQL statements


                        if (isset($_SESSION["name1"])) {
                            $query = $db->prepare("SELECT * FROM orders WHERE product_id='" . $_SESSION["name1"] . "'");
                            $query->execute();
                            if ($query->rowCount() > 0) {
                                $stmt = $db->prepare("UPDATE orders set order_quantities=order_quantities+".$_SESSION["value1"]."  WHERE product_id=" . $_SESSION["name1"] . "");
                                $stmt->execute();
                            } else {
                                $db->exec("INSERT INTO orders(order_id,product_id,order_quantities,table_id) VALUE ( " . $_SESSION["order_id"] . "," . $_SESSION["name1"] . "," . $_SESSION["value1"] . "," . $_SESSION["table_id"] . ")");
                            }
                        }
                        //pro_2
                        if (isset($_SESSION["name2"])) {
                            $query = $db->prepare("SELECT * FROM orders WHERE product_id='" . $_SESSION["name2"] . "'");
                            $query->execute();
                            if ($query->rowCount() > 0) {
                                $stmt = $db->prepare("UPDATE orders set order_quantities=order_quantities+".$_SESSION["value2"]."  WHERE product_id=" . $_SESSION["name2"] . "");
                                $stmt->execute();
                            } else {
                                $db->exec("INSERT INTO orders(order_id,product_id,order_quantities,table_id) VALUE ( " . $_SESSION["order_id"] . "," . $_SESSION["name2"] . "," . $_SESSION["value2"] . "," . $_SESSION["table_id"] . ")");
                            }
                        }
                        //pro_3
                        if (isset($_SESSION["name3"])) {
                            $query = $db->prepare("SELECT * FROM orders WHERE product_id='" . $_SESSION["name3"] . "'");
                            $query->execute();
                            if ($query->rowCount() > 0) {
                                $stmt = $db->prepare("UPDATE orders set order_quantities=order_quantities+".$_SESSION["value3"]."  WHERE product_id=" . $_SESSION["name3"] . "");
                                $stmt->execute();
                            } else {
                                $db->exec("INSERT INTO orders(order_id,product_id,order_quantities,table_id) VALUE ( " . $_SESSION["order_id"] . "," . $_SESSION["name3"] . "," . $_SESSION["value3"] . "," . $_SESSION["table_id"] . ")");
                            }
                        }
                        //pro-4
                        if (isset($_SESSION["name4"])) {
                            $query = $db->prepare("SELECT * FROM orders WHERE product_id='" . $_SESSION["name4"] . "'");
                            $query->execute();
                            if ($query->rowCount() > 0) {
                                $stmt = $db->prepare("UPDATE orders set order_quantities=order_quantities+".$_SESSION["value4"]."  WHERE product_id=" . $_SESSION["name4"] . "");
                                $stmt->execute();
                            } else {
                                $db->exec("INSERT INTO orders(order_id,product_id,order_quantities,table_id) VALUE ( " . $_SESSION["order_id"] . "," . $_SESSION["name4"] . "," . $_SESSION["value4"] . "," . $_SESSION["table_id"] . ")");
                            }
                        }
                        //pro_5
                        if (isset($_SESSION["name5"])) {
                            $query = $db->prepare("SELECT * FROM orders WHERE product_id='" . $_SESSION["name5"] . "'");
                            $query->execute();
                            if ($query->rowCount() > 0) {
                                $stmt = $db->prepare("UPDATE orders set order_quantities=order_quantities+".$_SESSION["value5"]."  WHERE product_id=" . $_SESSION["name5"] . "");
                                $stmt->execute();
                            } else {
                                $db->exec("INSERT INTO orders(order_id,product_id,order_quantities,table_id) VALUE ( " . $_SESSION["order_id"] . "," . $_SESSION["name5"] . "," . $_SESSION["value5"] . "," . $_SESSION["table_id"] . ")");
                            }
                        }

                       

                        // commit the transaction
                        $db->commit();
                    } catch (PDOException $e) {
                        // roll back the transaction if something failed
                        $db->rollback();
                        header("location:db_error.php");
                        echo "Error: " . $e->getMessage();
                    }

                    $db = null;




                    unset($_SESSION["name1"]);
                    unset($_SESSION["name2"]);
                    unset($_SESSION["name3"]);
                    unset($_SESSION["name4"]);
                    unset($_SESSION["name5"]);
                    unset($_SESSION["value1"]);
                    unset($_SESSION["value2"]);
                    unset($_SESSION["value3"]);
                    unset($_SESSION["value4"]);
                    unset($_SESSION["value5"]);
                    unset($_SESSION["sql"]);
                    unset($_SESSION["sql_menu"]);


                    header("location:menu.php");
                }
                ?>


            </div>


            <div class="item">
                <div class="confirm_display">
                    <?php



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
                        //menu return
                        if (!isset($_SESSION["name1"])) {
                            header("location:menu.php");
                        }
                    }



                    //data display

                    if (isset($_SESSION["name1"])) {
                        echo    "<div class='order_confirm' style='background-image: url(../images/products/" . $_SESSION['name1'] . ".jpg);'>  <h1   >
                        <button class='mi_pl_button' name='minus' value='1' ><i class='fa fa-minus'></i></button>                       
                        " . $_SESSION['value1'] . "
                        <button class='mi_pl_button' name='plus' value='1'  ><i class='fa fa-plus'></i></button>
                         </h1></div>";
                    }
                    if (isset($_SESSION["name2"])) {
                        echo    "<div class='order_confirm' style='background-image: url(../images/products/" . $_SESSION['name2'] . ".jpg);'>  <h1   >
                        <button class='mi_pl_button' name='minus' value='2' ><i class='fa fa-minus'></i></button>                       
                        " . $_SESSION['value2'] . "
                        <button class='mi_pl_button' name='plus' value='2'  ><i class='fa fa-plus'></i></button>
                         </h1></div>";
                    }
                    if (isset($_SESSION["name3"])) {
                        echo    "<div class='order_confirm' style='background-image: url(../images/products/" . $_SESSION['name3'] . ".jpg);'>  <h1   >
                        <button class='mi_pl_button' name='minus' value='3' ><i class='fa fa-minus'></i></button>                       
                        " . $_SESSION['value3'] . "
                        <button class='mi_pl_button' name='plus' value='3'  ><i class='fa fa-plus'></i></button>
                         </h1></div>";
                    }
                    if (isset($_SESSION["name4"])) {
                        echo    "<div class='order_confirm' style='background-image: url(../images/products/" . $_SESSION['name4'] . ".jpg);'>  <h1   >
                        <button class='mi_pl_button' name='minus' value='4' ><i class='fa fa-minus'></i></button>                       
                        " . $_SESSION['value4'] . "
                        <button class='mi_pl_button' name='plus' value='4'  ><i class='fa fa-plus'></i></button>
                         </h1></div>";
                    }
                    if (isset($_SESSION["name5"])) {
                        echo    "<div class='order_confirm' style='background-image: url(../images/products/" . $_SESSION['name5'] . ".jpg);'>  <h1   >
                        <button class='mi_pl_button' name='minus' value='5' ><i class='fa fa-minus'></i></button>                       
                        " . $_SESSION['value5'] . "
                        <button class='mi_pl_button' name='plus' value='5'  ><i class='fa fa-plus'></i></button>
                         </h1></div>";
                    }

                    ?>

                </div>
                <input type="submit" class="order1" name="order" value="注文">
            </div>



        </div>


</body>

</html>