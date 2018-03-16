<nav class="breadcrumb">
	<ul>
		<li><a href="<?= route('definizioni.index', ['sezione' => $sezione->numero]) ?>"><?= $sezione->nome ?></a></li>
		<li><a href="<?= route('definizioni.index', ['sezione' => $sezione->numero, 'argomento' => $argomento->numero]) ?>"><?= $argomento->nome ?></a></li>
		<li class="is-active"><a>#<?= $definizione->codice ?></a></li>
	</ul>
</nav>