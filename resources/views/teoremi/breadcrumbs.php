<nav class="breadcrumb">
	<ul>
		<li><a href="<?= route('teoremi.index', ['sezione' => $sezione->numero]) ?>"><?= $sezione->nome ?></a></li>
		<li><a href="<?= route('teoremi.index', ['sezione' => $sezione->numero, 'argomento' => $argomento->numero]) ?>"><?= $argomento->nome ?></a></li>
		<li class="is-active"><a>#<?= $teorema->codice ?></a></li>
	</ul>
</nav>