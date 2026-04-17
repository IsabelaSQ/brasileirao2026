<?php
require_once '../model/selecaoModel.php';

$id = $_GET['id'];
$model = new SelecaoModel();

$time_atual = $model->buscarSelecaoPorId($id);
?>

<form action="../controller/selecaoController.php" method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $time_atual['nome'] ?>">
    
    <label>Títulos:</label>
    <input type="number" name="titulos" value="<?= $time_atual['titulos'] ?>">

    <input type="hidden" name="id" value="<?= $time_atual['id'] ?>">

    <button type="submit">Guardar Alterações</button>
</form>