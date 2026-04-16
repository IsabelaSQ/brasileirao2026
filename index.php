<?php
require_once 'model/selecaoModel.php'; // Caminho pode variar dependendo de onde está o seu index.php

$model = new SelecaoModel();
$times = $model->listarSelecoes();

session_start();
$mensagem = '';
$tipo_msg = '';
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    $tipo_msg = $_SESSION['tipo_msg'];
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo_msg']);
}

// Dados simulados dos times cadastrados
$jogos = [
    ['rodada' => 13, 'status' => 'Encerrado', 'time1' => 'Flamengo',    'g1' => 2, 'time2' => 'Palmeiras',   'g2' => 1, 'estadio' => 'Maracanã',         'data' => '19 Abr 2026'],
    ['rodada' => 13, 'status' => 'Agendado',  'time1' => 'Corinthians', 'g1' => null,'time2' => 'São Paulo',  'g2' => null,'hora' => '18:30', 'estadio' => 'Neo Química Arena', 'data' => '20 Abr 2026'],
    ['rodada' => 13, 'status' => 'Agendado',  'time1' => 'Atlético-MG', 'g1' => null,'time2' => 'Botafogo',  'g2' => null,'hora' => '20:30', 'estadio' => 'Arena MRV',        'data' => '20 Abr 2026'],
    ['rodada' => 12, 'status' => 'Encerrado', 'time1' => 'Grêmio',      'g1' => 1, 'time2' => 'Internacional','g2'=>1, 'estadio' => 'Arena do Grêmio',    'data' => '13 Abr 2026'],
    ['rodada' => 12, 'status' => 'Agendado',  'time1' => 'Santos',      'g1' => null,'time2' => 'Fluminense','g2' => null,'hora' => '19:00', 'estadio' => 'Vila Belmiro',      'data' => '21 Abr 2026'],
    ['rodada' => 12, 'status' => 'Encerrado', 'time1' => 'Bahia',       'g1' => 3, 'time2' => 'Vasco',       'g2' => 0, 'estadio' => 'Arena Fonte Nova',  'data' => '19 Abr 2026'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brasileirão 2026 — O Maior Campeonato do Brasil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Barlow+Condensed:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
    <div class="nav-container">
        <a href="#" class="nav-logo">
            <div class="logo-icon">⚽</div>
            <span>BRASILEIRÃO</span>
        </a>
        <ul class="nav-links">
            <li><a href="#inicio">Início</a></li>
            <li><a href="#destaques">Destaques</a></li>
            <li><a href="#calendario">Calendário</a></li>
            <li><a href="#cadastro">Cadastro</a></li>
            <li><a href="#times">Times</a></li>
        </ul>
        <a href="#ingressos" class="btn-ingressos">INGRESSOS</a>
        <button class="nav-toggle" id="navToggle">&#9776;</button>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="inicio">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <p class="hero-tag">TEMPORADA 2026</p>
        <h1 class="hero-title">
            O MAIOR<br>
            <span class="accent-yellow">CAMPEONATO</span><br>
            DO BRASIL
        </h1>
        <p class="hero-desc">Acompanhe cada rodada, cada gol e cada emoção do Brasileirão 2026. A elite do futebol nacional em um único lugar.</p>
        <div class="hero-actions">
            <a href="#destaques" class="btn-primary">SAIBA MAIS ↓</a>
            <a href="#ingressos" class="btn-secondary">🎟 COMPRAR INGRESSOS</a>
        </div>
        <div class="hero-stats">
            <div class="stat"><span class="stat-num">20</span><span class="stat-label">TIMES</span></div>
            <div class="stat"><span class="stat-num">38</span><span class="stat-label">RODADAS</span></div>
            <div class="stat"><span class="stat-num">380</span><span class="stat-label">JOGOS</span></div>
        </div>
    </div>
    <div class="hero-scroll">↓</div>
</section>

<!-- DESTAQUES -->
<section class="section destaques-section" id="destaques">
    <div class="section-label">ESTRELAS DO CAMPEONATO</div>
    <h2 class="section-title">DESTAQUES</h2>
    <div class="section-line"><span></span><span class="dot"></span><span></span></div>
    <div class="players-grid">
        <?php
        $jogadores = [
            ['nome' => 'Gabigol',       'time' => 'Flamengo',    'pos' => 'Atacante',   'gols' => 12, 'badge' => 'Artilheiro', 'color' => '#e8001c'],
            ['nome' => 'Endrick',       'time' => 'Palmeiras',   'pos' => 'Atacante',   'gols' => 10, 'badge' => 'Revelação',  'color' => '#006633'],
            ['nome' => 'Pedro',         'time' => 'Flamengo',    'pos' => 'Atacante',   'gols' => 9,  'badge' => null,          'color' => '#e8001c'],
            ['nome' => 'Raphael Veiga', 'time' => 'Palmeiras',   'pos' => 'Meia',       'gols' => 8,  'badge' => null,          'color' => '#006633'],
            ['nome' => 'Luciano',       'time' => 'São Paulo',   'pos' => 'Atacante',   'gols' => 7,  'badge' => null,          'color' => '#cc0000'],
            ['nome' => 'Hulk',          'time' => 'Atlético-MG', 'pos' => 'Atacante',   'gols' => 7,  'badge' => 'Veterano',   'color' => '#000000'],
        ];
        foreach ($jogadores as $j): ?>
        <div class="player-card" style="--team-color: <?= $j['color'] ?>">
            <?php if ($j['badge']): ?><span class="player-badge"><?= $j['badge'] ?></span><?php endif; ?>
            <div class="player-silhouette">
                <div class="player-number"><?= $j['gols'] ?></div>
                <div class="player-icon">⚽</div>
            </div>
            <div class="player-info">
                <span class="player-name"><?= $j['nome'] ?></span>
                <span class="player-team"><?= $j['time'] ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- CALENDÁRIO -->
<section class="section calendario-section" id="calendario">
    <div class="section-label">RODADA 13</div>
    <h2 class="section-title">CALENDÁRIO E TABELAS</h2>
    <div class="section-line"><span></span><span class="dot"></span><span></span></div>

    <div class="tab-buttons">
        <button class="tab-btn active" data-tab="calendario-tab">Calendário</button>
        <button class="tab-btn" data-tab="tabela-tab">Tabela</button>
    </div>

    <div id="calendario-tab" class="tab-content active">
        <div class="jogos-grid">
            <?php foreach ($jogos as $jogo): 
                $status_class = strtolower($jogo['status']) === 'encerrado' ? 'status-enc' : 'status-ag';
            ?>
            <div class="jogo-card">
                <div class="jogo-header">
                    <span class="rodada-label">RODADA <?= $jogo['rodada'] ?></span>
                    <span class="status-badge <?= $status_class ?>"><?= $jogo['status'] ?></span>
                </div>
                <div class="jogo-placar">
                    <span class="time-nome"><?= $jogo['time1'] ?></span>
                    <?php if ($jogo['status'] === 'Encerrado'): ?>
                        <div class="placar"><?= $jogo['g1'] ?> <span>×</span> <?= $jogo['g2'] ?></div>
                    <?php else: ?>
                        <div class="hora-jogo"><?= $jogo['hora'] ?></div>
                    <?php endif; ?>
                    <span class="time-nome"><?= $jogo['time2'] ?></span>
                </div>
                <div class="jogo-footer">
                    <span>📍 <?= $jogo['estadio'] ?></span>
                    <span>📅 <?= $jogo['data'] ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="tabela-tab" class="tab-content">
        <div class="tabela-container">
            <table class="tabela-classificacao">
                <thead>
                    <tr><th>#</th><th>Time</th><th>P</th><th>J</th><th>V</th><th>E</th><th>D</th><th>GP</th><th>GC</th><th>SG</th></tr>
                </thead>
                <tbody>
                    <?php
                    $classificacao = [
                        [1,'Palmeiras',    29,13,9,2,2,28,12,16],
                        [2,'Flamengo',     27,13,8,3,2,25,14,11],
                        [3,'Botafogo',     24,13,7,3,3,22,16, 6],
                        [4,'Atlético-MG',  22,13,6,4,3,20,15, 5],
                        [5,'Corinthians',  21,13,6,3,4,18,16, 2],
                        [6,'São Paulo',    19,13,5,4,4,17,17, 0],
                        [7,'Grêmio',       17,13,5,2,6,16,18,-2],
                        [8,'Internacional',15,13,4,3,6,15,20,-5],
                    ];
                    foreach ($classificacao as [$pos, $time, $pts, $j, $v, $e, $d, $gp, $gc, $sg]):
                        $cls = $pos <= 4 ? 'pos-g8' : ($pos <= 6 ? 'pos-sulam' : ($pos >= 17 ? 'pos-rel' : ''));
                    ?>
                    <tr class="<?= $cls ?>">
                        <td class="pos"><?= $pos ?></td>
                        <td class="time-col"><?= $time ?></td>
                        <td class="pts"><strong><?= $pts ?></strong></td>
                        <td><?= $j ?></td><td><?= $v ?></td><td><?= $e ?></td><td><?= $d ?></td>
                        <td><?= $gp ?></td><td><?= $gc ?></td><td><?= $sg ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- CADASTRO -->
<section class="section cadastro-section" id="cadastro">
    <div class="section-label">ÁREA ADMINISTRATIVA</div>
    <h2 class="section-title">CADASTRO</h2>
    <div class="section-line"><span></span><span class="dot"></span><span></span></div>

    <?php if ($mensagem): ?>
    <div class="alert alert-<?= $tipo_msg ?>">
        <?= htmlspecialchars($mensagem) ?>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
    <?php endif; ?>

    <div class="cadastro-card">
        <div class="cadastro-header">
            <div>
                <h3>Gerenciamento de Times</h3>
                <p><?= count($times) ?> seleções cadastradas</p>
            </div>
            <a href="./view/criar.php" class="btn-add" style="text-decoration: none; display: inline-block;">+ Adicionar Nova Seleção</a>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>GRUPO</th>
                        <th>TROFÉUS</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($times as $time): ?>
                    <tr>
                        <td class="id-col"><?= str_pad($time['id'], 2, '0', STR_PAD_LEFT) ?></td>
                        
                        <td class="nome-col">
                            <div class="time-row">
                                <div class="mini-escudo" style="background: var(--verde)">
                                    <?= strtoupper(substr($time['nome'], 0, 1)) ?>
                                </div>
                                <div>
                                    <span class="time-nome-table"><?= $time['nome'] ?></span>
                                    </div>
                            </div>
                        </td>
                        
                        <td><span class="grupo-badge grupo-<?= strtolower($time['grupo']) ?>">Grupo <?= $time['grupo'] ?></span></td>
                        
                        <td>🏆 <?= $time['titulos'] ?></td>
                        
                        <td>📅 <?= date('d/m/Y', strtotime($time['criado_em'])) ?></td>
                        
                        <td class="acoes-col">
                            <a href="../view/editar.php?id=<?= $time['id'] ?>" class="btn-edit" style="text-decoration: none;">✏️</a>
                            <button class="btn-del" onclick="confirmarDelete(<?= $time['id'] ?>, '<?= $time['nome'] ?>')" title="Excluir">🗑️</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ESCUDOS -->
<section class="section escudos-section" id="times">
    <div class="section-label">ELITE A ELITE</div>
    <h2 class="section-title">ESCUDOS OFICIAIS</h2>
    <div class="section-line"><span></span><span class="dot"></span><span></span></div>
    <p class="section-sub">Os clubs que disputam a elite do futebol brasileiro</p>
    <div class="escudos-grid">
        <?php
        $escudos = [
            ['Flamengo','#e8001c','FLA'],['Palmeiras','#006633','PAL'],['Corinthians','#000','COR'],
            ['São Paulo','#cc0000','SPO'],['Botafogo','#000','BOT'],['Fluminense','#6d1e3e','FLU'],
            ['Grêmio','#1a237e','GRE'],['Internacional','#c8102e','INT'],['Atlético-MG','#000','CAM'],
            ['Santos','#000','SAN'],['Bahia','#003da5','BAH'],['Vasco','#000','VAS'],
        ];
        foreach ($escudos as [$nome, $cor, $sig]): ?>
        <div class="escudo-card">
            <div class="escudo-shape" style="--cor: <?= $cor ?>">
                <span><?= $sig ?></span>
            </div>
            <p><?= $nome ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- CTA INGRESSOS -->
<section class="cta-section" id="ingressos">
    <div class="cta-overlay"></div>
    <div class="cta-content">
        <h2>GARANTA SEU <span class="accent-yellow">INGRESSO</span></h2>
        <p>Viva a emoção ao vivo. Os melhores jogos do Brasileirão 2026 te aguardam.</p>
        <a href="#" class="btn-cta">🎟 COMPRAR INGRESSOS</a>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-brand">
            <div class="footer-logo">⚽ BRASILEIRÃO</div>
            <p>O maior campeonato de futebol do Brasil. Acompanhe cada rodada com a paixão e a emoção que só o Brasileirão tem.</p>
            <p class="footer-copy">© 2026 Brasileirão. Todos os direitos reservados.</p>
        </div>
        <div class="footer-col">
            <h4>CAMPEONATO</h4>
            <ul>
                <li><a href="#">Regulamento</a></li>
                <li><a href="#">Tabela de Jogos</a></li>
                <li><a href="#calendario">Calendário</a></li>
                <li><a href="#cadastro">Árbitros</a></li>
                <li><a href="#cadastro">Estatísticas</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>TIMES</h4>
            <ul>
                <li><a href="#">Flamengo</a></li>
                <li><a href="#">Palmeiras</a></li>
                <li><a href="#">Corinthians</a></li>
                <li><a href="#">São Paulo</a></li>
                <li><a href="#">Botafogo</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>CONTATO</h4>
            <ul>
                <li><a href="#">Imprensa</a></li>
                <li><a href="#">Parcerias</a></li>
                <li><a href="#">Trabalhe Conosco</a></li>
                <li><a href="#">Ouvidoria</a></li>
            </ul>
        </div>
    </div>
</footer>

<script src="script.js"></script>
</body>
</html>