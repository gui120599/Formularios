<?php
include_once '../conexao/conexao.php';

$nome_formulario = $_POST['nome_formulario'];
$sigla_formulario = $_POST['sigla_formulario'];
$formulario_ativo = $_POST['formulario_ativo'];

$sql_insert = "INSERT INTO fm_formularios(form_nome,form_sigla,form_ativo)VALUES('$nome_formulario','$sigla_formulario','$formulario_ativo')";
$pdo = Conectar();
$stmt = $pdo->prepare($sql_insert);
if ($stmt->execute()) {
    //echo '<p>Salvo com sucesso!</p>';
    //Busca o codigo do ultimo registro para salvar na tabela de registros
    $sql_select = "SELECT `form_codigo` FROM `fm_formularios` ORDER BY form_codigo DESC LIMIT 1";
    $stm = $pdo->prepare($sql_select);
    $stm->execute();
    $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach ($retorno as $valor) {
        echo $cod_form_inserido = $valor['form_codigo'];
    }
    if ($cod_form_inserido > 0) {//Vincula a questao codigo nos formularios gerados
        $sql_insert_2 = "INSERT INTO fm_formularios_questoes(fq_form_codigo,fq_ques_codigo,fq_vinculo_ativo)VALUES($cod_form_inserido,1,'SIM')";
        $pdo = Conectar();
        $stmt = $pdo->prepare($sql_insert_2);
        if ($stmt->execute()) {
            //echo '<p>Vinculo Salvo com sucesso!</p>';
        } else {
            echo 'Erro ao salvar!' . $sql_insert_2;
        }
    }
} else {
    echo '<p>Erro ao salvar!</p>' . $sql_insert;
}

/*$cod_formulario = $_POST['cod_formulario'];
$nome_formulario = $_POST['nome_formulario'];
$sigla_formulario = $_POST['sigla_formulario'];
$formulario_ativo = $_POST['formulario_ativo'];



if ($cod_formulario > 0) {
    $sql_update = "UPDATE fm_formularios SET form_nome = '$nome_formulario', form_sigla = '$sigla_formulario',form_ativo = '$formulario_ativo' WHERE form_codigo = $cod_formulario";
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_update);
    if ($stmt->execute()) {
        echo '<p>Salvo com sucesso!</p>'. $sql_update;
    } else {
        echo '<p>Erro ao salvar!</p>' . $sql_update;
    }
} else {
    $sql_insert = "INSERT INTO fm_formularios(form_nome,form_sigla,form_ativo)VALUES('$nome_formulario','$sigla_formulario','$formulario_ativo')";
    $pdo = Conectar();
    $stmt = $pdo->prepare($sql_insert);
    if ($stmt->execute()) {
        //echo '<p>Salvo com sucesso!</p>'. $sql_insert;
        //Busca o codigo do ultimo registro para salvar na tabela de registros
        $sql_select = "SELECT `form_codigo` FROM `fm_formularios` ORDER BY form_codigo DESC LIMIT 1";
        $stm = $pdo->prepare($sql_select);
        $stm->execute();
        $retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($retorno as $valor) {
            echo $cod_form_inserido = $valor['form_codigo'];
        }
    } else {
        echo '<p>Erro ao salvar!</p>' . $sql_insert;
    }
}*/
