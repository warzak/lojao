<?php
if($_POST){

   include 'config/database.php';

   try{
      $query = "INSERT INTO produtos SET nome=:nome, valor=:valor, descricao=:descricao, foto=:foto, criadoEm=:criadoEm";

      //statement syntax
      $stm = $con->prepare($query);

      //get data form
      //obtendo os dados do formulário
      $nome = htmlspecialchars($_POST['fnome']);
      $valor = htmlspecialchars($_POST['fvalor']);
      $descricao = htmlspecialchars($_POST['fdesc']);

      $foto= !empty($_FILES["foto"]["name"]) ? 
            sha1_file($_FILES['foto']['tmp_name']) . "-" . basename($_FILES["foto"]["name"]) : "";

      $foto=htmlspecialchars($foto);      

      //formatar/ligar os parametros a query/instrução
      $stm->bindParam(':nome', $nome);
      $stm->bindParam(':valor', $valor);
      $stm->bindParam(':descricao', $descricao);
      $stm->bindParam(':foto', $foto);
      
      $criadoEm = date('Y-m-d H:i:s');
      $stm->bindParam(':criadoEm', $criadoEm);

      //executar instrução sql
      //para inserir produto
      if($stm->execute()){
         echo "<div class='alert alert-success'>
               Registro Salvo!</div>";
      }else{
         echo "<div class='alert alert-danger'>
               Oops! Erro ao salvar registro!</div>";

         print_r($con->errorInfo());
      }
   }catch(PDOException $exception){
      die('Errouuu ' . $exception->getMessage());
   }
}

?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>Lojão .beta</title>
      <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
   </head>
   <body>
      <div class="container">
         <div class="page-header">
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <fieldset>

            <!-- Form Name -->
            <legend>Criar Produto</legend>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="fnome">Nome</label>  
            <div class="col-md-4">
            <input required id="fnome" name="fnome" placeholder="" class="form-control input-md" type="text">
               
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="fvalor">Valor R$</label>  
            <div class="col-md-4">
            <input type="number" step="any" min="0" required id="fvalor" name="fvalor" placeholder="" class="form-control input-md">
               
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="fdesc">Descrição</label>  
            <div class="col-md-4">
            <input required id="fdesc" name="fdesc" placeholder="" class="form-control input-md" type="text">
               
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="ffoto">Foto</label>  
            <div class="col-md-4">
            <input required id="ffoto" name="ffoto" type="file">
               
            </div>
            </div>            

            <!-- Button -->
            <div class="form-group">
            <label class="col-md-4 control-label" for=""></label>
            <div class="col-md-4">
               <button id="" name="" class="btn btn-primary">Salvar</button>
               <a href='index.php' class='btn btn-warning m-b-1em'>Listar</a>
            </div>
            </div>

            </fieldset>
            </form>
         </div>
      </div>
   </body>
</html>
