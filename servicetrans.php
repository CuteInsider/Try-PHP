<!DOCKTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <title> Панель администратора</title>
        <Link href="css/bootstrap.css" rel="stylesheet"></Link>
        <Link href="css/style.css" rel="stylesheet"></Link>
            <?php
            include_once"include/db_connect.php" ;       
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
     <h3>Тип сервиса</h3>
     <form method="post">
        <label for="id_service">Идентификатор сервиса</label> 
         <input type="text" class="form-control" id="id_service" name="idservice">
        <label for="name_service">Название сервиса</label>
         <input type="text" class="form-control" id="name_service" name="nameservice"><br>
    </div>
    <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4"><br><br><br>
    <label for="name_typetr">Тип транспорта</label>
     <select class="Form-control" name="stypetr">
       <?php
        $spisok_typetr = mysqli_query($link,"SELECT * FROM type_trans order by name_typetr asc");
          while ($result=mysqli_fetch_assoc($spisok_typetr))
          if (mysqli_num_rows($spisok_typetr)>0)
          {
           echo '<option value="'.$result["id_typetr"].'">'.$result["name_typetr"].'</option>'; 
          }          
      ?>
     </select>
    <label for="pricetr">Цена в рублях</label> 
     <input type="number" min="0" class="form-control" id="pricetr" name="pricetr"><br><br>
   
    <input type="submit" class="btn btn-primary" name="add_service" value="Добавить">
    <input type="submit" class="btn btn-primary" name="del_service" value="Удалить">
    <input type="submit" class="btn btn-primary" name="chen_service" value="Изменить">
    </div>
    </form>
    <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
     <?php
     if (isset($_POST["add_service"]))
        if (!empty($_POST['idservice']) and (!empty($_POST['nameservice'])) and (!empty($_POST['pricetr'])))
        {
            $id_service=$_POST['idservice'];
            $name_service=$_POST['nameservice'];
            $s_typetr=$_POST['stypetr'];
            $price=$_POST['pricetr'];
            $query=mysqli_query($link, "SELECT * FROM service_trans WHERE (name_service='".$name_service."') AND (id_typetr='".$s_typetr."')");
            $numrows=mysqli_num_rows($query);
            if ($numrows==0)
            {
                $sql="INSERT INTO service_trans (id_service, name_service,id_typetr,price) VALUES ('$id_service','$name_service','$s_typetr','$price')";
                $result=mysqli_query($link, $sql);
            }
            if ($result)
            {
                echo $message="<h4>Запись добавленна!</h4>";
            }
            else
            {
            echo $message="<h4>Запись уже сущевствует!</h4>";    
            }
            }
            else
            {
                echo $message="<h4>Заполните поля!</h4>";
            } 
        
     if(isset($_POST["del_service"]))
       {
         if (!empty($_POST['idservice']))
          {
            $id_service=$_POST['idservice'];
            $query=mysqli_query($link,"Select * FROM service_trans where id_service='".$id_service."'");
            $numrows=mysqli_num_rows($query);
            if(!$numrows==0)
            {
                $sql="delete from service_trans where id_service='$id_service'";
                $result=mysqli_query($link,$sql);
                if($result)
                {
                    echo $message="<h4>Запись удалена</h4>";
                }
                else
                {
                    echo $message="<h4>Не удалось удалить запись</h4>";
                }
            }
         else
         {
            echo $message="<h4>Запись не сушествует!</h4>"; 
         }
        }
        else
        {
            echo $message="<h4>Заполните поле идентификатор!</h4>";
        }
       }  
        
        
 if  (isset($_POST["chen_service"]))
    {
        if(!empty($_POST['idservice']) and !empty($_POST['nameservice']) and !empty($_POST['pricetr']))
        {
            $id_service=$_POST['idservice'];
            $name_service=$_POST['nameservice'];
            $s_typetr=$_POST['stypetr'];
            $price=$_POST['pricetr'];
            $query=mysqli_query($link, "SELECT * FROM service_trans WHERE id_service='".$id_service."'");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM service_trans WHERE (name_service='".$name_service."') and (id_typetr='".$s_typetr."')");
            $numrows1=mysqli_num_rows($query1);
            if(!$numrows==0)
            {
                if($numrows1==0)
                {
                    $result=mysqli_query ($link, "UPDATE service_trans SET name_service='$name_service',id_typetr='$s_typetr', price='$price' WHERE id_service='".$id_service."'");
                    if ($result=='true')
                    { echo $message="<h4>Запись успешно обновлена</h4>";  }
                        
                }
                else 
                {echo $message="<h4>Запись уже существует!</h4>";}
    
            }
            else 
            {echo $message="<h4>Запись не существует!</h4>";}
            
        }
        else
        {echo $message="<h4>Заполните поля</h4>";}

    } 
        
        
    mysqli_query($link,"Set NAmes utf-8");
    if ($res=mysqli_query($link,'Select service_trans.id_service, service_trans.name_service, type_trans.name_typetr, service_trans.price From service_trans Inner join type_trans on type_trans.id_typetr=service_trans.id_typetr Order by service_trans.id_service'))
    {
        echo "<table class='table-striped'>";
        echo "<tr><td><h3>Индентификатор сервиса</h5></td><td ><h3>Название сервиса</h3></td><td><h3>Типы</h3></td><td><h3>Цена</h3></td></tr>";
        while ($pole=mysqli_fetch_array($res))
        {
            echo "<tr><td>".$pole['id_service']."</td><td>".$pole['name_service']."</td><td>".$pole['name_typetr']."</td><td>".$pole['price']."</td></tr>";
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