<?php
include 'db.php';



$ano_atual = (int)date("Y");

//verificar se existem anuidades cadastradas
$result = $conn->query("SELECT COUNT(*) AS total FROM anuidades");
$row = $result->fetch_assoc();

if($row['total'] == 0){
    die("<h2 style='color:red'>Nenhuma anuidade cadastrada!</h2>
         <p> Cadastre ao menos a anuidade do ano atual antes de gerear pagamentos. </p>
         <a href='anuidade_add.php' >Cadastrar Anuidade</a>");
}

//pegar todos os associados
$associados = $conn->query("SELECT * FROM associados");

while($assoc = $associados->fetch_assoc()) {
    $ano_filiacao = (int)date("Y", strtotime($assoc['data_filiacao']));
    
    //pegar todas as anuidades a partir do ano de filiação
    $anuidades = $conn->query("SELECT * FROM anuidades WHERE ano >= $ano_filiacao AND ano <= $ano_atual ORDER BY ano");

    while($anu = $anuidades->fetch_assoc()) {
        //verificar se o pagamento já existe
        $check = $conn->prepare("SELECT id FROM pagamentos WHERE associado_id=? AND anuidade_id=?");
        $check->bind_param("ii", $assoc['id'], $anu['id']);
        $check->execute();
        $check->store_result();

        if($check->num_rows == 0) {
            //inserir pagamento
            $stmt = $conn->prepare("INSERT INTO pagamentos (associado_id, anuidade_id, pago) VALUES (?, ?, 0)");
            $stmt->bind_param("ii", $assoc['id'], $anu['id']);
            $stmt->execute();
            $stmt->close();
        }

        $check->close();
    } 
}

echo "Pagamentos gerados com sucesso!";

?>

<br>
<a href="index.php">Voltar</a>