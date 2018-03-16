<!DOCTYPE html>
<html>
<?php require resource_path('views/head.php'); ?>
<body>
	<?php require resource_path('views/navbar.php'); ?>
	
	<section class="hero is-info">
		<div class="hero-body">
			<div class="container">
				<h1 class="title">Definizioni</h1>
				<h2 class="subtitle is-6">
					In questa pagina puoi trovare la lista completa delle definizioni.<br/>
					Seleziona una voce del menù a lato per filtrare per sezione o argomento.
				</h2>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="columns">
				<div class="column">
					<?php if ($sezione) require 'filter-message.php'; ?>
					<?php require 'list.php' ?>
				</div>
				<div class="column is-one-third is-offset-1">
					<?php require_with(resource_path('views/indice.php'), get_defined_vars() + ['indice_route' => 'definizioni.index']) ?>
				</div>
			</div>
		</div>
	</section>

	<?php require resource_path('views/footer.php'); ?>
</body>
</html>