<?php
 include '../BD.class.php';
 $conn = new BD();

 if(!empty($_POST)){
    try {

        if (!filter_var($_POST['nome'])) {
            throw new Exception(" Campo nome não pode estar vazio. ");
        }
        if (!filter_var($_POST['dia'])) {
            throw new Exception(" Campo data não pode estar vazio. ");
        }
        if (!filter_var($_POST['hora'])) {
            throw new Exception(" Campo horário não pode estar vazio. ");
        }
                
        if(empty($_POST['id'])){
            $conn->inserir($_POST);
        } else {
            $conn->atualizar($_POST);
        }
        header("location: AtividadeList.php");

    } catch (Exception $e){
        $id = $_POST['id'];
        header("location: AtividadeForm.php?id=$id&erro=".$e->getMessage());
    }
 }

 if(!empty($_GET['id'])){
    $data = $conn->buscar($_GET['id']);
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
    <form action="AtividadeForm.php" method="post">
    <div class="mb-1" style="margin: 40px;">
        <h3>Atividades</h3>
        <?php echo(!empty($_GET["erro"])? $_GET["erro"]:"") ?><br>
        <input type="hidden" name="id" value="<?php echo (!empty($data->id) ? $data->id : "") ?>"> 
        <label for="" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?php echo (!empty($data->nome) ? $data->nome : "") ?>"><br>

        <label for="" class="form-label">Horário</label>
        <input type="text" name="hora" class="form-control" value="<?php echo (!empty($data->hora) ? $data->hora : "") ?>"><br>

        <label for="" class="form-label">Dia</label>
        <input type="text" name="dia" class="form-control" value="<?php echo (!empty($data->dia) ? $data->dia : "") ?>"><br>

        <label for="" class="form-label">Descrição</label>
        <input type="text" name="descricao" class="form-control" value="<?php echo (!empty($data->descricao) ? $data->descricao : "") ?>"><br>

        <button type="submit" class="btn btn-dark"><?php echo(empty($_GET['id'])? "Salvar" : "Atualizar" )?></button><br>
        <br>
        <button type="button" class="btn btn-light"><a href="AtividadeList.php">Voltar</a></button>
        </div>
    </form>



</body>
</html>