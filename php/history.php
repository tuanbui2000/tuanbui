<!DOCTYPE html>
<html>

<head>
    <title>
        history
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
</head>


<body>
<form action="" method="POST">
        <div class="container">
            <?php $title = '<h1>管理</h1>';
            include 'ltm.php' ?>

            <div class="item">
                
            </div>

            <!-- menu    -->
            <div class="item">
               <?php
                $sql_syntax='select * from orders';
                include 'dbconnect.php';
              
               ?> 

            </div>




        </div>

    </form>
</body>

</html>