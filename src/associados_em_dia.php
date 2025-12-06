<?php
include 'db.php';

//buscar associados que não tem nenhnum pagamento pendente

$sql = "SELECT a.id, a.nome
        FROM associados a
        WHERE NOT EXISTS (
                SELECT 1 FROM pagamentos p
                WHERE p.associado_id = a.id
                        AND p.pago = 0
        )
        ORDER BY a.nome";

$result = $conn->query($sql);
?>

<h2>Associados em Dia</h2>
<table border="1" cellpadding="8">
        <tr>
                <th>Nome</th>
        </tr>

<?php while($a= $result->fetch_assoc()): ?>
        <tr>
                <td><?=  $a['nome'] ?></td>
        </tr>
<?php endwhile; ?>
</table>

<br>
<a href="index.php">Voltar</a>