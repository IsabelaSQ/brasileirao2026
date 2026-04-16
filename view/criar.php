<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Brasileirão</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main class="container">
        <h2 class="section-title" style="text-align: center; border: none;">Cadastro de Nova Equipe</h2>
        
        <form action="../controller/selecaoController.php" method="POST">
            <label for="titulo">Nome do Clube</label>
            <input type="text" name="nome" id="nome" required>
            
           <label>Grupo</label>
            <select name="grupo" id="grupo" required>
                <option value="">Selecione o Grupo</option>
                <option value="A">Grupo A</option>
                <option value="B">Grupo B</option>
                <option value="C">Grupo C</option>
                <option value="D">Grupo D</option>
            </select>
            
            <label>Títulos:</label>
            <input type="number" name="titulos" value="0">

            <label>Criado em:</label>
            <input type="date" name="criado_em" required>

            <div class="button-group">
            <button type="submit">Criar Time</button>
            </div>
        </form>
    </main>

</body>
</html>