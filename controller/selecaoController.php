<?php
require_once __DIR__ . '/../model/selecaoModel.php';

if (isset($_GET['acao']) && $_GET['acao'] === 'deletar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $model = new SelecaoModel();
    $model->deletarSelecao($id);
    
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new SelecaoModel();

    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar') {
        $id = $_POST['id'];
        $model->deletarSelecao($id);
    }
    elseif (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $titulos = $_POST['titulos'];
        
        $model->atualizarSelecao($id, $nome, $titulos);
    } 
    else {
        $nome = $_POST['nome'];
        $grupo = $_POST['grupo'];
        $titulos = $_POST['titulos'];
        $criado_em = $_POST['criado_em'];
        
        $model->cadastrarSelecao($nome, $grupo, $titulos, $criado_em);
    }

    header('Location: ../index.php');
    exit();
}
?>