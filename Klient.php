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
     <h3>Информация о клиентах</h3>
     <form method="post">
        <label for="id_klient">Индификатор клиента</label> 
         <input type="text" class="form-control" id="id_klient" name="idklient">
        <label for="fam">Фамилия клиента</label>
         <input type="text" class="form-control" id="fam" name="fam">
        <label for="nam_klient">Имя клиента</label>
         <input type="text" class="form-control" id="nam_klient" name="namklient">
        <label for="otch_klient">Отчество клиента</label>
         <input type="text" class="form-control" id="otch_klient" name="otchklient">
        <label for="adres">Адрес</label>
         <input type="text" class="form-control" id="adres" name="adres"> 
                   
       
      </div> 
      
      <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
       <br><br><br>
        <label for="phone">Телефон</label>
         <input type="text" class="form-control" id="phone" name="phone"> 
        <label for="prefer">Предпочтения</label>
         <input type="text" class="form-control" id="prefer" name="prefer">            
        <label for="e_mail">E-mail</label>
         <input type="text" class="form-control" id="e_mail" name="email">
        <label for="password">Пароль</label>
         <input type="text" class="form-control" id="passw" name="passklient">
        <br><br><br>       
         <input type="submit" class="btn btn-primary" name="add_klient" value="Добавить">
         <input type="submit" class="btn btn-primary" name="del_klient" value="Удалить" onclick="return confirm('Вы действительно хотите удалить запись?')">
         <input type="submit" class="btn btn-primary" name="chen_klient" value="Изменить">
      </div>    
            
    </form>    

    </div>
        <?php
     if (isset($_POST["add_klient"]))
        if (!empty($_POST['idklient']) and (!empty($_POST['fam'])) and (!empty($_POST['namklient'])) and (!empty($_POST['otchklient'])) and (!empty($_POST['phone'])) and (!empty($_POST['email'])) and (!empty($_POST['passklient']))   )
        {
            $id_klient=$_POST['idklient'];
            $fam=$_POST['fam'];
            $name_klient=$_POST['namklient'];
            $otch=$_POST['otchklient'];
            $adres=$_POST['adres'];
            $phone=$_POST['phone'];
            $prefer=$_POST['prefer'];
            $e_mail=$_POST['email'];
            $password=$_POST['passklient'];
            $query=mysqli_query($link, "SELECT * FROM klient WHERE (id_klient='".$id_klient."')");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM klient WHERE (e_mail='".$e_mail."')");
            $numrows1=mysqli_num_rows($query1);
            if ($numrows==0)
            {
                if ($numrows1==0)
                {    
                $sql="INSERT INTO klient  VALUES ('$id_klient','$fam','$name_klient','$otch','$adres','$phone','$prefer','$e_mail','$password')";
                $result=mysqli_query($link, $sql);
                }
                else
                {
                  echo $message="<h3>Клиент с таким email уже существует!</h3>";
                }
            } else { $message="<h3>Такой индефикатор уже существует!</h3>";}
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
        
        
     if(isset($_POST["del_klient"]))
       {
         if (!empty($_POST['email']))
          {
            $e_mail=$_POST['email'];
            $query=mysqli_query($link,"Select * FROM klient where e_mail='".$e_mail."'");
            $numrows=mysqli_num_rows($query);
            if(!$numrows==0)
            {
                $sql="delete from klient where e_mail='$e_mail'";
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
        
        
        
        
        
     if (isset($_POST["chen_klient"]))
        if (!empty($_POST['idklient']) and (!empty($_POST['fam'])) and (!empty($_POST['namklient'])) and (!empty($_POST['otchklient'])) and (!empty($_POST['phone'])) and (!empty($_POST['email'])) and (!empty($_POST['passklient']))   )
        {
            $id_klient=$_POST['idklient'];
            $fam=$_POST['fam'];
            $name_klient=$_POST['namklient'];
            $otch=$_POST['otchklient'];
            $adres=$_POST['adres'];
            $phone=$_POST['phone'];
            $prefer=$_POST['prefer'];
            $e_mail=$_POST['email'];
            $password=$_POST['passklient'];
            $query=mysqli_query($link, "SELECT * FROM klient WHERE (id_klient='".$id_klient."')");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM klient WHERE (e_mail='".$e_mail."') and (id_klient<>'".$id_klient."')");
            $numrows1=mysqli_num_rows($query1);
            if (!$numrows==0)
            {
                if (!$numrows1==0)
                {    
                $sql="UPDATE klient SET id_klient='$id_klient',fam='$fam',name='$name_klient', adres='$adres', phone='$phone', preference='$prefer', e_mail='$e_mail', passw='$password' WHERE e_mail='".$e_mail."'";
                $result=mysqli_query($link, $sql);
                }
                else
                {
                  echo $message="<h3>Клиент с таким email уже существует!</h3>";
                }
            }
            if ($result)
            {
                echo $message="<h3>Запись обнавлена!</h3>";
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
        
      
         mysqli_query($link,"Set NAmes utf-8");
         if ($res=mysqli_query($link,'Select * From Klient Order by id_klient'))
    {
        echo "<table class='table-striped' width='110%'>";
        echo "<tr><td>Индинфикатор клиента</td><td >Фамалия клиента</td><td>Имя клиента</td><td>Отчество клиента</td><td>Адрес</td><td>Телефон</td><td>Предпочтения</td><td>e-mail</td></tr>";
        while ($pole=mysqli_fetch_array($res))
        {
            echo "<tr><td>".$pole['id_klient']."</td><td>".$pole['fam']."</td><td>".$pole['name']."</td><td>".$pole['otch']."</td><td>".$pole['adres']."</td><td>".$pole['phone']."</td><td>".$pole['preference']."</td><td>".$pole['e_mail']."</td></tr>";
        }
        echo "</table>";
        mysqli_free_result($res);
    }
    
    ?>
    </div>


</body>
</html>