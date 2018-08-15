<?php

include 'config/database.php';

try{

   //coletar o id da url
   $id = $_GET['id'];

   $query = "DELETE FROM produtos WHERE id=?";
   $stm = $con->prepare($query);
   $stm->bindParam(1, $id);

   if($stm->execute()){
      header('Location: index.php?action=del');
   }else{
      die('Erro ao deletar registro!');
   }

}catch(PDOException $exception){
   die('Errouuu ' . $exception->getMessage());
}