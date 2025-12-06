<?php
include 'db.php';

//buscar todos os pagamentos com informações do asociado e da anuidade
$sql = "SELECT
            pagamentos.id AS pagamento_id,
            pagamentos.pago,
            associados.nome AS associado_nome,
            anuidades.ano,
            anuidades.valor
        FROM pagamentos
        JOIN associados ON pagamentos.associado_id = associados.id
        JOIN anuidades ON pagamentos.anuidade_id = anuidades.id
        ORDER BY associados.nome, anuidades.ano";

$result = $conn->query($sql);
?>

<h2>Lista de Pagamentos</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Associado</th>
        <th>Ano</th>
        <th>Valor</th>
        <th>Status</th>
        <th>Ação</th>
    </tr>

<?php while($p = $result->fetch_assoc()): ?>
    <tr>
        <td><?=  $p['associado_nome'] ?></td>
        <td><?=  $p['ano'] ?></td>
        <td>R$ <?= number_format($p['valor'], 2, ',', '.') ?></td>
        <td>
            <?= $p['pago'] ? "<b style='color:green'>Pago</b>" : "<b style='color:red'>Pendente</b>" ?>
        </td>
        <td>
            <?php if(!$p['pago']): ?>
                <a href="marcar_pago.php?id=<?=  $p['pagamento_id'] ?>">Marcar como pago</a>
            <?php else: ?>
                <a href="marcar_pendente.php?id=<?=  $p['pagamento_id'] ?>">Marcar como Pendente</a>
            <?php endif; ?>
        </td>
    </tr>
<?php endwhile; ?>

</table>

<br>
<a href="index.php">Voltar</a>