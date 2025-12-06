<?php
include 'db.php';

//buscar associados que possuam algum pagamento pendente

$sql = "SELECT DISTINCT a.id, a.nome
        FROM associados a
        JOIN pagamentos p ON p.associado_id = a.id
        WHERE p.pago = 0
        ORDER BY a.nome";

$result = $conn->query($sql);
?>

<h2>Associados em Atraso</h2>
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