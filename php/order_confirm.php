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
</head>

<body>
    <form action="" method="POST">
        <div class="container">
            <?php $title = '<h1>注文確認</h1>';
            include 'ltm.php' ?>

            <div class="item">


             extra
            </div>


            <div class="item">
                
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
<input type="submit"  class="order" name="order" value="注文">
<style>
    .order{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        position: fixed;
    bottom: 50px;
    right: 50px; 
font-size: 100%;

    }
</style>

</div>



        </div>
        <?php
        if (isset($_POST['order'])) {
            # code...

            //database insert here
            
            session_destroy();
            header("location:menu.php");
        }
        ?>

</body>

</html>