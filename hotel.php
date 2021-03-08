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
    <div>
      <div class="col-lg-6">
        <h2 style="padding-left: 10px;">Поиск отеля</h2>
        <form method="post">
            <div class="col-lg-4">
            <label for="scity">Город</label>
            <select class="form-control" style="width: 200px;" name="scity">
              <?php
                $spisok_city = mysqli_query($link,"SELECT * FROM city order by name_city asc");
                while ($result=mysqli_fetch_assoc($spisok_city))
                if (mysqli_num_rows($spisok_city)>0)
                {
                echo '<option value="'.$result["id_city"].'">'.$result["name_city"].'</option>'; 
                }         
                ?> 
            </select>
            </div>
            <div class="col-lg-4">
            <label for="star">Количество звезд</label>
            <input class="form-control" style="width: 202px;" type="number" name="star" min="1" max="5"><br>
            <input type="submit" name="searchhotel" class="btn btn-primary" value="Найти отель">
            <input type="submit" name="all" class="btn btn-primary" value="Все отели">
            </div>	  
	    </form>
	    <?php
          if(isset($_POST["all"]))
          {
              mysqli_query($link,"Set Names utf-8");
        if ($res=mysqli_query($link,'Select hotel.id_hotel, hotel.name_hotel, city.name_city, hotel.stars, hotel.foto_hotel From hotel Inner join city on city.id_city=hotel.id_city Order by hotel.id_hotel'))
        {
            echo "<table class='table-striped' cellspacing='200px'>";
            echo "<tr>
            <td><h3>Индентификатор отеля</h5></td>
            <td ><h3>Название отеля</h3></td>
            <td><h3>Город</h3></td>
            <td><h3>Звезды</h3></td>
            <td><h3>Фото отеля</h3></td>
            </tr>";
            while ($pole=mysqli_fetch_array($res))
            {
            echo "<tr>
            <td>".$pole['id_hotel']."</td>
            <td>".$pole['name_hotel']."</td>
            <td>".$pole['name_city']."</td>
            <td>".$pole['stars']."</td>
            <td><img src=images/hotel/".$pole['foto_hotel']."></td>
            </tr>";
            }
            echo "</table>";
            mysqli_free_result($res);
        }   
          }
          
          if(isset($_POST["searchhotel"]))
          {
              if(!empty($_POST["star"]))
              {
                  $city = $_POST['scity'];
                  $star = $_POST['star'];
                  $res=mysqli_query($link,"Select hotel.id_hotel, hotel.name_hotel, city.name_city, hotel.stars, hotel.foto_hotel From hotel Inner join city on city.id_city = hotel.id_city where city.id_city ='".$city."' and hotel.stars = '".$star."'  Order by hotel.id_hotel");
                  if(mysqli_num_rows($res)>0)
                  {
                    echo "<table class='table-striped' cellspacing='200px'>";
                    echo "<tr>
                    <td><h3>Индентификатор отеля</h5></td>
                    <td ><h3>Название отеля</h3></td>
                    <td><h3>Город</h3></td>
                    <td><h3>Звезды</h3></td>
                    <td><h3>Фото отеля</h3></td>
                    </tr>";
                    while ($pole=mysqli_fetch_array($res))
                    {
                        echo "<tr>
                        <td>".$pole['id_hotel']."</td>
                        <td>".$pole['name_hotel']."</td>
                        <td>".$pole['name_city']."</td>
                        <td>".$pole['stars']."</td>
                        <td><img src=images/hotel/".$pole['foto_hotel']."></td>
                        </tr>";
                    }
                    echo "</table>";
                    mysqli_free_result($res);
                }
                  else{echo $msg = "<h3>Отель не найден!</h3>";}
              }
              else{echo $msg = "Введите количество звезд";}
          }
        ?>
      </div>
      <div class="col-lg-6" >
         <h2>Поиск номера</h2>
         <form action="" method="post">
          <div class="col-lg-4">
            <label for="">Отель</label>
            <select name="shotel" id="" style="width: 219px;" class="Form-control">
             <?php
                $spisok_hotel=mysqli_query($link,"SELECT * FROM hotel order by name_hotel asc");
                while ($result=mysqli_fetch_assoc($spisok_hotel))
                if (mysqli_num_rows($spisok_hotel)>0)
                {
                echo '<option value="'.$result["id_hotel"].'">'.$result["name_hotel"].'</option>'; 
                }     
                ?> 
            </select>
          </div>
          <div class="col-lg-4" style=" " >
            <label for="star">Количество звезд</label>
            <input class="form-control" style="width: 219px;" type="number" name="chena" min="1" ><br>
            <input type="submit" name="searchroom" class="btn btn-primary" value="Найти номер">
            <input type="submit" name="all1" class="btn btn-primary" value="Все номера">  
          </div>
          </form>
          <?php
           if(isset($_POST["all1"]))
              {
                mysqli_query($link,"Set NAmes utf-8");
                if ($res=mysqli_query($link,'Select rooms.id_rooms, type_room.name_typeroom, hotel.name_hotel, rooms.price, rooms.foto_room From hotel,type_room,rooms where rooms.id_typeroom=type_room.id_typeroom and rooms.id_hotel=hotel.id_hotel'))
                {
                    echo "<table class='table-striped' width='100%'>";
                    echo "<tr><td><h5>Индентификатор номера</h5></td><td><h5>Название номера</h5></td><td><h5>Отель</h5></td><td><h5>Цена</h5></td><td>Фото</td></tr>";
                    while ($pole=mysqli_fetch_array($res))
                    {
                        echo "<tr><td>".$pole['id_rooms']."</td><td>".$pole['name_typeroom']."</td><td>".$pole['name_hotel']."</td><td>".$pole['price']."</td><td><img src=images/room/".$pole['foto_room']."></td></tr>";
                    }
                    echo "</table>";
                    mysqli_free_result($res);
                }      
              }
          if(isset($_POST["searchroom"]))
          {
              if(!empty($_POST["chena"]))
              {
                $chena = $_POST["chena"];
                $hotel = $_POST["shotel"];  
                $res=mysqli_query($link,"Select rooms.id_rooms, type_room.name_typeroom, hotel.name_hotel, rooms.price, rooms.foto_room From rooms Inner join hotel on hotel.id_hotel=rooms.id_hotel Inner join type_room on type_room.id_typeroom=rooms.id_typeroom  where hotel.id_hotel=".$hotel." and rooms.price<=".$chena."");
                if(mysql_num_rows($res)>0) 
                {
                    echo "<table class='table-striped' width='100%'>";
                    echo "<tr>
                    <td><h5>Индентификатор номера</h5></td>
                    <td><h5>Название номера</h5></td>
                    <td><h5>Отель</h5></td>
                    <td><h5>Цена</h5></td>
                    <td>Фото</td>
                    </tr>";
                    while ($pole=mysqli_fetch_array($res))
                    {
                        echo "<tr>
                        <td>".$pole['id_rooms']."</td>
                        <td>".$pole['name_typeroom']."</td>
                        <td>".$pole['name_hotel']."</td>
                        <td>".$pole['price']."</td>
                        <td><img src=images/room/".$pole['foto_room']."></td>
                        </tr>";
                    }
                    echo "</table>";
                    mysqli_free_result($res); 
                }else {echo $msg = "Номер не найден";}
              }else {echo $msg = "Укажите цену";}
          }
                  
          ?>
      </div>
      <div>
	        
      </div>
    </div>
</body>
</html>