<?php
include_once '../../includes/header.php';
?>

<?php

require "../../database/ConexaoDatabase.php";

$conexao = new Conexao();

$connection = $conexao->Conectar();
$sql = "SELECT id_filme, titulo, descricao, ano_lancamento, categoria, idioma, classificacao_indicativa FROM filme where id_filme = :id;";
$stmt = $connection->prepare($sql);
$stmt->bindValue(':id', $_GET['id']);
$stmt->execute();
$dado = $stmt->fetch();
?>


<div class="flex justify-center items-center" style="width: 100%; height: 80%;">
	<div class="max-w-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
		<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
		</svg>
		<h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Tem certeza que deseja excluir o filme <?php echo $dado['titulo']; ?> ?</h5>

		<p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-center">Todas as atuações relacionadas a esse filme também serão excluídas</p>
		<div class="flex justify-center items-center mt-7 gap-5">
			<a href="/pages/filmes/FilmeList.php" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</a>
			<a href="../../actions/FilmeAction.php?id=<?php echo $dado['id_filme'] ?>" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Excluir</a>
		</div>
	</div>
</div>



<?php
include_once '../../includes/footer.php';
?>