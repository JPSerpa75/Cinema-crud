<?php
include_once '../../includes/header.php';

session_start();

require "../../database/ConexaoDatabase.php";

$conexao = new Conexao();

$connection = $conexao->Conectar();

$sql = "SELECT id_ator, nome, sobrenome FROM ator;";
$stmt = $connection->prepare($sql);
$stmt->execute();

?>

<h1 class="mt-6 mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-gray-700 text-center">Atores</h1>
<p class="mb-10 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 text-center">Aqui você pode gerenciar seus atores</p>
<div class="flex flex-wrap items-center justify-center gap-7">
	<a href="/pages/atores/AtorCreate.php" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
		Cadastrar novo ator
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
					Nome
				</th>
				<th scope="col" class="px-6 py-3">
					Sobrenome
				</th>
				<th scope="col" class="px-6 py-3 text-center" colspan="3">
					Ações
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
							<?php echo $dados['nome']  ?>
						</th>
						<td class="px-6 py-4">
							<?php echo $dados['sobrenome']  ?>
						</td>
						<td class="px-6 py-4 flex flex-wrap items-center justify-center gap-7">
							<a href="/pages/atores/AtorUpdate.php?id=<?php echo $dados['id_ator'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
								<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
									<path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
									<path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
								</svg>
							</a>
							<a href="#" type="button" data-modal-toggle="deleteAtorModal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
								<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
								</svg>
							</a>
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
				</tr>
			<?php endif; ?>
		</tbody>
	</table>


	<div id="deleteAtorModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative w-full max-w-md max-h-full">
			<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
				<button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteAtorModal">
					<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
					</svg>
					<span class="sr-only">Fechar</span>
				</button>
				<div class="p-6 text-center">
					<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
					</svg>
					<h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Você tem certeza que deseja excluir esse Ator?</h3>
					<a href="/pages/atores/AtorDelete.php" data-modal-hide="deleteAtorModal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
						Excluir
					</a>
					<button data-modal-hide="deleteAtorModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
				</div>
			</div>
		</div>
	</div>


	<?php
	include_once '../../includes/footer.php';
	?>