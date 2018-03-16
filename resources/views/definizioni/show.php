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
					<?php if ($madre) require 'deriva.php' ?>

					<h1 class="title is-2"><?= $definizione->nome ?></h1>
					<div class="content">
						<p><?= refs($definizione->testo) ?></p>
					</div>

					<?php if (!empty($figlie)) require 'figlie.php'; ?>
					<?php if (!empty($teoremi)) require 'teoremi.php'; ?>
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