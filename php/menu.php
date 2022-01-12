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
</head>


<body>
    <form action="" method="POST">
        <div class="container">
            <?php
            $title =
                ' <input name="=kushi" type="submit" value="串">
           <input name="drink" type="submit" value="ドリンク">';
            include 'ltm.php'
            ?>

            <div class="item">
                <?php
                //confirm button process
                if (isset($_POST["confirm-button"])) {
                    header("location:order_confirm.php");
                }
                try {
                    // database connect
                    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    //kushi-drink process

                    if (isset($_POST['drink'])) {
                        $sql = 'select * from products where category_id >10';
                        $sql_menu = 'select category_name from categories where category_id >10;';
                    } else {
                        $sql = 'select * from products where category_id <10';
                        $sql_menu = 'select category_name from categories where category_id <10;';
                    }



                    //xử lí đồ  đã chọn thì dùng style trực tiếp


                    $stmt = $db->prepare($sql_menu);
                    $stmt->execute();

                    while ($menu = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo " <input class='extra' type='button' value='$menu[0]'>";
                    }

                ?>
            </div>


            <div class="item">

                <div class="wrapper">

                <?php

                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    //display data
                    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "<button tupe='submit' value='$data[0]' style='background-image: url(../images/products/$data[0].jpg);' id=$data[0]  name='food'>
                            <h2> $data[1]</h2>
                             <hr>
                             <h2> $data[2]¥</h2>
                             </button>";
                    }



                    // selected process
                    if (isset($_POST['food'])) {
                        $order = $_POST['food'];



                        // to 5th 
                        if (!isset($_SESSION["name1"])) {
                            $_SESSION["name1"] = $order;
                            $_SESSION["value1"] = 0;
                        } else {
                            if (!isset($_SESSION["name2"]) && $_SESSION["name1"] != $order) {
                                $_SESSION["name2"] = $order;
                                $_SESSION["value2"] = 0;
                            } else {
                                if (!isset($_SESSION["name3"]) && $_SESSION["name2"] != $order && $order != $_SESSION["name1"]) {
                                    $_SESSION["name3"] = $order;
                                    $_SESSION["value3"] = 0;
                                } else {
                                    if (!isset($_SESSION["name4"]) && $_SESSION["name3"] != $orderr && $order != $_SESSION["name1"] && $order != $_SESSION["name2"]) {
                                        $_SESSION["name4"] = $order;
                                        $_SESSION["value4"] = 0;
                                    } else {
                                        if (!isset($_SESSION["name5"]) && $_SESSION["name4"] != $orderr && $order != $_SESSION["name1"] && $order != $_SESSION["name2"] && $order != $_SESSION["name3"]) {
                                            $_SESSION["name5"] = $order;
                                            $_SESSION["value5"] = 0;
                                        } else {

                                            // alert
                                            echo "full";
                                        }
                                    }
                                }
                            }
                        }




                        //


                        //if order have been exist
                        if ($_SESSION["name1"] == $order) {
                            $_SESSION["value1"] += 1;
                        } elseif ($_SESSION["name2"] == $order) {
                            $_SESSION["value2"] += 1;
                        } elseif ($_SESSION["name3"] == $order) {
                            $_SESSION["value3"] += 1;
                        } elseif ($_SESSION["name4"] == $order) {
                            $_SESSION["value4"] += 1;
                        } elseif ($_SESSION["name5"] == $order) {
                            $_SESSION["value5"] += 1;
                        } else {
                            //alert
                            echo "fiuc";
                        }
                    }









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
                    //order
                    if (isset($_SESSION["name1"])) {
                        echo " <div class='selected'><img src='../images/products/" . $_SESSION['name1'] . ".jpg' > " . $_SESSION['value1'] . "</div> ";
                    }
                    if (isset($_SESSION["name2"])) {
                        echo " <div class='selected'><img src='../images/products/" . $_SESSION['name2'] . ".jpg' > " . $_SESSION['value2'] . "</div> ";
                    }
                    if (isset($_SESSION["name3"])) {
                        echo " <div class='selected'><img src='../images/products/" . $_SESSION['name3'] . ".jpg' > " . $_SESSION['value3'] . "</div> ";
                    }
                    if (isset($_SESSION["name4"])) {
                        echo " <div class='selected'><img src='../images/products/" . $_SESSION['name4'] . ".jpg' > " . $_SESSION['value4'] . "</div> ";
                    }
                    if (isset($_SESSION["name5"])) {
                        echo " <div class='selected'><img src='../images/products/" . $_SESSION['name5'] . ".jpg' > " . $_SESSION['value5'] . "</div> ";
                    }

                    //confirm button
                    if (isset($_SESSION['name1'])) {
                        echo '<input type="submit" name="confirm-button" value="確認">';
                    }


                    ?>




                </div>
            </div>

        </div>




    </form>


</body>

</html>