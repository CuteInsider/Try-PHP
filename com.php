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
</head>
<body>
	<?php
	include_once "headr.php"
	?>
   <div>
    <div class="col-lg-6 com-img">
        <img src="16.jpg" alt="" style="padding-left: 150px;">
    </div>
    <div class="col-lg-6">
    <h2 style="color: blue;">Доверие</h2>
    <p style="color: blue;">Ежегодно нас выбирают более 100000 туристов и 7000 турагентств</p>     
    </div>
   </div>    
</body>
</html>