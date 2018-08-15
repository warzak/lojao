<?php
//conectando com mysql
$host = "172.17.0.1";
$db_name = "lojao";
$username = "root";
$password = "1234";

try{
   $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);

   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $exception){
   echo "Errouuu " . $exception->getMessage();
}