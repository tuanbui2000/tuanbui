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
    <style>
        .order {
            border:none;
            color: whitesmoke;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: fixed;
            bottom: 50px;
            right: 50px;
            font-size: 150%;
            background-image: linear-gradient( to right,rgb(226, 218, 102) ,rgb(43, 155, 43) );
            
        }
        .order :hover{
            background-image: linear-gradient( to right,rgb(158, 226, 102) ,rgb(13, 163, 81) ); 
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <div class="container">
            <?php $title = '<h1>注文確認</h1>';
            include 'ltm.php' ?>

            <div class="item">



            </div>


            <div class="item">
                <div class="confirm_display">
                    <?php

                    if (isset($_SESSION["name1"])) {
                        echo    "<button style='background-image: url(../images/products/" . $_SESSION['name1'] . ".jpg);'>  <h1> " . $_SESSION['value1'] . "</h1></button>";
                    }
                    if (isset($_SESSION["name2"])) {
                        echo    "<button style='background-image: url(../images/products/" . $_SESSION['name2'] . ".jpg);'>  <h1> " . $_SESSION['value2'] . "</h1></button>";
                    }
                    if (isset($_SESSION["name3"])) {
                        echo    "<button style='background-image: url(../images/products/" . $_SESSION['name3'] . ".jpg);'>  <h1> " . $_SESSION['value3'] . "</h1></button>";
                    }
                    if (isset($_SESSION["name4"])) {
                        echo    "<button style='background-image: url(../images/products/" . $_SESSION['name4'] . ".jpg);'>  <h1> " . $_SESSION['value4'] . "</h1></button>";
                    }
                    if (isset($_SESSION["name5"])) {
                        echo    "<button style='background-image: url(../images/products/" . $_SESSION['name5'] . ".jpg);'>  <h1> " . $_SESSION['value5'] . "</h1></button>";
                    }

                    ?>
                    <input type="submit" class="order" name="order" value="注文">

                </div>
            </div>



        </div>
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
                    $db->exec("INSERT INTO orders VALUES ( " . $_SESSION["order_id"] . "," . $_SESSION["name1"] . "," . $_SESSION["value1"] . ")");
                }
                if (isset($_SESSION["name2"])) {
                    $db->exec("INSERT INTO orders VALUES ( " . $_SESSION["order_id"] . "," . $_SESSION["name2"] . "," . $_SESSION["value2"] . ")");
                }
                if (isset($_SESSION["name3"])) {
                    $db->exec("INSERT INTO orders VALUES ( " . $_SESSION["order_id"] . "," . $_SESSION["name3"] . "," . $_SESSION["value3"] . ")");
                }
                if (isset($_SESSION["name4"])) {
                    $db->exec("INSERT INTO orders VALUES ( " . $_SESSION["order_id"] . "," . $_SESSION["name4"] . "," . $_SESSION["value4"] . ")");
                }
                if (isset($_SESSION["name5"])) {
                    $db->exec("INSERT INTO orders VALUES ( " . $_SESSION["order_id"] . "," . $_SESSION["name5"] . "," . $_SESSION["value5"] . ")");
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

</body>

</html>