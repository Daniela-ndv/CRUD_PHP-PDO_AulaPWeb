<?php
    include "../BD.class.php";

    $conn = new BD();
    $load = $conn->select();

    if(!empty($_GET['id'])){
        $conn->deletar($_GET['id']);
        header("location: AtividadeList.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body>
    <div style="margin: 20px;">
    <button type="button" class="btn btn-light"><a href="AtividadeForm.php">Cadastrar atividade</a></button>
<br><br>
    <table class="table table-striped table-hover" >
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data</th>
                <th>Horário </th>
                <th>Descrição </th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($load as $item){
                echo "<tr>";
                    echo "<td>".$item->nome."</td>";
                    echo "<td>".$item->dia."</td>";
                    echo "<td>".$item->hora."</td>";
                    echo "<td>".$item->descricao."</td>";
                    echo "<td> <a href='AtividadeForm.php?id=$item->id'>Editar</a></td>";
                    echo "<td> <a onclick='return confirm(\"Deseja excluir? \")' href='AtividadeList.php?id=$item->id'>Deletar</a></td>";
                echo "<tr>";
            }
        ?>
        </tbody>
    </table>
    <br>
    <button type="button" class="btn btn-light"><a href="../index.php">Voltar ao início</a></button>
    </div>
</body>
</html>