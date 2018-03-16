<table class="table is-hoverable is-fullwidth">
	<thead>
		<tr>
			<th><abbr title="Argomento">Arg.</abbr></th>
			<th>Tipo</th>
			<th>Nome</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($teoremi as $row) { ?>
		<tr>
			<th><?= $row->sezione ?>.<?= $row->argomento ?></th>
			<td><span class="tag"><?= ucfirst($row->tipo) ?></span></td>
			<td><a href="<?= route('teoremi.show', ['codice' => $row->codice]) ?>"><?= $row->nome ?></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>