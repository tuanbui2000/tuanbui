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
        .time {
            color: whitesmoke;
            font-size: 20px;
            margin: 3px;
            display: inline-block;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 12px;
            padding: 5px 20px;
            border: dashed grey;
        }

        .history {
            display: block;
            margin: 0 auto;
            max-width: max-content;
            text-align: center;
        }

        .submit {
              height: 70px;
width: 150px;   border-radius: 50%; 
background-image: linear-gradient( to right,rgb(226, 218, 102) ,rgb(43, 155, 43) );
box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; position: fixed;
    bottom: 50px;
    right: 50px;
font-size: 150%; color:whitesmoke;
        }
     
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
    background-color: rgb(0, 0, 0);
    /* Fallback color */
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

    background-image: linear-gradient( to right,rgb(223, 114, 114) ,rgb(155, 43, 43) );
    color: whitesmoke;
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



                    $sql = 'SELECT product_id FROM orders WHERE order_id=' . $_SESSION["order_id"];
                    $result = $db->query($sql);

                    if ($result->rowCount() > 0) {

                        $sql_syntax = 'SELECT product_name, order_quantities, product_price  from products inner join orders on products.product_id = orders.product_id where order_id = ' . $_SESSION["order_id"];
                        $stmt = $db->prepare($sql_syntax);
                        $stmt->execute();
                        $sho = 0;
                        //display data
                        date_default_timezone_set("japan");
                        echo "<div class='time'>" . date("Y年m月d日    h:i") . "</div>";
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
                <input type='submit' class='submit' name='submit' value='会計' >";
                    }

                    $db = null;
                } catch (PDOException $e) {
                    header("location:db_error.php");
                    print('database not connected ' . $e->getMessage());
                } catch (Exception $e) {
                    print('予期せぬerorr ' . $e->getMessage());
                }


                //payment_confirm
                if (isset($_POST['error_process'])) {
                    echo $_POST['error_process'];
                    if ($_POST['error_process'] == 'yes') {
    
                        session_destroy();
                    header('location:login.php');
                    } else {
                        header("location:history.php");
                    }
                } 

                //submit process
                if (isset($_POST['submit'])) {




                    echo " <div class='confirm_screen'>
                    <div class='blur_content'> </div> <div class='blur_text'>
                    <h1>
                    会計よろしいですか.</h1><br>
                    <button name='error_process' value ='yes'>ok </button>
                    <button name='error_process' >cancel</button></div>
                    </div>   ";

                   
                }




                ?>

            </div>




        </div>

    </form>
</body>

</html>