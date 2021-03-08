<?php
session_start(); include("db_connect.php");
if (isset($_POST["enter_user"]))
if(!empty($_POST["input_login"]) and !empty($_POST["input_pass"])) 
{
    $login = $_POST["input_login"]; $pass = $_POST["input_pass"];
    $result = mysqli_query($link, "SELECT * FROM admin WHERE login = '$login' AND pass = '$pass'");

    if (mysqli_num_rows($result) > 0) 
    {
        $row = mysqli_fetch_array($result);
 
        $_SESSION['auth_user'] = 'yes_auth'; 
        $_SESSION['auth_user_id'] = $row["id_admin"]; 
        $_SESSION['auth_user_login'] = $row["login"];

        header("Location: index.php"); 
    }
    else {echo $msgerror = "<h3>Неверный логин и(или) пароль!</h3>"; }
} else {echo $msgerror = "<h3>Заполните все поля!</h3>"; }
if(isset($_POST["enter_reg"]))
{
  header("Location: reg.php");   
}
?>
<!docktype html>
<html>
	<head>
        
        <meta charset="UTF-8">
        <title>Номера </title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="Style.css" rel="stylesheet">
         <?php
         include_once "db_connect.php";
        ?>
</head>
<body>
  <?php
	include_once "headr.php"
  ?>
  <div class="row">
<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12"> </div>
<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12"> 
<form method="post">
<h3>Введите логин и пароль</h3>
<input type="text" class="form-control" placeholder="Логин" autofocus name="input_login"><br> 
<input type="password" class="form-control" placeholder="Пароль" name="input_pass"><br> 
<input type="submit" class="btn btn-primary btn-block" value="Войти" name="enter_user">
<input type="submit" class="btn btn-primary btn-block" value="Зарегистриватся" name="enter_reg">
</form>
</div>
<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12"> </div>
 </div>
</body>
</html>