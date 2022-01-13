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
                <input type="submit" class="order" name="order" value="注文">
                <style>
                    .order {
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
            //database insert here

            try {
              // database connect
              $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
              $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // begin the transaction
                $db->beginTransaction();
                // our SQL statements
            if(isset($_SESSION["name1"])){
            $db->exec("INSERT INTO orders VALUES ( ".$_SESSION["order_id"].",".$_SESSION["name1"].",".$_SESSION["value1"].")");}
            if(isset($_SESSION["name2"])){
            $db->exec("INSERT INTO orders VALUES ( ".$_SESSION["order_id"].",".$_SESSION["name2"].",".$_SESSION["value2"].")");}
            if(isset($_SESSION["name3"])){
            $db->exec("INSERT INTO orders VALUES ( ".$_SESSION["order_id"].",".$_SESSION["name3"].",".$_SESSION["value3"].")");}
            if(isset($_SESSION["name4"])){
            $db->exec("INSERT INTO orders VALUES ( ".$_SESSION["order_id"].",".$_SESSION["name4"].",".$_SESSION["value4"].")");}
            if(isset($_SESSION["name5"])){
            $db->exec("INSERT INTO orders VALUES ( ".$_SESSION["order_id"].",".$_SESSION["name5"].",".$_SESSION["value5"].")");}
            

                // commit the transaction
                $db->commit();

              } catch(PDOException $e) {
                // roll back the transaction if something failed
                $db->rollback();
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
            
           
             header("location:menu.php");
        }
        ?>

</body>

</html>