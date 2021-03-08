<!DOCKTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <title> Панель администратора</title>
        <Link href="css/bootstrap.css" rel="stylesheet"></Link>
        <Link href="css/style.css" rel="stylesheet"></Link>
        <?php include_once"include/db_connect.php"; ?>
        
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
    <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
     <h3>Бронирование</h3>
     <form method="post">
        <label for="id_bron">Идентификатор брони</label> 
         <input type="text" class="form-control" id="id_bron" name="idbron">
        <label for="name_rooms">Номер</label>
         <select name="srooms" id="" class="Form-control">
         <?php $spisok_rooms=mysqli_query($link,"SELECT * FROM rooms order by id_typeroom asc");
          while ($result=mysqli_fetch_assoc($spisok_rooms))
          if (mysqli_num_rows($spisok_rooms)>0)
          { echo '<option value="'.$result["id_rooms"].'">'.$result["id_typeroom"].'</option>'; } ?> 
         </select>

    </div>
    <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4"><br><br><br>
    <label for="data1_bron">Дата заезда</label>
     <input type="date" class="form-control" id="data1_bron" name="data1bron">
    <label for="data2_bron">Дата отьезда</label>
     <input type="date" class="form-control" id="data2_bron" name="data2bron">
   <br>
    
    <input type="submit" class="btn btn-primary" name="add_bron" value="Добавить">
    <input type="submit" class="btn btn-primary" name="del_bron" value="Удалить" onclick="return confirm('Вы действительно хотите удалить запись?')">
    <input type="submit" class="btn btn-primary" name="chen_bron" value="Изменить">
    </div>
    </form>  
    </div>  
    <?php
        if (isset($_POST["add_bron"]))
        {
           if ( !empty($_POST['idbron'])  and !empty($_POST['data1bron']) and !empty($_POST['data2bron']) ) 
           {
             if ($_POST['data1bron'] < $_POST['data2bron'])  
             {
              $id_bron=$_POST['idbron'];
              $id_rooms=$_POST['srooms'];
              $data1_bron=$_POST['data1bron'];
              $data2_bron=$_POST['data2bron'];
              
              $query=mysqli_query($link,"Select * FROM bron where id_bron='".$id_bron."'"); 
              $numrows=mysqli_num_rows($query);
                 
              if ($numrows==0) 
              {
                  $sql="INSERT INTO bron  VALUES('$id_bron','$id_rooms','$data1_bron','$data2_bron')";
                  $result=mysqli_query($link, $sql);
                  
              } else {echo $message="<h3>Запись уже сущевствует!</h3>"; }
              
              if ($result)
              {
                 echo $message=" <h3>Запись добавленна!</h3>"; 
              } else {echo $message="<h3>Запись не добавленна!</h3>";}
            
             } else {echo $message="<h3>Неверный диапозон даты!</h3>"; }
           } else {echo $message="<h3>Заполните поля!</h3>";}
        }
        
        if (isset($_POST["del_bron"]))
        {
            if (!empty($_POST['idbron']))
            {
                $id_bron=$_POST['idbron'];
                $query=mysqli_query($link,"Select * FROM bron where id_bron='".$id_bron."'"); 
                $numrows=mysqli_num_rows($query);
                
                if (!$numrows==0)
                {
                    $sql="delete from  bron where id_bron='$id_bron'";
                    $result=mysqli_query($link,$sql);
                } else {echo $message="<h3>Такой записи не существует!</h3>";}
                
                if ($result)
                {
                   echo $message="<h3>Запись удалена!</h3>"; 
                } else {echo $message="<h3>Не удалось удалить запись!</h3>";}
                
            } else {echo $message="<h3>Заполните поле индетификатора</h3>";}
        }
        
        if (isset($_POST["chen_bron"]))
        {
           if ( !empty($_POST['idbron'])  and !empty($_POST['data1bron']) and !empty($_POST['data2bron']) ) 
           {
              if ($_POST['data1bron'] < $_POST['data2bron']) 
              {
                $id_bron=$_POST['idbron'];
                $id_rooms=$_POST['srooms'];
                $data1_bron=$_POST['data1bron'];
                $data2_bron=$_POST['data2bron'];
                  
                $query=mysqli_query($link,"Select * FROM bron where id_bron='".$id_bron."'"); 
                $numrows=mysqli_num_rows($query);
                  
                if (!$numrows==0)
                {
                    $result=mysqli_query ($link,"UPDATE bron SET id_bron='$id_bron', id_rooms='$id_rooms', data1_bron='$data1_bron', data2_bron='$data2_bron'  WHERE id_bron='".$id_bron."'");
                    
                } else {echo $message="<h3>Такой записи не существует!</h3>";}
                  
                if ($result)  
                {
                    {echo $message="<h3>Запись обновлена!</h3>"; }
                } else {echo $message="<h3>Не удалось обновить!</h3>"; }
                  
              } else {echo $message="<h3>Неверный диапозон даты!</h3>"; }
           } else {echo $message="<h3>Заполните поля!</h3>";}
        }
        
        mysqli_query($link,"Set NAmes utf-8");
        if ($res=mysqli_query($link,'Select bron.id_bron, type_room.name_typeroom, hotel.name_hotel, bron.data1_bron,bron.data2_bron From bron inner join rooms on bron.id_rooms=rooms.id_rooms inner join type_room on type_room.id_typeroom=rooms.id_typeroom inner join hotel on hotel.id_hotel=rooms.id_hotel Order by bron.id_bron'))
        {
            echo "<table class='table-striped' width='110%'>";
            echo "<tr><td>Индинфикатор Брони</td><td>Отель</td><td>Номер</td><td>Дата заезда</td><td>Дата отъезда</td></tr>";
             while ($pole=mysqli_fetch_array($res))
            {
                 echo "<tr><td>".$pole['id_bron']."</td><td>".$pole['name_typeroom']."</td><td>".$pole['name_hotel']."</td><td>".$pole['data1_bron']."</td><td>".$pole['data2_bron']."</td></tr>";
            }
        }
        
    ?>    
    </div>
</body>
</html>