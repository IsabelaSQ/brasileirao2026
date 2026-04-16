<?php
require_once './model/selecaoModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $grupo = $_POST['grupo'];
    $titulos = $_POST['titulos'];
    $criado_em = $_POST['criado_em'];

    $model = new SelecaoModel();
    $model->cadastrarSelecao($nome, $grupo, $titulos, $criado_em);

    header('Location: ../index.php');
    exit();
}
?>