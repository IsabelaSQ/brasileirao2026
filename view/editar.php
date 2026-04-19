<?php
require_once __DIR__ . '/../model/selecaoModel.php';

$id = $_GET['id'];
$model = new SelecaoModel();

$time_atual = $model->buscarSelecaoPorId($id);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar - Brasileirão</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>

    <main class="container">
        <h2 class="section-title" style="text-align: center; border: none;">Atualizar Equipe</h2>
        
        <form action="../controller/selecaoController.php" method="POST">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= $time_atual['nome'] ?>" required>
            
            <label>Títulos:</label>
            <input type="number" name="titulos" value="<?= $time_atual['titulos'] ?>" required>

            <input type="hidden" name="id" value="<?= $time_atual['id'] ?>">

            <div class="button-group">
                <button type="submit">Guardar Alterações</button>
            </div>
        </form>
    </main>

</body>
</html>