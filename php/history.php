<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        history
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <style>
        .history {
            display: block;
            margin: 0 auto;
            max-width: max-content;
            text-align: center;
        }

        .submit {
            height: 100px;
            width: 100px;
            size: 100%;
        }
    </style>
</head>


<body>
    <form action="" method="POST">
        <div class="container">
            <?php $title = '<h1>履歴</h1>';
            include 'ltm.php' ?>

            <div class="item">

                <?php

                echo "    <h1> table: xxx  No: " . $_SESSION["order_id"] . "</h1>";
                ?>
            </div>






            <!-- menu    -->
            <div class="item">
                
                <?php

                try {
                    // database connect
                    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




                    // dùng join lấy tên, giá tiền để hiển thị 
                    //tạo một biến phụ để lấy shoukei rồi dùng dó tính tiền


                    $sql = 'SELECT product_id FROM orders WHERE order_id=' . $_SESSION["order_id"];
                    $result = $db->query($sql);

                    if ($result->rowCount() > 0) {

                        $sql_syntax = 'SELECT product_name, order_quantities, product_price  from products inner join orders on products.product_id = orders.product_id where order_id = ' . $_SESSION["order_id"];
                        $stmt = $db->prepare($sql_syntax);
                        $stmt->execute();
                        $sho = 0;
                        //display data
                        echo " <div class='history' >";
                        while ($data = $stmt->fetch(PDO::FETCH_NUM)) {

                            echo " <h1>・ $data[0] : $data[1]個 : $data[2]¥ </h1>";
                            $sho += $data[2];
                        }



                        //total process
                        $zei = $sho / 100 * 8;
                        $go = round($sho + $zei);
                        echo "<h1>";
                        echo "<hr>";
                        echo "小計 :   ¥$sho <br>";
                        echo "(内税対象額  : ¥$sho )<br>";
                        echo " 8%内税    : ¥$zei <br>";
                        echo  " 合計     : ¥$go ";
                        echo "</h1>";
                        echo  "</div>";

                        echo "
                <input type='submit' name='submit' value='会計' style='  height: 50px;
width: 100px;   border-radius: 50%; position: fixed;
    bottom: 50px;
    right: 50px;
size: 100%;'>";
                    }

                    $db = null;
                } catch (PDOException $e) {
                    print('database not connected ' . $e->getMessage());
                } catch (Exception $e) {
                    print('予期せぬerorr ' . $e->getMessage());
                }




                if (isset($_POST['submit'])) {

                  
                    
                   session_destroy();
                    header('location:login.php');
                }
               
                
            

                ?>

            </div>




        </div>

    </form>
</body>

</html>