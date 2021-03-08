<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <title> Панель администратора</title>
        <Link href="css/bootstrap.css" rel="stylesheet"></Link>
        <Link href="css/style.css" rel="stylesheet"></Link>
        <?php include_once"include/db_connect.php"; ?>
    </head>
<body>
    <?php include_once"include/header.php"; ?>
    <div class="container">
    <div class="row"> 
    <?php include_once"include/nav.php"; ?>
    <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
     <h3>Заявки</h3>
     <form method="post">
       
        <label for="id_zayavka">Идентификатор заявки</label> 
         <input type="text" class="form-control" id="id_zayavka" name="id_zayavka">
        
         
        <label for="id_zayavka">Туры</label>  
         <select name="scity" id="" class="Form-control">
         <?php $spisok_turs=mysqli_query($link,"SELECT * FROM City order by id_city asc");
          while ($result=mysqli_fetch_assoc($spisok_turs))
          if (mysqli_num_rows($spisok_turs)>0)
          { echo '<option value="'.$result["id_city"].'">'.$result["name_city"].'</option>'; } ?> 
         </select>
         
        <label for="id_zayavka">e-mail</label>  
         <select name="se_mail" id="" class="Form-control">
         <?php $spisok_e_mail=mysqli_query($link,"SELECT * FROM klient order by e_mail asc");
          while ($result=mysqli_fetch_assoc($spisok_e_mail))
          if (mysqli_num_rows($spisok_e_mail)>0)
          { echo '<option value="'.$result["e_mail"].'">'.$result["e_mail"].'</option>'; } ?> 
         </select>  
         
        <label for="id_zayavka">Клиент</label>  
         <select name="sklient" id="" class="Form-control">
         <?php $spisok_klient=mysqli_query($link,"SELECT * FROM klient order by id_klient asc");
          while ($result=mysqli_fetch_assoc($spisok_klient))
          if (mysqli_num_rows($spisok_klient)>0)
          { echo '<option value="'.$result["id_klient"].'">'.$result["fam"].'</option>'; } ?> 
         </select> 
         
      </div>  
       
        <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4"><br><br><br>
         
        <label for="data_zayavka">Дата заявки</label>
        <input type="date" class="form-control" id="data_zayavka" name="datazayavka"><br>
    
        <label for="desript_zayav">Описание</label>
        <textarea name="desriptzayav" id="descript_zayav" cols="20" rows="4" class="form-control"></textarea><br>
          
         

                                    
       <input type="submit" class="btn btn-primary" name="add_zayv" value="Добавить">
       <input type="submit" class="btn btn-primary" name="del_zayv" value="Удалить" onclick="return confirm('Вы действительно хотите удалить запись?')">
       <input type="submit" class="btn btn-primary" name="chen_zayv" value="Изменить">  
      </div>          
     </form>
  
    </div>
    
    
    
    <?php 
        if (isset($_POST["add_zayv"]))
     {     
        if ( !empty($_POST['id_zayavka']) and !empty($_POST['datazayavka']) )
        {
            $id_zayavka=$_POST['id_zayavka'];
            $id_klient=$_POST['sklient'];
            $id_turs=$_POST['scity'];
            $email=$_POST['se_mail'];
            $data_zayavka=$_POST['datazayavka'];
            $text_zayavka=$_POST['desriptzayav'];    
       
            $query=mysqli_query($link, "SELECT * FROM zayavka WHERE id_zayavka='".$id_zayavka."'");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM klient WHERE (id_klient='".$id_klient."') and (e_mail='".$email."')");
            $numrows1=mysqli_num_rows($query1);
            if ($numrows==0)
            {
              if (!$numrows1==0)
                {  $sql="INSERT INTO zayavka  VALUES('$id_zayavka','$id_klient','$id_turs','$email','$data_zayavka','$text_zayavka')";
                $result=mysqli_query($link, $sql);    
                }         
            }
            else {echo $message="<h3>Запись уже сущевствует!</h3>"; }
        
            if ($result==true)
            {
                echo $message=" <h3>Запись добавленна!</h3>";
            }
            else {echo $message="<h3>Клиент не зарегистрирован!</h3>";}                 
        }
            else
            {
                echo $message="<h3>Заполните поля!</h3>";
            } 
        
     }
        
        
        
     if (isset($_POST["del_zayv"]))
     {
         if (!empty($_POST['id_zayavka']))
         {
            $id_zayavka=$_POST['id_zayavka']; 
            $query=mysqli_query($link, "SELECT * FROM zayavka WHERE id_zayavka='".$id_zayavka."'");
            $numrows=mysqli_num_rows($query);
            if (!$numrows==0)
            {
                $sql="delete from zayavka where id_zayavka='$id_zayavka'";
                $result=mysqli_query($link,$sql);
                if($result)
                {
                  echo $message="<h3>Запись удалена!</h3>";  
                }
                else {echo $message="<h3>Запись не удалось удалить!</h3>";}
                
            }
            else {echo $message="<h3>Запись не сушествует!</h3>";} 
         }
         else {echo $message="<h3>Заполните поля!</h3>";}
             
     }
        
        
     if (isset($_POST["chen_zayv"]))
     {
        if ( !empty($_POST['id_zayavka']) and !empty($_POST['datazayavka']) )
        {
            $id_zayavka=$_POST['id_zayavka'];
            $id_klient=$_POST['sklient'];
            $id_turs=$_POST['scity'];
            $email=$_POST['se_mail'];
            $data_zayavka=$_POST['datazayavka'];
            $text_zayavka=$_POST['desriptzayav'];
            
            $query=mysqli_query($link, "SELECT * FROM zayavka WHERE id_zayavka='".$id_zayavka."'");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM klient WHERE (id_klient='".$id_klient."') and 
            (e_mail='".$email."')");
            $numrows1=mysqli_num_rows($query1);
            if (!$numrows==0)
            {
                if (!$numrows1==0)
                {
                    $result=mysqli_query ($link, "UPDATE zayavka SET id_zayavka='$id_zayavka',id_klient='$id_klient', id_turs='$id_turs',email='$email',data_zayavka='$data_zayavka',text_zayavka='$text_zayavka' WHERE id_zayavka='".$id_zayavka."'");
                }
                
            }
            else {echo $message="<h3>Запись не существует!</h3>";}
            if ($result)
            {
                echo $message="<h3>Запись успешно обновлена</h3>";
            }
        }
        else {echo $message="<h3>Заполните поля!</h3>";} 
     }
        
     mysqli_query($link,"Set NAmes utf-8");
     if ($res=mysqli_query($link,'Select zayavka.id_zayavka, klient.fam, city.name_city, zayavka.email, zayavka.data_zayavka, zayavka.text_zayavka  From ((zayavka Inner join klient on zayavka.id_klient=klient.id_klient)  Inner join city on zayavka.id_turs=city.id_city) Order by zayavka.id_zayavka'))
     {
        echo "<table class='table-striped' width='110%'>";
        echo "<tr><td>Индинфикатор заявки</td><td>Фамалия клиента</td><td>Тур</td><td>Почта</td><td>Дата заявки</td><td>Описание</td></tr>";
        while ($pole=mysqli_fetch_array($res))
        {
            echo "<tr><td>".$pole['id_zayavka']."</td><td>".$pole['fam']."</td><td>".$pole['name_city']."</td><td>".$pole['email']."</td><td>".$pole['data_zayavka']."</td><td>".$pole['text_zayavka']."</td></tr>";
        }
        echo "</table>";
        mysqli_free_result($res);
     }
        
        ?>  
        
          
              
    </div>
</body>
</html>