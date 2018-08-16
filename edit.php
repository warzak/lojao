<?php
include 'config/database.php';

if(isset($_GET['id'])){
   $id = $_GET['id'];

   try{
      $query = "SELECT id, nome, valor, descricao FROM produtos WHERE id=?";

      //statement syntax
      $stm = $con->prepare($query);
      $stm->bindParam(1, $id);

      $stm->execute();
      $row = $stm->fetch(PDO::FETCH_ASSOC);
      
      $nome = $row['nome'];
      $descricao = $row['descricao'];      
      $valor = $row['valor'];

   }catch(PDOException $exception){
      die('Errouuu ' . $exception->getMessage());
   }
}//if $_GET

if($_POST){
   
      try{
         $query = "UPDATE produtos SET nome=:nome, valor=:valor, descricao=:descricao WHERE id =:id";
   
         //statement syntax
         $stm = $con->prepare($query);
   
         //get data form
         //obtendo os dados do formulário
         $nome = htmlspecialchars($_POST['fnome']);
         $valor = htmlspecialchars($_POST['fvalor']);
         $descricao = htmlspecialchars($_POST['fdesc']);
   
         //formatar/ligar os parametros a query/instrução
         $stm->bindParam(':nome', $nome);
         $stm->bindParam(':valor', $valor);
         $stm->bindParam(':descricao', $descricao);
         $stm->bindParam(':id', $id);
            
         //executar instrução sql
         //para alterar produto
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
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'].'?id='.$id;?>" method="POST">
            <fieldset>

            <!-- Form Name -->
            <legend>Alterar Produto</legend>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="fnome">Nome</label>  
            <div class="col-md-4">
            <input required id="fnome" name="fnome" class="form-control input-md" type="text" value="<?php echo $nome;?>">
               
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="fvalor">Valor R$</label>  
            <div class="col-md-4">
            <input type="number" step="any" min="0" required id="fvalor" name="fvalor" value="<?php echo $valor;?>" class="form-control input-md">
               
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="fdesc">Descrição</label>  
            <div class="col-md-4">
            <input required id="fdesc" name="fdesc" value="<?php echo $descricao;?>" class="form-control input-md" type="text">
               
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
