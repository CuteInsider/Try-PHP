<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Путевка</title>
        <Link href="css/bootstrap.css" rel="stylesheet"></Link>
        <Link href="css/style.css" rel="stylesheet"></Link>
                <?php include_once"include/db_connect.php"; ?>
		</head>
		<body>
		<?php include_once "include/header.php";
		?>
			<div class="container">
			<div class="row">
				<?php include_once "include/nav.php";
				?>
			<div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
				<h3>Путевка</h3>
				<form method="post">
				<label for="id_voucher">Идентификатор путевки</label>
					<input type="text" class="form-control" id="id_voucher" name="idvoucher">
				<label for="id_zayavka">Идентификатор заявки</label>
					<select class="form-control" name="szayvka" id="" >
                     <?php $spisok_zayvka=mysqli_query($link,"SELECT * FROM zayavka order by id_zayavka asc");
                      while ($result=mysqli_fetch_assoc($spisok_zayvka))
                      if (mysqli_num_rows($spisok_zayvka)>0)
                      { echo '<option value="'.$result["id_zayavka"].'">'.$result["id_zayavka"].'</option>'; } 
                     ?> 
                    </select> 
				<label for="data1_voucher">Дата заезда</label>
					<input type="date" class="form-control" id="data1_voucher" name="data1voucher">
				<label for="data2_voucher">Дата отъезда</label>
					<input type="date" class="form-control" id="data2_voucher" name="data2voucher">
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
				<br><br><br>
			<label for="id_bron">Идентификатор брони</label>
                    <select class="form-control" name="sbron" id="" >
                     <?php $spisok_bron=mysqli_query($link,"SELECT * FROM bron order by id_bron asc");
                      while ($result=mysqli_fetch_assoc($spisok_bron))
                      if (mysqli_num_rows($spisok_bron)>0)
                      { echo '<option value="'.$result["id_bron"].'">'.$result["id_bron"].'</option>'; } 
                     ?> 
                    </select> 	
				<label for="number_ticket">Номер билета</label>
				    <select class="form-control" name="sticket" id="" >
                     <?php $spisok_ticket=mysqli_query($link,"SELECT * FROM ticket order by id_ticket asc");
                      while ($result=mysqli_fetch_assoc($spisok_ticket))
                      if (mysqli_num_rows($spisok_ticket)>0)
                      { 
                          echo '<option value="'.$result["id_ticket"].'">'.$result["number_ticket"].'</option>'; } 
                     ?> 
                    </select>  
				<label for="price_voucher">Цена в рублях</label>
					<input type="text" class="form-control" id="price_voucher" name="pricevoucher">
				<label for="status">Статус путевки</label>
					<input type="text" class="form-control" id="status" name="status">
				<br>
					<input class="btn btn-primary" type="submit" name="add_voucher" value="Добавить">
					<input class="btn btn-primary" type="submit" name="del_voucher" value="Удалить">
					<input class="btn btn-primary" type="submit" name="chen_voucher" value="Изменить">
				</div>
                </form>
			</div>
			<br>

<?php
     if (isset($_POST["add_voucher"]))
        if (!empty($_POST['idvoucher']) and (!empty($_POST['data1voucher'])) and (!empty($_POST['data2voucher'])) and  (!empty($_POST['pricevoucher'])) and (!empty($_POST['status'])))
        {
            $id_voucher=$_POST['idvoucher'];
            $s_zayavka=$_POST['szayvka'];
            $data1_voucher=$_POST['data1voucher'];
            $data2_voucher=$_POST['data2voucher'];
            $s_bron=$_POST['sbron'];
            $s_ticket=$_POST['sticket'];
            $price=$_POST['pricevoucher'];
            $status=$_POST['status'];
            $query=mysqli_query($link, "SELECT * FROM voucher WHERE (id_voucher='".$id_voucher."')");
            $numrows=mysqli_num_rows($query);
            $query1=mysqli_query($link, "SELECT * FROM voucher WHERE (id_ticket='".$s_ticket."')");
            $numrows1=mysqli_num_rows($query1);
            if ($numrows==0)
            {
                if ($numrows1==0)
                {    
                    if ($data1_voucher<=$data2_voucher)
                    {
                        $sql="INSERT INTO voucher  VALUES ('$id_voucher','$s_zayavka','$data1_voucher','$data2_voucher','$s_bron','$s_ticket','$price','$status')";
                        $result=mysqli_query($link, $sql);
                        if ($result)
                        {
                            echo $message="<h3>Запись добавленна</h3>";
                        }
                    }
                    else
                    {
                        echo $message="<h3>Несоответсвие дат!</h3>";
                    }
                }
                else
                {
                    echo $message="<h3>Номер билета выбрать нельзя!</h3>";
                }
             } 
             else
             {
                 echo $message="<h3>Запись уже сущевствует</h3>";
             }
        }
        else
        {
            echo $message="<h3>Заполните поля!</h3>";    
        }
