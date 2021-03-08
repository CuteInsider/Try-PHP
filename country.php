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
     <h3>Страны</h3>
     <form method="post">
        <label for="id_country">Идентификатор страны</label> 
         <input type="text" class="form-control" id="id_country" name="idcountry">
         <label for="name_country">Название страны</label>
         <input type="text" class="form-control" id="name_country" name="namecountry"><br>
         <input type="submit" class="btn btn-primary" name="add_country" value="Добавить">
         <input type="submit" class="btn btn-primary" name="del_country" value="Удалить">
         <input type="submit" class="btn btn-primary" name="chen_country" value="Изменить">
          
     </form>    
    </div>
    <div class="col-md-5 col-xs-12 col-sm-5 col-lg-5">
      <?php
    

if(isset($_POST["add_country"])) 
{
if(!empty($_POST['idcountry'])	and	!empty($_POST['namecountry']))
{
$name_country = $_POST['namecountry']; 
$id_country	=	$_POST['idcountry'];
$query=mysqli_query($link,	"SELECT	*	FROM	country	WHERE name_country='".$name_country."'"); 
$numrows=mysqli_num_rows($query); 
if($numrows==0) 
{
$sql="INSERT INTO country(id_country,name_country) VALUES('$id_country','$name_country')";
$result=mysqli_query($link,$sql); 
if($result) 
{
echo "<h3>Запись добавлена!</h3>"; 
}
else {
echo "<h3>Не удалось добавить!</h3>"; 
}
}
else {
echo "<h3>Запись уже существует!</h3>"; 
}
}
else {
echo "<h3>Заполните поля!</h3>"; 
}
}
    
    
if(isset($_POST["del_country"])) 
{
if(!empty($_POST['idcountry'])) 
{
$id_country = $_POST['idcountry']; 
$query=mysqli_query($link, "SELECT * FROM country WHERE id_country='".$id_country."'");
$numrows=mysqli_num_rows($query); 
if(!$numrows==0) 
{
$sql="DELETE FROM country WHERE id_country='$id_country'"; 
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

        

if(isset($_POST["chen_country"])) 
{
if(!empty($_POST['idcountry'])	and	!empty($_POST['namecountry']))
{
$name_country = $_POST['namecountry']; 
$id_country	=	$_POST['idcountry'];
$query=mysqli_query($link, "SELECT * FROM country WHERE id_country='".$id_country."'");
$numrows=mysqli_num_rows($query);
$query1=mysqli_query($link,	"SELECT	*	FROM	country	WHERE name_country='".$name_country."'");
$numrows1=mysqli_num_rows($query1);
if(!$numrows==0)
{
if($numrows1==0) 
{
$result = mysqli_query ($link, "UPDATE country SET name_country='$name_country' WHERE 
id_country='".$id_country."'"); 
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
if ($res = mysqli_query($link, 'SELECT * FROM `country`')) 
{
echo "<table class='table-striped' width='80%'>";
echo "<tr><td><h4>Идентификатор страны</h4></td><td><h4>Название страны</h4></td></tr>";
while ($pole = mysqli_fetch_assoc($res)) 
{
echo "<tr><td>".$pole['id_country']."</td><td>".$pole['name_country']."</td></tr>";
}
echo "</table>";
}


    

 ?>

    </div>
   </div>
  </div>
 </body>
</html>