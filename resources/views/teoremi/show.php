<!DOCTYPE html>
<html>
<?php require resource_path('views/head.php');?>
<body>
	<?php require resource_path('views/navbar.php'); ?>

	<section class="section">
		<div class="container">
			<div class="columns">
				<div class="column">
					<?php require 'breadcrumbs.php' ?>

					<h1 class="title is-2">
						<?= $teorema->nome ?> <span class="tag is-medium"><?= ucfirst($teorema->tipo) ?></span>
					</h1>
					
					<div class="content">
						<p><?= refs($teorema->ipotesi) ?></p>
						<p><?= refs($teorema->tesi) ?></p>
					</div>

					<?php if ($dimostrazione) { ?>
					<hr/>
					<h2 class="title is-6">Dimostrazione</h2>
					<div class="content">
						<p><?= $dimostrazione->testo ?></p>
					</div>

					<?php if ($dimostrazione->idea) { ?>
					<hr/>
					<h2 class="title is-6">Idea della dimostrazione</h2>
					<div class="content">
						<p><?= $dimostrazione->idea ?></p>
					</div>

					<?php }} ?>

					<?php foreach ($esempi as $esempio) include 'esempio.php' ?>
				</div>
				<div class="column is-one-third is-offset-1">
					<?php require_with(resource_path('views/indice.php'), get_defined_vars() + ['indice_route' => 'teoremi.index']) ?>
				</div>
			</div>
		</div>
	</section>

	<?php require resource_path('views/footer.php'); ?>
</body>
</html>