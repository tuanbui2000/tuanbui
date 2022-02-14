<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<html>

<head>
  <title>
    manage
  </title>
  <meta charset="ulf-8">
  <link rel="stylesheet" href="../css/menu.css">
  <style>
    .manage_login input {
      height: 30px;
      border-radius: 12px;

    }

    .manage_login label {
      font-size: 30px;
    }

    .manage_login {


      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .login_button {
      display: block;
      margin: 30px auto;
      border-radius: 12px;
      color: whitesmoke;
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
      padding: 5px 10px;
            font-size: 25px;
            background-image: linear-gradient(to right bottom, #ffa400, #00aefd);
            border: none;
            color: whitesmoke;
         
          
    }

    .err_msg {
      color: whitesmoke;
      font-size: 1.5em;
      text-align: center;
      margin-top: 50px;
    }
    
  

    
    
  </style>
</head>


<body>
  <?php
  try {
    // database connect
    $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //変数初期化
    
    $username = '';
    $password = '';
    if (isset($_POST['login'])) {
      $username = $_POST['username'];
     $password = $_POST['password'];
      $query = $db->prepare("SELECT * FROM employees WHERE username='$username'");
      // $query->bindParam("username", $username, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        $err_msg = 'ユーザー名とパスワードの組み合わせません.';
      } else {
        if (password_verify($password, $result['password'])) {

          $_SESSION['emp_name'] = $result['employee_name']; 
          $_SESSION['user_id'] = $result['id']; 
          $_SESSION['permission'] = $result['permission']; 
          header("location:user_manage.php");
        } else {
          $err_msg = 'ユーザー名とパスワードの組み合わせません.';
        }
      }
    }
  } catch (PDOException $e) {
    // header("location:db_error.php");
    print('database not connected ' . $e->getMessage());
  } catch (Exception $e) {
    print('予期せぬerorr ' . $e->getMessage());
  }
  $db = null;
  ?>



  <form action="" method="POST">
    <div class="container">
      <?php $title = '<h1>管理</h1>';
      include 'ltm.php' ?>

      <div class="item">

      </div>


      <div style="position: relative;" class="item">
        <div class="err_msg">
          <?php if (isset($err_msg)) {
            echo $err_msg;
          } ?></div>
        <div class="manage_login">
          <label> <input type="text" name="username" placeholder="user"></label>
          <label></label><input type="password" name="password" placeholder="password"></label><br>
          <button class="login_button" name="login" type="submit">ログイン</button>

        </div>
      </div>




    </div>


  </form>
</body>

</html>