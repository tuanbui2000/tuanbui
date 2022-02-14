<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        login
    </title>
    <meta charset="ulf-8">
    <style>
        body {
            margin: 0%;
            background-image: url("../images/background_login.png");

            background-position: 50% 50%;
            background-size: cover;


        }


        .start {
            color: white;
            width: 20rem;
            height: 10rem;
            background-image: linear-gradient(to right bottom, #3cff00, #66860e);
            position: absolute;
            top: 65%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* -50%x and 50%y */
            font-size: 5rem;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <input type="submit" class='start' name="start" value="開始">
    </form>
    <?php
    //set table
    $_SESSION["table_id"]= 3;


    if (isset($_POST['start'])) {
        //order id process 
        try {
            // database connect
            $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




            $sql = ' SELECT order_id FROM proceeds';
            $stmt = $db->prepare($sql);
            $stmt->execute();

            //display data
            while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                $old_id = max(0, $data[0]);
            }
            $_SESSION['order_id']=$old_id+1 ;
   

            $db->beginTransaction();
            // our SQL statements
            if (isset( $_SESSION['order_id'])) {
                $db->exec("INSERT INTO proceeds(order_id, time)  VALUE (".$_SESSION['order_id'].",CURDATE())");
            }
            // commit the transaction
            $db->commit();


            header("location:menu.php");
        } catch (PDOException $e) {
            $db->rollback();
            header("location:db_error.php");
            print('database not connected ' . $e->getMessage());
        } catch (Exception $e) {
            print('予期せぬerorr ' . $e->getMessage());
            $db = null;
        }
    }
    ?>


</body>

</html>