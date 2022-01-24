
<!DOCTYPE html>
<html>

<head>
    <title>
        login
    </title>
    <meta charset="ulf-8">
    <style>
        body {
  background-image: linear-gradient( to right , rgb(223, 170, 100)  , rgb(223, 119, 105) );
       
         
        }


        .error_mess{
            
           position: absolute;
           top: 50%;
           left: 50%;
           transform: translate(-50%,-50%);
  
        }
        h1{
            color: whitesmoke;
            font-size: 50px;
        }
        input{
            display: inline-block;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            border-radius: 12px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border: none;
            background-color: rgb(30, 122, 197);
            font-size: 25px;
            color :whitesmoke;
        }
    </style>
</head>

<body>
<form action="" method="post">
 





<div class="error_mess">
<h1 style="margin-left: 15px;">エラーが発生しました.</h1>
<h1 >従業員をお呼びください.</h1>
<input name="previous" type="submit" value="ログイン画面へ">


</div>
</form>
<?php
if(isset($_POST['previous'])){
    header("location:login.php");
}
?>


</body>

</html>