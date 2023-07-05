<?php

//$sql = "SELECT * FROM fm_formulario_questao JOIN fm_formularios ON form_codigo.fm_formularios = fq_codigo_formulario.fm_formularios_questoes";
$sql = "SELECT * FROM fm_formulario_perfil AS fp
JOIN fm_formularios AS form ON form.form_codigo = fp.fp_codigo_formulario
JOIN fm_perfil AS per ON per.per_codigo = fp.fp_codigo_perfil
ORDER BY fp.fp_codigo DESC";

include_once("../conexao/conexao.php");
$conecta = Conectar();
$stm = $conecta->prepare($sql);
$stm->execute();
$retorno = $stm->fetchAll(PDO::FETCH_ASSOC);
$retornoJson = json_encode($retorno);
echo $retornoJson;