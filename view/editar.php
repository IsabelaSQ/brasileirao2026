<?php
require_once '../model/selecaoModel.php';

$id = $_GET['id'];
$model = new SelecaoModel();
$selecao = $model->buscarSelecaoPorId($id);
?>