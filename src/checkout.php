<?php
include 'db.php';

//pegar todos os associados
$result = $conn->query("SELECT * FROM associados ORDER BY nome");
?>

<h2>Checkout de Anuidades</h2>

<form action="checkout_detalhes.php" method="GET">
    <label>Selecione o associado:</label>
    <select name="id" required>
        <?php while($a = $result->fetch_assoc()): ?>
            <option value="<?= $a['id'] ?>"><?= $a['nome'] ?></option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Ver Anuidades Devidas</button>
</form>

<br>
<a href="index.php">Voltar</a>