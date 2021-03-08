<?php
$db_host ='localhost';
$db_user = 'root';
$db_pass = '';
$db_database = '1';

@$link=mysqli_connect($db_host,$db_user,$db_pass,$db_database);
If (!mysqli_connect_errno())
    mysqli_query($link,'SET NAMES utf8');
else
{
    echo 'Ошибка подключения';
    exit;
}
?>