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










                    $stmt = $db->prepare($sql_menu);
                    $stmt->execute();

                    while ($menu = $stmt->fetch(PDO::FETCH_NUM)) {
                    echo " <input class='extra' type='button' value='$menu[0]'>";
                    
                    }

                ?>

                    <input class='extra' type="button" value="chicken">
                    <input class='extra' type="button" value="minced chicken">
                    <input class='extra' type="button" value="pork">
                    <input class='extra' type="button" value="beff">
                    <input class='extra' type="button" value="a la carte">
                    <input class='extra' type="button" value="vegetable">
                    <input class='extra' type="button" value="一品・サラダ・お食事">
                    <input class='extra' type="button" value="dessert(デザート)">
                    <!-- <input class='extra' type="button" value="beer / sake">
            <input class='extra' type="button" value="shochu">
            <input class='extra' type="button" value="frui liquor / wine">
            <input class='extra' type="button" value="high ball">
            <input class='extra' type="button" value="shochu by the bottle">
            <input class='extra' type="button" value="割りもの">
            <input class='extra' type="button" value="sours">
            <input class='extra' type="button" value="cocktails">
            <input class='extra' type="button" value="softdrink">
            <input class='extra' type="button" value="fresh fruit sours"> -->
            </div>


            <div class="item">
                <!-- <div class="menu"> -->

            <?php

                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    //display data
                    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "<button style='background-image: url(../images/products/$data[0].jpg);'>
                            <h2> $data[1]</h2>
                             <hr>
                             <h3> $data[2]¥</h3>
                             </button>";
                    }
                    $db = null;
                } catch (PDOException $e) {
                    print('database not connected ' . $e->getMessage());
                } catch (Exception $e) {
                    print('予期せぬerorr ' . $e->getMessage());
                }
            ?>
            </div>
            <!-- <div class="confirm"> 
Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse architecto quae, asperiores nostrum totam expedita, vel saepe quasi, alias officia molestias? Architecto ipsa repellat temporibus facilis quos expedita atque vero?
                    <input type="submit" value="確認">
                </div> -->
        </div>




        </div>


    </form>
</body>

</html>