?>
<?php     
     if(isset($_POST["del_voucher"]))
       {
         if (!empty($_POST['idvoucher']))
          {
            $id_voucher=$_POST['idvoucher'];
            $query=mysqli_query($link,"Select * FROM voucher where id_voucher='".$id_voucher."'");
            $numrows=mysqli_num_rows($query);
            if(!$numrows==0)
            {
                $sql="delete from voucher where id_voucher='$id_voucher'";
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
            echo $message="<h3>Заполните индификатор!</h3>";
        }
     }   
?>
<?php
      if (isset($_POST["chen_voucher"]))
        if (!empty($_POST['idvoucher']) and (!empty($_POST['data1voucher'])) and (!empty($_POST['data2voucher'])) and (!empty($_POST['id_bron'])) and (!empty($_POST['pricevoucher'])) and (!empty($_POST['status'])))
        {
            $id_voucher=$_POST['idvoucher'];
            $s_zayavka=$_POST['szayvka'];
            $data1_voucher=$_POST['data1voucher'];
            $data2_voucher=$_POST['data2voucher'];
            $s_bron=$_POST['sbron'];
            $s_ticket=$_POST['sticket'];
            $price=$_POST['pricevoucher'];
            $status=$_POST['status'];
            $query=mysqli_query($link, "SELECT * FROM voucher WHERE (id_voucher='".$id_voucher."')");
            $numrows=mysqli_num_rows($query);
            if (!$numrows==0)
            {
                if ($data1_voucher<=$data2_voucher)
                {    
                    $sql="UPDATE voucher SET id_voucher='$id_klient',id_zayavkd='$fam',data1_voucher='$name_klient', data2_voucher='$adres', id_bron='$phone', id_ticket='$prefer', price='$e_mail', status='$password' WHERE id_voucher='".$id_voucher."'";
                    $result=mysqli_query($link, $sql);
                    if ($result==true)
                    {
                        echo $message="<h3>Запись обновленна</h3>";
                    }
                }
                else
                {
                  echo $message="<h3>Несоответствие дат!</h3>";
                }
            }
            else
            {
                echo $message="<h3>Запись не сущевствует</h3>";
            }
        }
        else
        {
        echo $message="<h3>Заполните поля</h3>";    
        }
?>
<!-- Исправить запрос на вывод таблицы 
     Я вообще не знаю, что там не так  -->
<?php
    mysqli_query($link,"Set Names utf-8");
    if ($res=mysqli_query($link,
                          'SELECT
                           voucher.voucher_id,
                           voucher.id_zayavka,
                           zayavka.id_turs,
                           bron.id_bron,
                           klient.fam,
                           klient.e_mail,
                           type_room.name_typeroom,
                           hotel.name_hotel,
                           city.name_city,
                           voucher.data1_voucher,
                           voucher.data2_voucher,
                           ticket.number_ticket,
                           sevice_trans.name_service,
                           voucher.price,
                           voucher.status
                           FROM
                           voucher,
                           zayavka,
                           bron,
                           turs,
                           rooms,
                           ticket,
                           hotel,
                           city,
                           klient,
                           type_room,
                           service_trans
                           WHERE
                           voucher.id_zayavka=zayavka.id_zayavka
                           AND turs.id_turs=zayavka.id_turs
                           AND bron.id_bron=voucher.id_bron
                           AND bron.id_rooms=rooms.id_rooms
                           AND voucher.id_ticket=ticket.id_ticket
                           AND city.id_city=zayavka.id_turs
                           AND rooms.id_hotel=hotel.id_hotel
                           AND hotel.id_city=city.id_city
                           AND klient.id_klient=zayavka.id_klient
                           AND type_room.id_typeroom=rooms.id_typeroom
                           AND ticket.id_service=service_trans.id_service
                           '))
    {
        echo "<table class='table-striped' width='110%'>";
        echo "<tr>
        <td>ID путевки</td>
        <td >ID заявки</td>
        <td >ID брони</td>
        <td >Клиент</td>
        <td >E-mail</td>
        <td>Номер</td>
        <td>Отель</td>
        <td>Город</td>
        <td>Дата заезда</td>
        <td>Дата отъезда</td>
        <td>№ Билета</td>
        <td>Сервис</td>
        <td>Цена в рублях</td>
        <td>Статус</td>
        </tr>";
        while ($pole=mysqli_fetch_array($res))
        {
            echo "<tr>
            <td>".$pole['id_voucher']."</td>
            <td>".$pole['id_zayavka']."</td>
            <td>".$pole['id_bron']."</td>
            <td>".$pole['fam']."</td>
            <td>".$pole['e_mail']."</td>
            <td>".$pole['name_typeroom']."</td>
            <td>".$pole['name_hotel']."</td>
            <td>".$pole['name_city']."</td>
            <td>".$pole['data1_voucher']."</td>
            <td>".$pole['data2_voucher']."</td>
            <td>".$pole['number_ticket']."</td>
            <td>".$pole['name_service']."</td>
            <td>".$pole['price']."</td>
            <td>".$pole['status']."</td>
            </tr>";
        }
        echo "</table>";
        mysqli_free_result($res);
    }               
?>

			</div>
		</body>
</html>	