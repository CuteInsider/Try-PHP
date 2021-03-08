<!DOCKTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <title> Панель администратора</title>
        <Link href="css/bootstrap.css" rel="stylesheet"></Link>
        <Link href="css/style.css" rel="stylesheet"></Link>
        <?php
         include_once "include/db_connect.php";
        ?>
    </head>
<body>
    <?php
    include_once"include/header.php";
    ?>
    <div class="container">
    <div class="row"> 
    <?php
    include_once"include/nav.php";
    ?>
    <div class="col-md-5 col-xs-12 col-sm-5 col-lg-5">
     <h3>Тип отдыха</h3>
     <form method="post">
        <label for="id_otd">Идентификатор типа</label> 
         <input type="text" class="form-control" id="id_otd" name="idotd">
        <label for="name_otd">Тип отдыха</label>
         <input type="text" class="form-control" id="name_otd" name="nameotd"><br>
        <label for="descript_otd">Описание</label>
         <input type="text" class="form-control" id="descript_otd" name="descriptotd"><br> 
          <input type="submit" class="btn btn-primary" name="add_otd" value="Добавить">
          <input type="submit" class="btn btn-primary" name="del_otd" value="Удалить">
          <input type="submit" class="btn btn-primary" name="chen_otd" value="Изменить">
          
     </form>    
    </div>
    <div class="col-md-5 col-xs-12 col-sm-5 col-lg-5">
     <?php
        
         if(isset($_POST["add_otd"]))
  {     
   if(!empty($_POST['idotd']) and !empty($_POST['nameotd']) and !empty($_POST['descriptotd']))
    {
     $id_otd=$_POST['idotd'];
     $name_otd=$_POST['nameotd'];
     $descript_otd=$_POST['descriptotd'];
     $query=mysqli_query($link,"SELECT * FROM type_otd WHERE name_otd='".$name_otd."'");
     $numrows=mysqli_num_rows($query);
     if($numrows==0)
    {
       $sql="INSERT INTO type_otd(id_otd,name_otd,descript_otd)  VALUES('$id_otd','$name_otd','$descript_otd')";
       $result=mysqli_query($link,$sql);
       if($result==true)
        {
         echo "<h3>Запись добавлена!</h3";  
        }
       else 
        {
         echo "<h3>Не удалось добавить!</h3>"; 
        }
      }
     else
      {
       echo "<h3>Запись уже существует!</h3>";  
      }
    }
   else
    {
     echo "<h3>Заполните поля!</h3>";  
    }
      
  }
    

if (isset($_POST["del_otd"]))
{
    if (!empty($_POST['idotd']))
{
        $id_otd=$_POST['idotd'];
        $query=mysqli_query($link, "SELECT * FROM type_otd WHERE id_otd='".$id_otd."'");
        $numrows=mysqli_num_rows($query);
        if(!$numrows==0)
        {
            $sql=("DELETE FROM type_otd WHERE id_otd='".$id_otd."'");
            $result=mysqli_query($link,$sql);
            if ($result)
{
echo $mwssage="<h3>Запись удалена!</h3>";     
}
else
{
echo $message="<h3>Не удалось удалить запись!</h3>";    
}
}
else
{
echo $message = "<h3>Запись не существует!</h3>"; 
}
}
else 
{
echo $message = "<h3>Заполните поле идентификатор!</h3>";     
}
}


if(isset($_POST["chen_otd"])) 
{
if(!empty($_POST['idotd'])	and	!empty($_POST['nameotd']) and !empty($_POST['descriptotd']))
{
$id_otd=$_POST['idotd'];
$name_otd=$_POST['nameotd'];
$descript_otd=$_POST['descriptotd'];
$query=mysqli_query($link, "SELECT * FROM type_otd WHERE id_otd='".$id_otd."'");
$numrows=mysqli_num_rows($query);
$query1=mysqli_query($link,	"SELECT	*	FROM	type_otd	WHERE name_otd='".$name_otd."'");
$numrows1=mysqli_num_rows($query1);
if(!$numrows==0)
{
if($numrows1==0) 
{
$result = mysqli_query ($link, "UPDATE type_otd SET name_otd='$name_otd', descript_otd='$descript_otd' WHERE 
id_otd='".$id_otd."'"); 
if ($result == 'true') 
{
    echo $message="<h3>Запись успешно обновлена!</h3>"; 
}
}
else {
echo $message = "<h3>Запись уже существует!</h3>"; 
}
}
else {
echo $message = "<h3>Запись не существует!</h3>";
}
}
else {
echo  $message  =  "<h3>Заполните  поля!</h3>";  
}
}
    
        mysqli_query($link, "SET NAMES utf-8"); 
if ($res = mysqli_query($link, 'SELECT * FROM `type_otd`')) 
{
echo "<table class='table-striped' width='80%'>";
echo "<tr><td><h4>Идентификатор типа</h4></td><td><h4>Тип отдыха</h4></td><td><h4>Описание</td></h4></tr>";
while ($pole = mysqli_fetch_row($res)) 
{
echo "<tr><td>".$pole[0]."</td><td>".$pole[1]."</td><td>".$pole[2]."</td></tr>";
}
echo "</table>";
}

        ?>
    </div>
    </div>    
    </div>
<?php

    
?>
</body>
</html>