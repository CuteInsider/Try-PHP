<?php session_start();
if ($_SESSION['auth_user'] == "yes_auth") 
{
    if (isset($_GET["logout"])) 
    {
        unset($_SESSION['auth_user']); header("Location: login.php");
    } 
}
else {header("Location: login.php"); }
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
   <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12"> </div>
   <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12"> 
       <form method="post"> 
                    <label>Логин</label>
                    <input type="text" class="form-control" name="login"> 
                    <label>Пароль</label>
                    <input type="password" class="form-control" name="pass"> 
                    <label>ФИО</label>
                    <input type="text" class="form-control" name="fio"> 
                    <label>Должность</label>
                    <input type="text" class="form-control" name="role"> 
                    <label>e-mail</label>
                    <input type="text" class="form-control" name="email"> 
                    <label>Телефон</label>
                    <input type="text" class="form-control" name="phone"><br>
                    <input type="submit" class="btn btn-primary btn-block" value="Добавление" name="submit_add"><br> 
                    </form> 
   </div>
   <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12"> </div>    
    <?php
        if(isset($_POST["submit_add"]))
            {
                if (!$_POST["login"]) echo "<h3>Введите логин!</h3>"; if (!$_POST["pass"]) echo "<h3>Введите пароль!</h3>"; if (!$_POST["fio"]) echo "<h3>Введите ФИО!</h3>";
                    if (!$_POST["role"]) echo "<h3>Введите должность!</h3>"; if (!$_POST["email"]) echo "<h3>Введите E-mail!</h3>";
                        if (!$_POST["phone"]) echo "<h3>Введите телефон!</h3>";
                            if(!empty($_POST["login"]) and !empty($_POST["pass"]) and !empty($_POST["fio"]) and !empty($_POST["role"]) and !empty($_POST["email"]) and !empty($_POST["phone"])) 
                            {
                                $login=$_POST["login"];

                                $query=mysqli_query($link, "SELECT login FROM admin WHERE login='$login1'"); if(mysqli_num_rows($query)>0)
                                {
                                    echo "<h3>Логин занят!</h3><br>"; 
                                }
                                else {$sql=mysqli_query($link,"INSERT INTO admin(login,pass,fio,role,email,phone) VALUES('".$_POST["login"]."','".$_POST["pass"]."','".$_POST["fio"]."','".$_POST["role"]."','".$_POST ["email"]."','".$_POST["phone"]."')");
                                      if ($sql) echo "<h3>Администратор добавлен!</h3>"; }
                            }  
        }
    ?>
</body>
</html>