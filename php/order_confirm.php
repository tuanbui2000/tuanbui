<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset="utf-8">
    <style>
         /* .contaner{
            display:flex;
            height:100%;
        }   */
        hr{
            size:100%;
        }
        img.kusi{
            width:75px;
            height:100px;
        }
        .d2{
            width:200px;
            height:140px;
            background-color:#ffdead;
            text-align:center;
            margin-left:auto;
            margin-right:auto;
            border-radius: 20px 20px 20px 20px;
            padding:10px 0px 10px 0px;
        }
        .menubtn{
            
            width:100px;
            background-color:#87cefa;
            text-align:center;
            margin-left:auto;
            margin-right:auto;
            border-radius: 20px 20px 20px 20px;
            padding:20px 0px 20px 0px;
        }
        .orderbtn{
            position:absolute;
            right:10px;
            width:100px;
            background-color:#008000;
            color:#ffffff;
            text-align:center;
            margin:0 0 0 auto;
            border-radius: 50px 50px 50px 50px;
            padding:20px 0px 20px 0px;
        }
    </style>
</head>
<body>
    <?php
        try{

          session_start();
          
            
          
          
          
          ?>
          <div class="container">
            <img src="images/logo.png"alt="logo"class="kusi"></img>
            <form action="menu.php"method="POST">
              <input type="button"class="menubtn"value="メニューへ">
              
              <hr>
            </div> 
            
            
            <div class="d1">
              <h1>注文確認</h1>
              <hr>
              
              <?php
            if(isset($GET['productid'])){
              
              
            }
            ?>
          <div class="d2">
            <h2>商品名<?php //echo $productname; ?></h2>
            <hr>
            <h2>価格<?php //sủyou;?></h2>
          </div>
          
          
        </div>
        
            <input type="submit" name="insert" value="確認"class="orderbtn">
          </form>
          
          <?php
          //データベース接続クラスの読み込み    
          require_once "dbconnect.php";
          //Exceptionクラスの読み込み
          include_once 'exce.php';


          if(isset($_POST["insert"])){
$sqll="insert into orders values ($id,'$name',$num) ";
          }
          $dbconnect = new connect();
        }catch(PDOException $e){
          throw new OriginalException($e);
        }
        ?>
</body>
</html>