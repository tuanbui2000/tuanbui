<?php



echo '
<div class="item">
    <img src="../images/logo.png" alt="logo">
</div>

<div class="item">
    '.$title.'

</div>

<div class="item">
    <input type="submit" name="menu" value="メニュー"><br>
    <input type="submit" name="history" value="履歴"> <br>
    <input type="submit" name="manage" value="管理"> <br>
    </div>
    ';
    //menu-bar redirect
    if (isset($_POST['menu'])) {
        header("location:menu.php");
    }
    if (isset($_POST['history'])) {
        header("location:history.php");
    }
    if (isset($_POST['manage'])) {
        header("location:manage.php");
    }
    
    ?>