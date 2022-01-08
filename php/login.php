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
    if (isset($_POST['start'])) {
        header("location:menu.php");
    }
    ?>


</body>

</html>