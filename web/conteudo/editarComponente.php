<?php
include_once("api/conexao.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Carregar listas de unidades e períodos
$unidades = $conn->query("SELECT * FROM unidade");
$periodos = $conn->query("SELECT * FROM periodo");

// Se houver ID, buscar os dados do componente
$titulo = $transformidade = "";
$unidadeId = $periodoId = "";

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM componente WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $comp = $res->fetch_assoc();
        $titulo = $comp['titulo'];
        $transformidade = $comp['transformidade'];
        $unidadeId = $comp['unidadeId'];
        $periodoId = $comp['periodoId'];
    }
}
?>
<link rel="stylesheet" href="../css/editarComponente.css">
<form action="../api/setComponente.php" method="POST">
    <div class="inputs">
    <input type="hidden" name="id" value="<?= $id ?>">

    <span class="label">Nome:</span>
    <input type="text" name="titulo" value="<?= htmlspecialchars($titulo) ?>">

    <span class="label">Transformidade:</span>
    <input type="text" name="transformidade" value="<?= htmlspecialchars($transformidade) ?>">

    <span class="label">Unidade:</span>
    <select name="unidadeId">
        <?php while($row = $unidades->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $unidadeId ? "selected" : "" ?>>
                <?= htmlspecialchars($row['nome']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <span class="label">Período:</span>
    <select name="periodoId">
        <?php while($row = $periodos->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $periodoId ? "selected" : "" ?>>
                <?= htmlspecialchars($row['nome']) ?>
            </option>
        <?php endwhile; ?>
    </select>
    </div>

    <div class="botoes">
    <a href="componentes.php"><button type="button" class="btn-acao">Voltar</button></a>
    <button type="submit" class="btn-confirmar">Salvar</button>
    </div>
</form>

