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
        <label for="id_ticket">Идентификатор билет</label> 
         <input type="text" class="form-control" id="id_ticket" name="idticket">
        <label for="name_service">Тип сервиса</label>
         <select name="sservice" id="" class="Form-control">
          <?php
           $spisok_turs=mysqli_query($link,"SELECT * FROM service_trans order by id_service asc");
           while ($result=mysqli_fetch_assoc($spisok_turs))
           if (mysqli_num_rows($spisok_turs)>0)
           { echo '<option value="'.$result["id_service"].'">'.$result["name_service"].'</option>'; }  
          ?>     
         </select>
         
        <label for="name_city">Город</label>
         <select name="scity" id="" class="Form-control">
         <?php $spisok_turs=mysqli_query($link,"SELECT * FROM City order by id_city asc");
          while ($result=mysqli_fetch_assoc($spisok_turs))
          if (mysqli_num_rows($spisok_turs)>0)
          { echo '<option value="'.$result["id_city"].'">'.$result["name_city"].'</option>'; } ?> 
         </select>
        <label for="id_zayavka">Клиент</label>  
         <select name="sklient" id="" class="Form-control">
         <?php $spisok_klient=mysqli_query($link,"SELECT * FROM klient order by id_klient asc");
          while ($result=mysqli_fetch_assoc($spisok_klient))
          if (mysqli_num_rows($spisok_klient)>0)
          { echo '<option value="'.$result["id_klient"].'">'.$result["fam"].'</option>'; } ?> 
         </select>
        <label for="number_ticket">Номер билета</label>
         <input type="text" class="form-control" id="number_ticket" name="numberticket">
    

    </div>
    <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4"><br><br><br>
    <label for="data1_ticket">Дата отправления</label>
     <input type="date" class="form-control" id="data1_ticket" name="data1ticket">
    <label for="time1_ticket">Время отправки</label>
     <input type="time" class="form-control" id="time1_ticket" name="time1ticket">
   <br>

    <label for="data2_ticket">Дата прибытия</label>
     <input type="date" class="form-control" id="data2_ticket" name="data2ticket">
    <label for="time1_ticket">Время прибытия</label>
     <input type="time" class="form-control" id="time2_ticket" name="time2ticket">
   <br>
    <input type="submit" class="btn btn-primary" name="add_ticket" value="Добавить">
    <input type="submit" class="btn btn-primary" name="del_ticket" value="Удалить" onclick="return confirm('Вы действительно хотите удалить запись?')">
    <input type="submit" class="btn btn-primary" name="chen_ticket" value="Изменить">
    </div>
    </form>  
    </div>
    
    <?php
         if (isset($_POST["add_ticket"]))
         {
             if (!empty($_POST['idticket']) and !empty($_POST['numberticket']) and !empty($_POST['data1ticket']) and !empty($_POST['time1ticket']) and !empty($_POST['data2ticket']) and !empty($_POST['time2ticket']) ) 
             {
                if ($_POST['data1ticket'] <= $_POST['data2ticket'])
                {

                        $id_ticket=$_POST['idticket'];
                        $id_service=$_POST['sservice'];
                        $data1_ticket=$_POST['data1ticket'];
                        $time1_ticket=$_POST['time1ticket'];
                        $data2_ticket=$_POST['data2ticket'];
                        $time2_ticket=$_POST['time2ticket'];
                        $id_city=$_POST['scity'];
                        $id_kilent=$_POST['sklient'];
                        $number_ticket=$_POST['numberticket'];
                        
                        $query=mysqli_query($link, "SELECT * FROM ticket WHERE id_ticket='".$id_ticket."'");
                        $numrows=mysqli_num_rows($query);
                        
                        if ($numrows==0)
                        {
                            $sql="INSERT INTO ticket  VALUES('$id_ticket','$id_service','$data1_ticket','$time1_ticket','$data2_ticket','$time2_ticket','$id_city','$id_kilent','$number_ticket')";
                            $result=mysqli_query($link, $sql);
                        } else {echo $message="<h3>Запись уже сущевствует!</h3>"; }
                        
                        if ($result)
                        {
                            echo $message=" <h3>Запись добавленна!</h3>";
                        }
                        else {echo $message="<h3>Запись не добавленна!</h3>";}
                        
                        

                } else {echo $message="<h3>Неверный диапозон даты!</h3>"; }
             }
             else {echo $message="<h3>Заполните поля!</h3>";}
         }
         
         if (isset($_POST["del_ticket"]))
         {
             if (!empty($_POST['idticket']))
             {
                $id_ticket=$_POST['idticket'];
                     
                $query=mysqli_query($link, "SELECT * FROM ticket WHERE id_ticket='".$id_ticket."'");
                $numrows=mysqli_num_rows($query);
                 
                if ($numrows==0)
                {
                    $sql="delete from  ticket where id_ticket='$id_ticket'";
                    $result=mysqli_query($link,$sql);
                }
                 
                if($result)
                {
                    echo $message="<h3>Запись удалена!</h3>";  
                } else {echo $message="<h3>Запись не удалось удалить!</h3>";}
                 
             } else {echo $message="<h3>Заполните поля!</h3>";}
         }
        
         if (isset($_POST["chen_ticket"]))
         {
            if ( !empty($_POST['idticket']) and !empty($_POST['numberticket']) and !empty($_POST['data1ticket']) and !empty($_POST['time1ticket']) and !empty($_POST['data2ticket']) and !empty($_POST['time2ticket']) ) 
            {
                if ($_POST['data1ticket'] <= $_POST['data2ticket'])
                {

                        
                    $id_ticket=$_POST['idticket'];
                    $id_service=$_POST['sservice'];
                    $data1_ticket=$_POST['data1ticket'];
                    $time1_ticket=$_POST['time1ticket'];
                    $data2_ticket=$_POST['data2ticket'];
                    $time2_ticket=$_POST['time2ticket'];
                    $id_city=$_POST['scity'];
                    $id_kilent=$_POST['sklient'];
                    $number_ticket=$_POST['numberticket'];
                        
                    $query=mysqli_query($link,"SELECT * FROM ticket WHERE id_ticket='".$id_ticket."'");
                    $numrows=mysqli_num_rows($query);
                    
                    if (!$numrows==0)
                    {
                        $result=mysqli_query ($link,"UPDATE ticket SET id_service='$id_service', data1_ticket='$data1_ticket' , time1_ticket='$time1_ticket', data2_ticket='$data2_ticket', time2_ticket='$time2_ticket',  id_city='$id_city', id_klient='$id_kilent', number_ticket='$number_ticket'   WHERE id_ticket='".$id_ticket."'");
                        
                    }else {echo $message="<h3>Неверный индефикатор записи!</h3>"; }
                        
                    if ($result)
                    {
                        {echo $message="<h3>Запись обновлена!</h3>"; }
                    }else {echo $message="<h3>Не удалось обновить!</h3>"; }
                        

                } else {echo $message="<h3>Неверный диапозон даты!</h3>"; }
            } else {echo $message="<h3>Заполните поля!</h3>";}
         }
        
        
        mysqli_query($link,"Set NAmes utf-8");
        if ($res=mysqli_query($link,'Select ticket.id_ticket, service_trans.name_service, ticket.data1_ticket, ticket.time1_ticket, ticket.data2_ticket, ticket.time2_ticket, city.name_city, klient.fam, ticket.number_ticket from ticket inner join service_trans on ticket.id_service=service_trans.id_service  Inner join klient on ticket.id_klient=klient.id_klient   inner join city on ticket.id_city=city.id_city Order by id_ticket'))
        {
            echo "<table class='table-striped' width='110%'>";
            echo "<tr><td>Индинфикатор Билета</td><td>Тип сервиса</td><td>Дата отправки</td><td>Время отправки</td><td>Дата приезда</td><td>Время приезда</td><td>Название города</td><td>Фамилия клиента</td><td>Номер билета</td></tr>";
            while ($pole=mysqli_fetch_array($res))
            {
                 echo "<tr><td>".$pole['id_ticket']."</td><td>".$pole['name_service']."</td><td>".$pole['data1_ticket']."</td><td>".$pole['time1_ticket']."</td><td>".$pole['data2_ticket']."</td><td>".$pole['time2_ticket']."</td><td>".$pole['name_city']."</td><td>".$pole['fam']."</td><td>".$pole['number_ticket']."</td></tr>";
            }
        }
        
    ?>    
                    
    </div>
</body>
</html>