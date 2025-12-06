<?php
include 'db.php';

if(!isset($_GET['id'])) {
    die("ID inválido!");
}

$id = (int) $_GET['id'];

//atualiza o pagamento para pendente (0)
$stmt = $conn->prepare("UPDATE pagamentos SET pago = 0 WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: pagamentos.php");
exit;