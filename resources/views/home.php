<!DOCTYPE html>
<html>
<?php require resource_path('views/head.php'); ?>
<body>
	<?php require resource_path('views/navbar.php'); ?>

	<section class="hero is-info">
		<div class="hero-body">
			<div class="container">
				<h2 class="subtitle is-6">
					Questa applicazione ti permette di navigare la base di dati degli argomenti del corso di Analisi 2.<br/>
					Utilizza il menù in alto per visualizzare la lista delle definizioni o dei teoremi.<br/><br/>
					Di seguito puoi trovare una selezione casuale di argomenti contenuti in questa base di dati.
				</h2>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="tile is-ancestor">
				<?php for ($j = 0; $j < 3; $j++) { ?>
				<div class="tile is-parent is-vertical is-4">
					<?php for ($i = $j; $i < count($list); $i=$i+3) { ?>

					<article class="tile is-child notification <?= isset($list[$i]->testo) ? 'is-primary' : 'is-info' ?>">
						<h2 class="title is-5">
							<a href="<?= route((isset($list[$i]->testo) ? 'definizioni' : 'teoremi') . '.show', ['codice' => $list[$i]->codice]) ?>"><?= $list[$i]->nome ?></a>
						</h2>
						<div class="content">
							<p><?= isset($list[$i]->testo) ? cut(refs($list[$i]->testo), 500) : cut(refs($list[$i]->ipotesi . $list[$i]->tesi), 500) ?></p>
						</div>
					</article>

					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<?php require resource_path('views/footer.php'); ?>
</body>
</html>