<table class="table is-hoverable is-fullwidth">
	<thead>
		<tr>
			<th><abbr title="Argomento">Arg.</abbr></th>
			<th>Nome</th>
			<th>Testo</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($definizioni as $row) { ?>
		<tr>
			<th><?= $row->sezione ?>.<?= $row->argomento ?></th>
			<td><a href="<?= route('definizioni.show', ['codice' => $row->codice]); ?>"><?= $row->nome ?></a></td>
			<td><?= cut(refs($row->testo)) ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>