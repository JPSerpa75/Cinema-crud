<?php

session_start();

require "../database/ConexaoDatabase.php";

$conexao = new Conexao();

if (isset($_POST['btn-cadastrar'])) {
	$nome = $_POST['floating_nome'];
	$sobrenome = $_POST['floating_sobrenome'];

	$connection = $conexao->Conectar();
	$sql = "INSERT INTO ator(nome, sobrenome) VALUES(:nome, :sobrenome);";
	$stmt = $connection->prepare($sql);
	$stmt->bindValue(':nome', $nome);
	$stmt->bindValue(':sobrenome', $sobrenome);

	if ($stmt->execute()) {
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: ../pages/atores/AtorList.php');
	} else {
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		echo $connection->errorInfo();
		// header('Location: ../../index.php');
	}
}
if (isset($_POST['btn-editar'])) {
	$nome = $_POST['floating_nome'];
	$sobrenome = $_POST['floating_sobrenome'];
	$id = $_POST['id'];

	$connection = $conexao->Conectar();
	$sql = "UPDATE ator	SET nome=:nome, sobrenome=:sobrenome WHERE id_ator=:id;";
	$stmt = $connection->prepare($sql);
	$stmt->bindValue(':nome', $nome);
	$stmt->bindValue(':sobrenome', $sobrenome);
	$stmt->bindValue(':id', $id);

	if ($stmt->execute()) {
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: ../pages/atores/AtorList.php');
	} else {
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		echo $connection->errorInfo();
		// header('Location: ../../index.php');
	}
}
if (isset($_POST['btn-deletar'])) {
}
