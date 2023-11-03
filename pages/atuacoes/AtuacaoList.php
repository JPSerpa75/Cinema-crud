<?php
include_once '../../includes/header.php';
?>

<?php

require "../../database/ConexaoDatabase.php";

$conexao = new Conexao();

$connection = $conexao->Conectar();

$sql = " SELECT 
		CONCAT(a.nome, ' ', a.sobrenome) as nomeAtor,
		f.titulo as tituloFilme
	from atuacoes atua 
	inner join ator a on a.id_ator = atua.id_ator 
	inner join filme f on f.id_filme = atua.id_filme 
	order by f.titulo, a.nome ;";

$stmt = $connection->prepare($sql);
$stmt->execute();
?>

<h1 class="mt-6 mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-gray-700 text-center">Atuações</h1>
<p class="mb-10 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 text-center">Aqui você pode gerenciar suas atuações</p>
<div class="flex flex-wrap items-center justify-center gap-7">
	<a href="/index.php" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
		Voltar para tela inicial
		<svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
		</svg>
	</a>
</div>


<div class="my-10 mx-auto flex justify-center relative overflow-x-auto shadow-md sm:rounded-md max-w-[90%]">
	<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
		<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
			<tr>
				<th scope="col" class="px-6 py-3">
					Filme
				</th>
				<th scope="col" class="px-6 py-3">
					Ator
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($stmt->rowCount() > 0) :

				foreach ($connection->query($sql) as $chave => $dados) :
			?>
					<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
						<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
							<?php echo $dados['tituloFilme']; ?>
						</th>
						<td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
							<?php echo $dados['nomeAtor']; ?>
						</td>
					</tr>
				<?php

				endforeach;
			else :
				?>
				<tr>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>

	<?php
	include_once '../../includes/footer.php';
	?>