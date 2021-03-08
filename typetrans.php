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
     <h3>Тип транспорта</h3>
     <form method="post">
        <label for="id_typetr">Идентификатор типа транспорта</label> 
         <input type="text" class="form-control" id="id_typetr" name="idtypetr">
        <label for="name_typetr">Тип транспорта</label>
         <input type="text" class="form-control" id="name_typetr" name="nametypetr"><br>
         <input type="submit" class="btn btn-primary" name="add_tr" value="Добавить">
         <input type="submit" class="btn btn-primary" name="del_tr" value="Удалить">
         <input type="submit" class="btn btn-primary" name="chen_tr" value="Изменить">
          
     </form>    
    </div>
        <div class="col-md-5 col-xs-12 col-sm-5 col-lg-5">
     <?php
            
if(isset($_POST["add_tr"]))
  {     
   if(!empty($_POST['idtypetr']) and !empty($_POST['nametypetr']))
    {
     $id_typetr=$_POST['idtypetr'];
     $name_typetr=$_POST['nametypetr'];
     $query=mysqli_query($link,"SELECT * FROM type_trans WHERE name_typetr='".$name_typetr."'");
     $numrows=mysqli_num_rows($query);
     if($numrows==0)
    {
       $sql="INSERT INTO type_trans(id_typetr,name_typetr)  VALUES('$id_typetr','$name_typetr')";
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
    
    
if(isset($_POST["del_tr"])) 
{
if(!empty($_POST['idtypetr'])) 
{
$id_typetr = $_POST['idtypetr']; 
$query=mysqli_query($link, "SELECT * FROM type_trans WHERE id_typetr='".$id_typetr."'");
$numrows=mysqli_num_rows($query); 
if(!$numrows==0) 
{
$sql="DELETE FROM type_trans WHERE id_typetr='$id_typetr'"; 
$result=mysqli_query($link,$sql); 
if($result) 
{
echo $message="<h3>Запись удалена!</h3>"; 
}
else {
echo $message="<h3>Не удалось удалить запись!</h3>"; 
}
}
else {
echo $message = "<h3>Запись не существует!</h3>"; 
}
}
else {
echo $message = "<h3>Заполните поле идентификатор!</h3>"; 
}
}


if(isset($_POST["chen_tr"])) 
{
if(!empty($_POST['idtypetr'])	and	!empty($_POST['nametypetr']))
{
$id_typetr=$_POST['idtypetr'];
$name_typetr=$_POST['nametypetr'];
$query=mysqli_query($link, "SELECT * FROM type_trans WHERE id_typetr='".$id_typetr."'");
$numrows=mysqli_num_rows($query);
$query1=mysqli_query($link,	"SELECT	*	FROM	type_trans	WHERE name_typetr='".$name_typetr."'");
$numrows1=mysqli_num_rows($query1);
if(!$numrows==0)
{
if($numrows1==0) 
{
$result = mysqli_query ($link, "UPDATE type_trans SET name_typetr='$name_typetr' WHERE 
id_typetr='".$id_typetr."'"); 
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
if ($res = mysqli_query($link, 'SELECT * FROM `type_trans`')) 
{
echo "<table class='table-striped' >";
echo "<tr><td><h5>Идентификатор типа транспорта</h5></td><td><h5>Тип транспорта</h5></td></tr>";
while ($pole = mysqli_fetch_assoc($res)) 
{
echo "<tr><td>".$pole['id_typetr']."</td><td>".$pole['name_typetr']."</td></tr>";
}
echo "</table>";
}

        ?>
    </div>
    </div>
        
    </div>

</body>
</html>