<?php

if (isset($_POST['error_process']) &&$_POST['error_process'] == 'yes') {
    session_destroy();
    header('location:login.php');
   
}
if(isset($_POST['logout'])){
    
    echo " <div class='confirm_screen'>
    <div class='blur_content'> </div> <div class='blur_text'>
    <h1>
    ログアウトよろしいですか.</h1><br>
    <button name='error_process' value ='yes'>ok </button>
    <button name='error_process' >cancel</button></div>
    </div>   ";
}
 echo "
 <style>
 .confirm_screen {
    height: 100%;
    z-index: 3;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

.blur_content {
    background-image: url('../images/confirm.jpg');

    /* Add the blur effect */
    filter: blur(8px);
    -webkit-filter: blur(8px);
    height: 100%;


    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.blur_text {
    border-radius: 12px;
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/opacity/see-through */
    color: white;
    font-weight: bold;
    border: 3px solid #f1f1f1;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 4;
    width: 80%;
    padding: 20px;
    text-align: center;
}

.confirm_screen button {
    font-size: 20px;
    height: 55px;
    width: 120px;
    display: inline-block;

    left: 50%;
    transform: translateX(-10px);
    border-radius: 12px;

    background-image: linear-gradient(to right, rgb(223, 114, 114), rgb(155, 43, 43));
    color: whitesmoke;
}
 .logout:hover{
    box-shadow: rgba(100, 100, 111, 1) 0px 7px 29px 0px;
    border:solid whitesmoke;
 }
 </style>";
//  loguot  button 
 echo
 " 
<input type='submit' class='logout' style=' height: 50px;
width: 100px;   border-radius: 50%; 
position: fixed;  
background-image: linear-gradient(to right bottom, #ffa400, #00aefd);
border: none;
color: whitesmoke;
bottom: 50px;

left: 30px;
font-weight: bold ;
font-size: 18px;' name='logout' value='ログアウト' >
";



?>