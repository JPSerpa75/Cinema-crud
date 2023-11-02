<?php

session_start();

require "../database/ConexaoDatabase.php";

$conexao = new Conexao();

if (isset($_POST['btn-cadastrar'])) {
	$titulo = $_POST['floating_titulo'];
	$descricao = $_POST['floating_descricao'];
	$categoria = $_POST['floating_categoria'];
	$anoLancamento = $_POST['floating_ano_lancamento'];
	$idioma = $_POST['floating_idioma'];
	$classificacaoIndicativa = $_POST['floating_classificacao_indicativa'];

	$connection = $conexao->Conectar();

	$sql = "INSERT INTO filme(titulo, descricao, ano_lancamento, categoria, idioma, classificacao_indicativa) VALUES( :titulo, :descricao, :ano, :categoria, :idioma, :classificacao);";
	$stmt = $connection->prepare($sql);
	$stmt->bindValue(':titulo', $titulo);
	$stmt->bindValue(':descricao', $descricao);
	$stmt->bindValue(':ano', $anoLancamento);
	$stmt->bindValue(':categoria', $categoria);
	$stmt->bindValue(':idioma', 'portugues');
	$stmt->bindValue(':classificacao', $classificacaoIndicativa);

	if ($stmt->execute()) {
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: ../pages/filmes/FilmeList.php');
	} else {
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		echo $connection->errorInfo();
		// header('Location: ../../index.php');
	}
}
if (isset($_POST['btn-editar'])) {
}
if (isset($_POST['btn-deletar'])) {
}
