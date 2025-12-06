<?php
include 'db.php'; // conexão com o banco

//Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $data_filiacao = $_POST['data_filiacao'];

    //preparar query para evitar SQL Injection
    $sql = "INSERT INTO associados (nome, email, cpf, data_filiacao) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $cpf, $data_filiacao);

    if($stmt->execute()) {
        echo "<p style='color:green'>Associado cadastrado com sucesso!</p>";
    } else {
        echo "<p style='color:red'>Erro: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>


<h2>Cadastro de Associados</h2>
<form method="POST" action="associados_add.php">
    Nome: <input type="text" name="nome" required><br><br>
    E-mail: <input type="email" name="email" required><br><br>
    CPF: <input type="text" name="cpf" required><br><br>
    Data de filiação: <input type="date" name="data_filiacao" required><br><br>
    <button type="submit">Cadastrar</button>
</form>

<br>
<a href="index.php">Voltar</a>