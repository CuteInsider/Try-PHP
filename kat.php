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
      <form action="" method="post">
      <h2></h2>
	  <div class="col-lg-12">
	      <div class="col-lg-2">
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
          <div class="col-lg-2">
	        <label for="name_otd">Тип отдыха</label>
            <select name="stype_otd" id="" class="Form-control">
             <?php
                $spisok_otd=mysqli_query($link,"SELECT * FROM type_otd order by name_otd asc");
                while ($result=mysqli_fetch_assoc($spisok_otd))
                if (mysqli_num_rows($spisok_otd)>0)
                {
                    echo '<option value="'.$result["id_otd"].'">'.$result["name_otd"].'</option>'; 
                }     
            ?> 
         </select>  
	      </div>
	      <div class="col-lg-2">
            <label for="">Количество дней</label>
	        <input type="number" min="1" name="days" class="Form-control">  
	      </div>
	      <div class="col-lg-2">
	        <label for="">Цена</label>
	        <input type="number" min="1" name="chena" class="Form-control">  
	      </div>
	      <div class="col-lg-2">
           <label for="">Дата начала</label>    
	       <input type="date" name="date1" class="Form-control">
	      </div>
	      <div class="col-lg-2">
	       <label for="">Дата окончания</label>    
	       <input type="date" name="date2" class="Form-control"><br>
	       <input type="submit" class="btn btn-primary" name="searchTyrs" value="Поиск туры">
	       <input type="submit" class="btn btn-primary" name="all" value="Показать все">
	      </div>
            <?php
                if(isset($_POST["all"]))
                {
                    mysqli_query($link,"Set Names utf-8");
         $res=mysqli_query($link,'Select turs.id_turs, city.name_city, turs.id_otd, turs.count_day, turs.price, turs.data1_period, turs.data2_period, turs.descript, turs.foto_tur From turs inner join city on turs.id_city=city.id_city  Order by id_turs');
    {
        echo "<table class='table-bordered' width='100%'>";
        echo "<tr><td>Индинфикатор тура</td>
        <td >Город</td>
        <td>Тип отдыха</td>
        <td>Количество дней</td>
        <td>Цена</td><td>Действует с</td>
        <td>по</td>
        <td>описание</td>
        <td>Фото</td>
        </tr>";
        while ($pole=mysqli_fetch_array($res))
        {
            echo "<tr>
            <td>".$pole['id_turs']."</td>
            <td>".$pole['name_city']."</td>
            <td>".$pole['id_otd']."</td>
            <td>".$pole['count_day']."</td>
            <td>".$pole['price']."</td>
            <td>".$pole['data1_period']."</td>
            <td>".$pole['data2_period']."</td>
            <td>".$pole['descript']."</td>
            <td><img src=images/tur/".$pole['foto_tur']."></td>
            </tr>";
        }
        echo "</table>";
        mysqli_free_result($res);
    }    
                }
          
    if(isset($_POST['searchTyrs']))
    {
        if(!empty($_POST['days']) and !empty($_POST['chena']) and !empty($_POST['date1']) and !empty($_POST['date2']))
        {
            if($_POST['date2']>$_POST['date1'])
            {
            $city = $_POST['scity'];
            $type = $_POST['stype_otd'];
            $chena = $_POST['chena'];
            $days = $_POST['days'];
            $data1 = $_POST['date1'];
            $data2 = $_POST['date2'];
            $res=mysqli_query($link,"Select turs.id_turs, city.name_city, turs.id_otd, turs.count_day, turs.price, turs.data1_period, turs.data2_period, turs.descript, turs.foto_tur From turs inner join city on turs.id_city=city.id_city Where turs.id_city = '".$city."' and turs.id_otd = ".$type." and turs.count_day <= ".$days." and turs.price <= ".$chena." and turs.data1_period >= '".$data1."' and turs.data2_period <= '".$data2."'");
            if(mysqli_num_rows($res)>0)
            {
                       echo "<table class='table-bordered' width='100%'>";
        echo "<tr><td>Индинфикатор тура</td>
        <td >Город</td>
        <td>Тип отдыха</td>
        <td>Количество дней</td>
        <td>Цена</td><td>Действует с</td>
        <td>по</td>
        <td>описание</td>
        <td>Фото</td>
        </tr>";
        while ($pole=mysqli_fetch_array($res))
        {
            echo "<tr>
            <td>".$pole['id_turs']."</td>
            <td>".$pole['name_city']."</td>
            <td>".$pole['id_otd']."</td>
            <td>".$pole['count_day']."</td>
            <td>".$pole['price']."</td>
            <td>".$pole['data1_period']."</td>
            <td>".$pole['data2_period']."</td>
            <td>".$pole['descript']."</td>
            <td><img src=images/tur/".$pole['foto_tur']."></td>
            </tr>";
        }
        echo "</table>";
        mysqli_free_result($res); 
            }
            }else{echo $msg = "Неверный диапозон даты";}
            
            
        } 
    }
            ?>
	      </div>
	     	   </form>	 
	  </div>
</body>
</html>