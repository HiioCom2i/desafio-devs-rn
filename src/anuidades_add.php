<?php
include 'db.php'; //conexão com o banco

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ano = $_POST['ano'];
    $valor = $_POST['valor'];

    $stmt = $conn->prepare("INSERT INTO anuidades (ano, valor) VALUES (?, ?)");
    $stmt->bind_param("id", $ano, $valor); // i = int, d = double/decimal

    if($stmt->execute()) {
        echo "<p style='color:green'>Anuidade cadastrada com sucesso!</p>";
    } else {
        echo "<p style='color:red'>Erro: " . $stmt->error . "</p>";
    }

    $stmt->close();

}
?>

<h2>Cadastro de anuidades
    <form method="POST" action="anuidades_add.php">
        Ano: <input type="number" name="ano" required><br><br>
        Valor: <input type="number" step="0.01" name="valor" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
</h2>

<br>
<a href="index.php">Voltar</a>