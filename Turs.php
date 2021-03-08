<!DOCKTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <title> Панель администратора</title>
        <Link href="css/bootstrap.css" rel="stylesheet"></Link>
        <Link href="css/style.css" rel="stylesheet"></Link>
        <?php
         include_once"include/db_connect.php";
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
    <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
     <h3>Каталог тура</h3>
     <form method="post" >
        <label for="id_turs">Идентификатор тура</label> 
         <input type="text" class="form-control" id="id_turs" name="idturs">
        <label for="name_city">Город</label>
         <select name="scity" id="" class="Form-control">
         <?php
         $spisok_City=mysqli_query($link,"SELECT * FROM city order by name_city asc");
          while ($result=mysqli_fetch_assoc($spisok_City))
          if (mysqli_num_rows($spisok_City)>0)
          {
           echo '<option value="'.$result["id_city"].'">'.$result["name_city"].'</option>'; 
          }     
         ?> 
         </select>
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
        <label for="count_day">Количество дней</label>                  
        <input type="number" class="form-control" id="count_day" name="countday" min="1"> 
        <label for="price_tur">Цена в рублях</label>
         <input type="number" class="form-control" id="price_tur" name="pricetur" min="1"> 
    </div>
    <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
    <br><h4>Действует</h4>
    <label for="data1_tur">С<input type="date" class="form-control" id="data1_tur" name="data1tur"></label>
    <label for="data2_tur">По<input type="date" class="form-control" id="data2_tur" name="data2tur"></label>
    <label for="desript_tur">Описание</label>
    <textarea name="desripttur" id="descript_tur" cols="20" rows="4" class="form-control"></textarea><br>
    <label for="foto_tur">Фото</label>
     <input type="text" class="form-control" id="foto_room" name="fotoroom">
     
   <br>
    
    <input type="submit" class="btn btn-primary" name="add_tur" value="Добавить">
    <input type="submit" class="btn btn-primary" name="del_tur" value="Удалить" onclick="return confirm('Вы действительно хотите удалить запись?')">
    <input type="submit" class="btn btn-primary" name="chen_tur" value="Изменить">
    </div>
    </form>
    </div> 
    <?php
     if (isset($_POST["add_tur"]))
        if (!empty($_POST['idturs']) and (!empty($_POST['scity'])) and (!empty($_POST['stype_otd'])) and (!empty($_POST['countday'])) and (!empty($_POST['pricetur'])) and (!empty($_POST['data1tur'])) and (!empty($_POST['data2tur']))   )
        {
            $id_turs=$_POST['idturs'];
            $scity=$_POST['scity'];
            $stype_otd=$_POST['stype_otd'];
            $count_day=$_POST['countday'];
            $price=$_POST['pricetur'];
            $data1_tur=$_POST['data1tur'];
            $data2_tur=$_POST['data2tur'];
            $desript_tur=$_POST['desripttur'];
            $photo=$_POST['fotoroom'];
            $query=mysqli_query($link, "SELECT * FROM turs WHERE id_turs='".$id_turs."'");
            $numrows=mysqli_num_rows($query);
            if ($numrows==0)
            {  
                $sql="INSERT INTO turs VALUES ('$id_turs','$scity','$stype_otd','$count_day','$price','$data1_tur','$data2_tur',' $desript_tur','$photo')";
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
        
        if(isset($_POST["del_tur"]))
       {
         if (!empty($_POST['idturs']))
          {
            $id_turs=$_POST['idturs'];
            $query=mysqli_query($link,"Select * FROM turs where id_turs='".$id_turs."'");
            $numrows=mysqli_num_rows($query);
            if(!$numrows==0)
            {
                $sql="delete from turs where id_turs='$id_turs'";
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
            echo $message="<h3>Заполните поле e_mail!</h3>";
        }
       } 
        
         if (isset($_POST["chen_tur"]))
        if (!empty($_POST['idturs']) and (!empty($_POST['scity'])) and (!empty($_POST['stype_otd'])) and (!empty($_POST['countday'])) and (!empty($_POST['pricetur'])) and (!empty($_POST['data1tur'])) and (!empty($_POST['data2tur']))   )
        {
            $id_turs=$_POST['idturs'];
            $scity=$_POST['scity'];
            $stype_otd=$_POST['stype_otd'];
            $count_day=$_POST['countday'];
            $price=$_POST['pricetur'];
            $data1_tur=$_POST['data1tur'];
            $data2_tur=$_POST['data2tur'];
            $desript_tur=$_POST['desripttur'];
            $photo=$_POST['fotoroom'];
            $query=mysqli_query($link, "SELECT * FROM turs WHERE id_turs='".$id_turs."'");
            $numrows=mysqli_num_rows($query);
            
            if (!$numrows==0)
            {  
                $sql="UPDATE turs SET id_turs='$id_turs', id_city='$scity',id_otd='$stype_otd', count_day='$count_day', price='$price', data1_period='$data1_tur', data2_period='$data2_tur', descript='$desript_tur',foto_tur='$photo' WHERE id_turs='".$id_turs."'";
                $result=mysqli_query($link, $sql);
               
            }
            if ($result)
            {
                echo $message="<h3>Запись обновленна!</h3>";
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
        
         mysqli_query($link,"Set Names utf-8");
         if ($res=mysqli_query($link,'Select * From turs Order by id_turs'))
    {
        echo "<table class='table-striped' width='110%'>";
        echo "<tr><td>Индинфикатор тура</td>
        <td >Город</td>
        <td>Тип отдыха</td>
        <td>Количество дней</td>
        <td>Цена</td>
        <td>Действует с</td>
        <td>по</td>
        <td>описание</td>
        <td>Фото</td>
        </tr>";
        while ($pole=mysqli_fetch_array($res))
        {
            echo "<tr>
            <td>".$pole['id_turs']."</td>
            <td>".$pole['id_city']."</td>
            <td>".$pole['id_otd']."</td>
            <td>".$pole['count_day']."</td>
            <td>".$pole['price']."</td>
            <td>".$pole['data1_period']."</td>
            <td>".$pole['data2_period']."</td>
            <td>".$pole['descript']."</td>
            <td>".$pole['foto_tur']."</td>
            </tr>";
        }
        echo "</table>";
        mysqli_free_result($res);
    }        

        ?>   
    </div>
</body>
</html>
