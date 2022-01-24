<!DOCTYPE html>
<html>

<head>
    <title>
        manage
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


            <div class="item">
<div class="manage_login">
            <label >user: <input type="text" name="user_name"></label>
            <label >password: <input type="text" name="password"></label><br>
            <button name="submit" type="submit">ログイン</button>
            </div>
            </div>
<?php
 if(isset($_POST['submit'] )){
     header('location:user_manage.php');
 }

?>



        </div>


    </form>
</body>

</html>