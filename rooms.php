<!DOCKTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <title>Номера </title>
        <Link href="css/bootstrap.css" rel="stylesheet">
        <Link href="css/style.css" rel="stylesheet">
    </head>
<body>
<?php
         include_once "include/db_connect.php";
        ?>
    <?php
    include_once"include/header.php";
    ?>
    <div class="container">
    <div class="row"> 
    <?php
    include_once"include/nav.php";
    ?>
    <div class="col-md-5 col-xs-12 col-sm-5 col-lg-5">
     <h3>Номера</h3>
     <form method="post">
        <label for="id_rooms">Идентификатор номера</label> 
         <input type="text" class="form-control" id="id_rooms" name="idroom">
        <label for="name_rooms">Название номера</label>
        <select name="styperoom" id="" class="Form-control">
         <?php
           $spisok_typeroom=mysqli_query($link,"SELECT * FROM type_room order by name_typeroom asc");
          while ($result=mysqli_fetch_assoc($spisok_typeroom))
          if (mysqli_num_rows($spisok_typeroom)>0)
          {
           echo '<option value="'.$result["id_typeroom"].'">'.$result["name_typeroom"].'</option>'; 
          }     
         ?>
         </select>  
        <label for="name_hotel">Отель</label>
         <select name="shotel" id="" class="Form-control">
         <?php
         $spisok_hotel=mysqli_query($link,"SELECT * FROM hotel order by name_hotel asc");
          while ($result=mysqli_fetch_assoc($spisok_hotel))
          if (mysqli_num_rows($spisok_hotel)>0)
          {
           echo '<option value="'.$result["id_hotel"].'">'.$result["name_hotel"].'</option>'; 
          }     
         ?> 
         </select>
        <label for="price_rooms">Цена в рублях</label>
         <input type="text" class="form-control" id="price_rooms" name="pricerooms">
        <label for="foto_room">Фото</label>
         <input type="text" class="form-control" id="foto_room" name="fotoroom"> 
    <br>      
    <input type="submit" class="btn btn-primary" name="add_room" value="Добавить">
    <input type="submit" class="btn btn-primary" name="del_room" value="Удалить">
    <input type="submit" class="btn btn-primary" name="chen_room" value="Изменить">
     
    </div>

    <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
     <h3>Тип номеров</h3>
     <label for="id_rooms">Идентификатор типа</label> 
      <input type="text" class="form-control" id="" name="idtyperoom">
     <label for="name_rooms">Название номера</label>
      <input type="text" class="form-control" id="" name="namerooms">
      <br>
          <input type="submit" class="btn btn-primary  " name="add_typeroom" value="Добавить тип номера">
     <br>
     <br>
     <input type="submit" class="btn btn-primary  " name="del_typeroom" value="Удалить тип номера">
     <br>
     <br>
     <input type="submit" class="btn btn-primary  " name="chen_typeroom" value="Изменить тип номера"> 
    </div>
    </form>
    
    <?php
    
   
        
        
        
     if (isset($_POST["add_room"]))
     {     
        if (!empty($_POST['idroom']))
        {
            $id_room=$_POST['idroom'];
            $s_typeroom=$_POST['styperoom'];
            $s_hotel=$_POST['shotel'];
            $price_rooms=$_POST['pricerooms'];
            $foto_rooms=$_POST['foto_room'];
       
            $query=mysqli_query($link, "SELECT * FROM rooms WHERE id_rooms='".$id_room."'");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM rooms WHERE (id_typeroom='".$s_typeroom."') and (id_hotel='".$s_hotel."')");
            $numrows1=mysqli_num_rows($query1);
            if (!$numrows==0)
            {
              if ($numrows1==0)
                {  $sql="INSERT INTO rooms (id_rooms,id_typeroom,id_hotel,price,foto_room)  VALUES ('$id_room','$s_typeroom','$s_hotel','$price_rooms','$foto_rooms')";
                $result=mysqli_query($link, $sql);    }
                
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
        
     }
        
      if(isset($_POST["del_room"]))
       {
         if (!empty($_POST['idroom']))
          {
            $id_rooms=$_POST['idroom'];
            $query=mysqli_query($link,"Select * FROM rooms where id_rooms='".$id_rooms."'");
            $numrows=mysqli_num_rows($query);
            if(!$numrows==0)
            {
                $sql="delete from rooms where id_rooms='$id_rooms'";
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
        
     if  (isset($_POST["chen_room"]))
    {
        if(!empty($_POST['idroom']))
        {
            $id_room=$_POST['idroom'];
            $s_typeroom=$_POST['styperoom'];
            $s_hotel=$_POST['shotel'];
            $price_rooms=$_POST['pricerooms'];
            $foto_rooms=$_POST['foto_room'];
            $query=mysqli_query($link, "SELECT * FROM rooms WHERE id_rooms='".$id_room."'");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM rooms WHERE (id_typeroom='".$s_typeroom."') and (id_hotel='".$s_hotel."')");
            $numrows1=mysqli_num_rows($query1);
            if(!$numrows==0)
            {
                if($numrows1==0)
                {
                    $result=mysqli_query ($link, "UPDATE rooms SET id_typeroom='$s_typeroom',id_hotel='$s_hotel',price='$price_rooms', foto_room='$foto_rooms' WHERE id_rooms='".$id_room."'");
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
    
        
     if (isset($_POST["add_typeroom"]))
     {     
        if ((!empty($_POST['idtyperoom'])) and (!empty($_POST['namerooms'])) )
        {
            $id_typeroom=$_POST['idtyperoom'];
            $name_typeroom=$_POST['namerooms'];
            $query=mysqli_query($link, "SELECT * FROM type_room WHERE (id_typeroom='".$id_typeroom."') or (name_typeroom='".$name_typeroom."')");
            $numrows=mysqli_num_rows($query);
            if ($numrows==0)
            {
                $sql="INSERT INTO type_room   VALUES ('$id_typeroom','$name_typeroom')";
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
        
     }
        
    if(isset($_POST["del_typeroom"]))
       {
         if (!empty($_POST['idtyperoom']))
          {
            $id_typeroom=$_POST['idtyperoom'];
            $query=mysqli_query($link,"Select * FROM type_room where id_typeroom='".$id_typeroom."'");
            $numrows=mysqli_num_rows($query);
            if(!$numrows==0)
            {
                $sql="delete from type_room where id_typeroom='$id_typeroom'";
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
        
        
    if  (isset($_POST["chen_typeroom"]))
    {
        if(!empty($_POST['idtyperoom']))
        {
            $id_typeroom=$_POST['idtyperoom'];
            $name_typeroom=$_POST['namerooms'];
            $query=mysqli_query($link, "SELECT * FROM type_room WHERE id_typeroom='".$id_typeroom."'");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM type_room WHERE (id_typeroom='".$id_typeroom."') or (name_typeroom='".$name_typeroom."')");
            $numrows1=mysqli_num_rows($query1);
            if(!$numrows==0)
            {
                if(numrows1==0)
                {
                    $result=mysqli_query ($link, "UPDATE type_room SET id_typeroom='$id_typeroom',name_typeroom='$name_typeroom' WHERE id_typeroom='".$id_typeroom."'");
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
    if ($res=mysqli_query($link,'Select rooms.id_rooms, type_room.name_typeroom, hotel.name_hotel, rooms.price From hotel,type_room,rooms where rooms.id_typeroom=type_room.id_typeroom and rooms.id_hotel=hotel.id_hotel'))
    {
        echo "<table class='table-striped' width='100%'>";
        echo "<tr><td><h5>Индентификатор номера</h5></td><td><h5>Название номера</h5></td><td><h5>Отель</h5></td><td><h5>Цена</h5></td></tr>";
        while ($pole=mysqli_fetch_array($res))
        {
            echo "<tr><td>".$pole['id_rooms']."</td><td>".$pole['name_typeroom']."</td><td>".$pole['name_hotel']."</td><td>".$pole['price']."</td></tr>";
        }
        echo "</table>";
        mysqli_free_result($res);
    }      
             

    ?>    
    </div>    
    </div>
</body>
</html>