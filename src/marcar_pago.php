<?php
include 'db.php';

if(!isset($_GET['id'])) {
    die("ID do pagamento não informado!");
}

$id = (int) $_GET['id'];

//atualiza o pagamento para pago (1)
$stmt = $conn->prepare("UPDATE pagamentos SET pago = 1 WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("location: pagamentos.php");
exit;
