<?php



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
	$stmt->bindValue(':idioma', $idioma);
	$stmt->bindValue(':classificacao', $classificacaoIndicativa);

	if ($stmt->execute()) {
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: ../pages/filmes/FilmeList.php');
	} else {
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		echo $connection->errorInfo();
		// header('Location: ../../index.php');
	}
} else if (isset($_POST['btn-editar'])) {
	$titulo = $_POST['floating_titulo'];
	$descricao = $_POST['floating_descricao'];
	$categoria = $_POST['floating_categoria'];
	$anoLancamento = $_POST['floating_ano_lancamento'];
	$idioma = $_POST['floating_idioma'];
	$classificacaoIndicativa = $_POST['floating_classificacao_indicativa'];
	$id = $_POST['id'];

	$connection = $conexao->Conectar();
	$sql = "UPDATE filme SET titulo=:titulo, descricao=:descricao, ano_lancamento=:ano, categoria=:categoria, idioma=:idioma, classificacao_indicativa=:classificacao WHERE id_filme=:id;";
	$stmt = $connection->prepare($sql);
	$stmt->bindValue(':titulo', $titulo);
	$stmt->bindValue(':descricao', $descricao);
	$stmt->bindValue(':ano', $anoLancamento);
	$stmt->bindValue(':categoria', $categoria);
	$stmt->bindValue(':idioma', $idioma);
	$stmt->bindValue(':classificacao', $classificacaoIndicativa);
	$stmt->bindValue(':id', $id);

	if ($stmt->execute()) {
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: ../pages/filmes/FilmeList.php');
	} else {
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		echo $connection->errorInfo();
		// header('Location: ../../index.php');
	}
} else if (isset($_GET['id'])) {
	$id = $_GET['id'];
	// DELETE FROM atuacoes WHERE id_ator=:id;
	$connection = $conexao->Conectar();
	$sql = "DELETE FROM atuacoes WHERE id_filme=:id; DELETE FROM filme WHERE id_filme=:id;";
	$stmt = $connection->prepare($sql);
	$stmt->bindValue(':id', $id);
	if ($stmt->execute()) {
		$_SESSION['mensagem'] = "Excluido com sucesso!";
		header('Location: ../pages/filmes/FilmeList.php');
	} else {
		$_SESSION['mensagem'] = "Erro ao Excluir!";
		echo $connection->errorInfo();
		// header('Location: ../../index.php');
	}
}
