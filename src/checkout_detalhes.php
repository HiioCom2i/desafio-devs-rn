<?php
include 'db.php';

if(!isset($_GET['id'])) {
    die("ID do associado não informado!");
}

$assoc_id = (int)$_GET['id'];

//buscar dados do associado
$stmt = $conn->prepare("SELECT nome, email, cpf, data_filiacao FROM associados WHERE id = ?");
$stmt->bind_param("i", $assoc_id);
$stmt->execute();
$assoc = $stmt->get_result()->fetch_assoc();

if (!$assoc) {
    die("Associado não encontrado!");
}

//Buscar pagamentos pendentes

$sql = "SELECT
            p.id AS pagamento_id,
            a.ano,
            a.valor,
            p.pago
            FROM pagamentos p
            JOIN anuidades a ON p.anuidade_id = a.id
            WHERE p.associado_id = ?
            AND p.pago = 0
            ORDER BY a.ano";

$stmt2 = $conn->prepare($sql);
$stmt2->bind_param("i", $assoc_id);
$stmt2->execute();
$result = $stmt2->get_result();

//calcular total devido
$total = 0;
?>

<h2>Checkout de Anuidades</h2>

<h3>Associado</h3>
<p><b>Nome:</b> <?= $assoc['nome'] ?></p>
<p><b>E-mail:</b> <?= $assoc['email'] ?></p>
<p><b>CPF:</b> <?= $assoc['cpf'] ?></p>
<p><b>Data de Filiação:</b> <?= date("d/m/Y", strtotime($assoc['data_filiacao'])) ?></p>

<hr>

<h3>Anuidades Pendendes</h3>

<?php if ($result->num_rows == 0): ?>
    <p style="color:green"><b>Este associado não possui anuidades pendentes!</b></p>
 
    <?php else: ?>

<table border="1" cellpadding="8">
    <tr>
        <th>Ano</th>
        <th>Valor</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): 
        //soma o valor devido
        $total += (float) $row['valor'];
    ?>
        <tr>
            <td><?= $row['ano'] ?></td>
            <td>R$ <?= number_format($row['valor'], 2, ',', '.') ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>Total devido: <span style="color:red">R$ <?= number_format($total,2, ',', '.') ?></span></h3>

<?php endif; ?>

<br>
<a href="checkout.php">Voltar</a>