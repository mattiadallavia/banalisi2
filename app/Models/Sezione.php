<?php

namespace App\Http\Models;

class Sezione extends Model
{

	public static function find($numero) {
		$q = app('db')->select("SELECT * FROM SEZIONE WHERE Numero = $numero")[0];
		return self::build($q);
	}

	public static function aggregateAll() {
		$q = app('db')->select('
			SELECT S.Numero AS NumeroSezione, S.Nome AS NomeSezione, A.Numero AS NumeroArgomento, A.Nome AS NomeArgomento
			FROM SEZIONE S
			LEFT JOIN ARGOMENTO A ON A.Sezione = S.Numero
			ORDER BY NumeroSezione, NumeroArgomento
		');

		return self::buildAggregateAll($q);
	}

	public static function buildAggregateAll($data) {
		$a = [];
		$i = 0;
		while($i < count($data)) {
			$s = self::build(['numero' => $data[$i]->numerosezione, 'nome' => $data[$i]->nomesezione, 'argomenti' => []]);
			do {
				if ($data[$i]->numeroargomento) $s->argomenti[] =
					Argomento::build(['numero' => $data[$i]->numeroargomento, 'nome' => $data[$i]->nomeargomento]);
				$i++;
			} while($i <= count($data) - 1 && $data[$i-1]->numerosezione == $data[$i]->numerosezione);
			$a[] = $s;
		}

		return $a;
	}
}