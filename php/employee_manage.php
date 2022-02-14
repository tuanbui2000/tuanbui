<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        ユーザー管理
    </title>
    <meta charset="ulf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <style>
        .wrap {
            color: whitesmoke;
            border-radius: 12px;
            font-size: 30px;
            min-width: 350px;
            background-color: rgb(221, 143, 143);

        }

        .wrap:hover {
            background-color: indianred;
        }



        .user_id {
            border-radius: 11px 0 0 11px;
            background-color: brown;
            padding: 0 5px;
            margin-left: -5px;
            width: 75px;
            float: left;


        }

        .em_detail {

            border-radius: 12px;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            height: 440px;
            width: 500px;
            position: fixed;
            top: 27%;
            right: 20px;


        }

        .em_detail img {
            display: inline-block;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            margin: 10px;
            background-position: 50% 50%;
            background-size: cover;
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }

        .em_detail h1 {
            margin: 5px 60px;
            background-color: burlywood;
            border-radius: 12px;

        }

        .em_detail button {
            display: inline-block;

            position: relative;
            left: 50%;
            transform: translateX(-90px);
            padding: 5px 20px;
            margin: 20px 5px;
            font-size: 20px;

            border-radius: 12px;


        }

        .e-d {
            padding: 5px 10px;
            font-size: 30px;
            background-image: linear-gradient(to right bottom, #ffa400, #00aefd);
            border: none;
            color: whitesmoke;
            border-radius: 12px;
            margin: 5px;
        }

        .edit-data {
            height: 36px;
            margin-left: 30px;
            font-size: 30px;
            color: whitesmoke;
            position: relative;

        }

        .edit-data input,
        select {
            position: absolute;
            top: 37px;
            left: 150px;

            padding-left: 10px;
            width: 250px;
            height: 30px;
            margin-top: -33px;
            border-radius: 12px;
            border: none;
            color: whitesmoke;
            background-color: burlywood;
            font-size: 30px;
        }
    </style>
</head>


<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="container">




            <div class="item">
                <img src="../images/logo.png" alt="logo">
            </div>

            <div class="item">
                <input name="user_manage" style="border:none; " type="submit" value="ユーザー">
                <input name="products" type="submit" value="商品">
                <input name="menu_manage" type="submit" value="メニュー">
                <input name="proceeds" type="submit" value="売上">

                <?php
                //menu-bar redirect
                if (isset($_POST['user_manage'])) {
                    header("location:user_manage.php");
                }
                if (isset($_POST['products'])) {
                    header("location:products.php");
                }
                if (isset($_POST['menu_manage'])) {
                    header("location:menu_manage.php");
                }
                if (isset($_POST['proceeds'])) {
                    header("location:proceeds.php");
                }
                ?>
            </div>

            <div class="item">

                <input type="submit" style="border:none; margin-top :25px;" name="manage" value="管理"> <br>
            </div>





            <div class="item">
                <!-- menubar -->
                <button name='client' style="padding-inline:20px;" class='extra'>客</button>
                <button name='employees_manage' style="padding-inline:20px; border:none;" class='extra'>従業員</button>
                <button name='signup' style=" position:absolute; right:10px; border:solid; font-size:20px;
                 " class='e-d'>登録</button>
                <?php


                if (isset($_POST['client'])) {
                    header("location:user_manage.php");
                }
                include 'logout.php';  
                ?>

            </div>


            <div class="item">


                <!-- 処理するところ -->

                <?php
                   
                try {
                    // database connect
                    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //here



                    //update
                    if (isset($_POST["ok"])) {
                        if (strlen($_POST['n']) * strlen($_POST['una']) != 0) {
                            $stmt = $db->prepare("UPDATE employees SET employee_name='" . $_POST['n'] . "', username='" . $_POST['una'] . "',permission=" . $_POST['permission'] . " where id=" . $_POST['i']);
                            $stmt->execute();

                            // header("location:employee_manage.php");
                        }
                    }
                    if (isset($_POST['delete'])) {
                        $stmt = $db->prepare("delete from employees where id=" . $_POST['id']);
                        $stmt->execute();

                        // header("location:employee_manage.php");
                    }






                    if (isset($_POST['s-up'])) {

                        //db insert
                        $name = $username = $pass = "";
                        function test_input($data)
                        {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }
                        $query = $db->prepare("SELECT * FROM employees WHERE username ='".$_POST["una"]."'");
                        $query->execute();
                        if ($query->rowCount() > 0) {
                            echo '<h1 style=" text-align:center;">The username is already registered!</h1>';
                        } else{
                        if (isset($_POST["n"]) && strlen($_POST["n"]) > 1) {

                            // check if name only contains letters and whitespace
                            if (preg_match("/^[a-zA-Z-' ]*$/", $_POST["n"])) {
                                $name = test_input($_POST["n"]);

                                if (isset($_POST["una"]) && strlen($_POST["una"]) > 1) {
                                    // check if name only contains letters and whitespace
                                    if (preg_match("/^[a-zA-Z]|[0-9]*$/", $_POST["una"])) {
                                        $username = test_input($_POST["una"]);

                                        if (isset($_POST["pa"]) && strlen($_POST["pa"]) > 1) {
                                            // check if name only contains letters and whitespace
                                            if (preg_match("/^[a-zA-Z]|[0-9]*$/", $_POST["pa"])) {
                                                $pass = test_input($_POST["pa"]);
                                                $password_hash = password_hash($pass, PASSWORD_DEFAULT);
                                                $s = "INSERT into employees(employee_name, username, password, permission) values('$name','$username','$password_hash'," . $_POST['permission'] . ")";
                                                $db->exec($s);
                                                $last_id = $db->lastInsertId();
                                                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '../images/employees/'.$last_id.'.jpg');
                                                echo '<h1 style=" text-align:center;">従業員登録出来ました。!</h1>';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    }





                    //sign up
                    if (isset($_POST['signup'])) {
                        echo "<div class='em_detail'>";

                        echo "  <img src='../images/employees/default.jpg'>";
                        echo '<div style="text-align:center;">Select image:  <input type="file" name="fileToUpload" ></div>';
                        echo "<div class='edit-data'>
                        name: <input name='n' type='text' > </div> 
  <div class='edit-data'>username: <input name='una' type='text'></div> 
  <div class='edit-data'>password: <input name='pa' type='password' ></div> 
  <div class='edit-data'>職務:  <select name='permission' style='font-size:24px;'>
      <option  value='3'>従業員</option>";
      if($_SESSION['permission']<3){
echo"      <option value='2'>マネージャー</option>
      <option  value='1'>boss</option>";}
  echo "</select></div> ";

                        echo "
<button name='s-up' class='e-d'>登録</button>
<button style='height:40px' class='e-d'>cancel</button>
</div>";
                    }


                    //display data
                    $sql = "select * from employees ";
                    if($_SESSION['permission']===3){
                        
                        $sql = "select * from employees where permission = 3 ";
                    } 
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "
                        <div style ='margin:5px 20px;'>
                            <button class='wrap' value='$data[0]' name='emp_de'>
                        
                                 <div class='user_id'>  $data[0]  </div>$data[1] 
                                
                                  
                                  </button> </div>";
                    }


                    //em_detail

                    if (isset($_POST['emp_de'])) {
                        echo "<div class='em_detail'>";
                        $stmt = $db->prepare("SELECT id,employee_name,username,password,permission from employees where id=" . $_POST['emp_de']);
                        $stmt->execute();

                        //display data
                        while ($em = $stmt->fetch(PDO::FETCH_NUM)) {
                            echo "<input name= 'id' type='hidden'value='$em[0]'>";
                            echo "<input name= 'name' type='hidden'value='$em[1]'>";
                            echo "<input name= 'uname' type='hidden'value='$em[2]'>";
                            echo "<input name= 'pass' type='hidden'value='$em[3]'>";
                            echo "<input name= 'per' type='hidden'value='$em[4]'>";
                            if (file_exists('../images/employees/'.$em[0].'.jpg')) {
                            echo "  <img src='../images/employees/$em[0].jpg'>";
                        }else{
                            echo "  <img src='../images/employees/default.jpg'>";
                            }
                             echo "<h1 style='padding-left:60px'>id:   $em[0]</h1>
                            
                           <h1>name:   $em[1]</h1> ";
                        }
                        if($_SESSION['permission']<3){  echo "
                        <button name='change' class='e-d'>変更</button>
                        <button name='delete' class='e-d'>削除</button>";}
                        echo "</div>";
                    }




                    if (isset($_POST['change'])) {
                        echo "<div style='height:700px; top:10%;' class='em_detail'>";
                        echo "<input name= 'i' type='hidden'value='" . $_POST['id'] . "'>";
                        if (file_exists('../images/employees/'.$_POST['id'].'.jpg')) {
                            echo "  <img src='../images/employees/".$_POST['id'].".jpg'>";
                        }else{
                            echo "  <img src='../images/employees/default.jpg'>";
                            }
                            echo "
                      <h1 style='padding-left:60px'>id:" . $_POST['id'] . "</h1>
                      <div class='edit-data' 
                      >name: <input name='n' type='text' value='" . $_POST['name'] . "'></div> 
                      <div class='edit-data' 
                      >username: <input name='una' type='text' value='" . $_POST['uname'] . "'></div> 
                     
                      <div class='edit-data' 
                      >職務: 
                      <select name='permission' style='font-size:24px;width:262px;'>
                          <option ";
                        if ($_POST['per'] == 3) {
                            echo "selected='selected' ";
                        }
                        echo " value='3'>従業員</option>
                          <option ";
                        if ($_POST['per'] == 2) {
                            echo "selected='selected' ";
                        }
                        echo " value='2'>マネージャー</option>
                          <option ";
                        if ($_POST['per'] == 1) {
                            echo "selected='selected' ";
                        }
                        echo " value='1'>boss</option>
                      </select></div> ";

                        echo "
<button name='ok' class='e-d'>変更</button>
<button style='height:40px' class='e-d'>cancel</button>
</div>";
                    }



                    $db = null;
                } catch (PDOException $e) {
                    print('database not connected ' . $e->getMessage());
                } catch (Exception $e) {
                    print('予期せぬerorr ' . $e->getMessage());
                }
                echo "<h1 style=' position:absolute; padding: 0; margin: 0; right:20px; top :25px;  font-size:35px;'>".$_SESSION['emp_name']."</h1>";
                ?>

            </div>



        </div>

    </form>
</body>

</html>