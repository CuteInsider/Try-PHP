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
     <h3>Города</h3>
     <form method="post">
        <label for="id_city">Идентификатор города</label> 
         <input type="text" class="form-control" id="id_city" name="idcity">
        <label for="name_city">Название города</label>
         <input type="text" class="form-control" id="name_city" name="namecity"><br>
        <label for="name_country">Страна</label>
        <select class="Form-control" name="scountry">
         <?php

          $spisok_country = mysqli_query($link,"SELECT * FROM country order by name_country asc");
          while ($result=mysqli_fetch_assoc($spisok_country))
          if (mysqli_num_rows($spisok_country)>0)
          {
           echo '<option value="'.$result["id_country"].'">'.$result["name_country"].'</option>'; 
          }
         ?>
        </select>     
         <br>
          <input type="submit" class="btn btn-primary" name="add_city" value="Добавить">
          <input type="submit" class="btn btn-primary" name="del_city" value="Удалить" onclick="return confirm('Вы действительно хотите удалить запись?')">
          <input type="submit" class="btn btn-primary" name="chen_city" value="Изменить" >
     </form>    
     <?php
      if (isset($_POST["add_city"]))
        if (!empty($_POST['namecity']))
        {
            $id_city=$_POST['idcity'];
            $name_city=$_POST['namecity'];
            $s_country=$_POST['scountry'];
            $query=mysqli_query($link, "SELECT * FROM city WHERE (name_city='".$name_city."') AND (id_country='".$s_country."')");
            $numrows=mysqli_num_rows($query);
            if ($numrows==0)
            {
                $sql="INSERT INTO city (id_city, name_city, id_country) VALUES ('$id_city','$name_city','$s_country')";
                $result=mysqli_query($link, $sql);
            }
            if ($result)
            {
                echo $message="<h3>Запись добавленна!</h3>";
            }
            else
            {
            echo $message="<h3>Запись уже сущевствует!</h3>";    
            }
            }
            else
            {
                echo $message="<h3>Заполните поля!</h3>";
            }
        
      if(isset($_POST["del_city"]))
       {
         if (!empty($_POST['idcity']))
          {
            $id_city=$_POST['idcity'];
            $query=mysqli_query($link,"Select * FROM city where id_city='".$id_city."'");
            $numrows=mysqli_num_rows($query);
            if(!$numrows==0)
            {
                $sql="delete from city where id_city='$id_city'";
                $result=mysqli_query($link,$sql);
                if($result)
                {
                    echo $message="<h3>Запись удалена</h3>";
                }
                else
                {
                    echo $message="<h3>Не удалось удалить запись</h3>";
                }
            }
         else
         {
            echo $message="<h3>Запись не сушествует!</h3>"; 
         }
        }
        else
        {
            echo $message="<h3>Заполните поле идентификатор!</h3>";
        }
       }
        
    if  (isset($_POST["chen_city"]))
    {
        if(!empty($_POST['idcity']) and !empty($_POST['namecity']))
        {
            $name_city=$_POST['namecity'];
            $id_city=$_POST['idcity'];
            $s_country=$_POST['scountry'];
            $query=mysqli_query($link, "SELECT * FROM city WHERE id_city='".$id_city."'");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM city WHERE (name_city='".$name_city."') and (id_country='".$s_country."')");
            $numrows1=mysqli_num_rows($query1);
            if(!$numrows==0)
            {
                if($numrows1==0)
                {
                    $result=mysqli_query ($link, "UPDATE city SET name_city='$name_city',id_country='$s_country' WHERE id_city='".$id_city."'");
                    if ($result=='true')
                    { echo $message="<h3>Запись успешно обновлена</h3>";  }
                        
                }
                else 
                {echo $message="<h3>Запись уже существует!</h3>";    }
    
            }
            else 
            {echo $message="<h3>Запись не существует!</h3>";    }
            
        }
        else
        {echo $message="<h3>Заполните поля</h3>";}

    }
        
    mysqli_query($link,"Set NAmes utf-8");
    if ($res=mysqli_query($link,'Select city.id_city, city.name_city, country.name_country From city Inner join country on country.id_country=city.id_country Order by city.id_city'))
    {
        echo "<table class='table-striped' width='100%'>";
        echo "<tr><td><h5>Индентификатор города</h5></td><td><h5>Название города</h5></td><td><h5>Страна</h5></td></tr>";
        while ($pole=mysqli_fetch_array($res))
        {
            echo "<tr><td>".$pole['id_city']."</td><td>".$pole['name_city']."</td><td>".$pole['name_country']."</td></tr>";
        }
        echo "</table>";
        mysqli_free_result($res);
    }
         ?>
                 
    </div>
    </div>    
    </div>
</body>
</html>