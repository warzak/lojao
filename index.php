<?php
   include 'config/database.php';

   $query = "SELECT id, nome, valor, descricao, DATE_FORMAT(criadoEm, '%d/%m/%Y') AS criadoEm FROM produtos ORDER BY id DESC";
   $stm = $con->prepare($query);
   $stm->execute();

   $num = $stm->rowCount();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Lojão .beta</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <script type="text/javascript">
        function deletar(id){
            var resposta = confirm('Deseja excluir?');
            if(resposta){
                window.location = 'delete.php?id=' + id;
            }
        }
    </script>
      
</head>
<body> 
    <div class="container">  
        <div class="page-header">
            <h1>Lista de Produtos</h1>
        </div>         
        <div class='row'><!-- comment -->
            <a href='create.php' class='btn btn-primary m-b-1em'>Novo</a>
                <?php

                $action = isset($_GET['action']) ? $_GET['action'] : '';
                if($action=='del'){
                    echo "<div class='alert alert-success'> Registro deletado!</div>";
                }

                if($num>0){
                    //listar os produtos
                ?>
                    <table class='table table-hover table-bordered'>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Criado em</th>
                            <th>Ação</th>
                        </tr>
                    <?php
                        while($row = $stm->fetch(PDO::FETCH_ASSOC)){

                            $id = $row['id'];

                            $btn_del = "<a href='#' onclick='deletar({$id});' class='btn btn-danger'>Deletar</a>";

                            $btn_edit = "<a href=edit.php?id={$id} class='btn btn-primary'>Editar</a>";

                            echo "<tr>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['nome']."</td>";      echo "<td>".$row['descricao']."</td>"; echo "<td>".$row['valor']."</td>";
                            echo "<td>".$row['criadoEm']."</td>";
                            echo "<td>
                                    $btn_edit 
                                    &nbsp; 
                                    $btn_del
                                </td>";
                            echo "</tr>";              
                        }
                    ?>
                    </table>


                <?php
                }else{
                    echo "<div class='alert alert-danger'> Nenhum registro foi encontrado!</div>";
                }

                ?>
            
        </div>
    </div>      
</body>
</html>