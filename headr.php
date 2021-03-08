
<header>
<div class="container-fluid ">
  <div class="col-lg-4" >
  	<img src="logo/7.jpg" alt="" height="200" width="250">

  </div>
  <div class="col-lg-6 label">
  	<h2>Туристическое агенство</h2>
	  <h2 >ABI-TRAVEL</h2>
  </div>
  <div class="col-lg-2 ">
  	<P><img src="mini/email.jpg" alt="">AIB_TRAVEL@yandex.ru</P>
  	<P><img src="mini/tel.jpg" alt="">+7 950 883 02 12</P>
  	<P><img src="mini/tel.jpg" alt="">ПН-СБ: 10:00 - 20:00</P>
  	<p>Здраствуйте, - <?php if(!empty($_SESSION['auth_user_login'])){echo $_SESSION['user_role'].' '.$_SESSION['auth_user_login'];}else{echo гость} ?></p><br>
  	<input type="submit" name="Login" class="btn btn-primary" value="Личный кабинет" >
  	<input type="submit" name="exit" class="btn btn-primary" value="Выход" >
  </div>
  
</div> 	
<nav class="navbar navbar-default" role="navigation col-">
 <div class="container-fluid">
 
 <div class="navbar-header">
       <ul class="nav nav-tabs nav-justified">
  		<li class=""><a href="com.php">О компании</a></li>
  		<li class=""><a href="kat.php">Каталог туров</a></li>
  		<li class=""><a href="Hotel.php">Отели</a></li>
  		<li class=""><a href="Cont.php">Контакты</a></li>
	   </ul>

 
 </div>
<nav>
</header>