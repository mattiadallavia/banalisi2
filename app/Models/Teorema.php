<?php

namespace App\Http\Models;

class Teorema extends Model
{
	public static function filter($sezione = null, $argomento = null)
	{
		$s = 'SELECT * FROM TEOREMA';
		if (!is_null($sezione )) $s .= " WHERE Sezione = $sezione";
		if (!is_null($argomento)) $s .= " AND Argomento = $argomento";
		$s .= ' ORDER BY Sezione, Argomento, Codice';

		$q = app('db')->select($s);
		return self::buildMany($q);
	}

	public static function aggregate($codice)
	{
		$q = app('db')->select("
			SELECT T.Codice, T.Tipo, T.Nome, T.Ipotesi, T.Tesi, T.Argomento, T.Sezione,
			A.Nome AS NomeArgomento, S.Nome AS NomeSezione,
			D.Testo AS TestoDimostrazione, D.Idea AS IdeaDimostrazione
			FROM TEOREMA T
			INNER JOIN ARGOMENTO A ON (T.Argomento = A.Numero AND T.Sezione = A.Sezione)
			INNER JOIN SEZIONE S ON T.Sezione = S.Numero
			LEFT JOIN DIMOSTRAZIONE D ON T.Codice = D.Teorema
			WHERE T.Codice=$codice
			")[0];

		return self::build([
			'codice' => $q->codice,
			'tipo' => $q->tipo,
			'nome' => $q->nome,
			'ipotesi' => $q->ipotesi,
			'tesi' => $q->tesi,
			'argomento' => Argomento::build(['numero' => $q->argomento, 'nome' => $q->nomeargomento]),
			'sezione' => Sezione::build(['numero' => $q->sezione, 'nome' => $q->nomesezione]),
			'dimostrazione' => $q->testodimostrazione ? Dimostrazione::build(['teorema' => $q->codice, 'testo' => $q->testodimostrazione, 'idea' => $q->ideadimostrazione]) : null
		]);
	}

	public static function random($n)
	{
		$q = app('db')->select("SELECT * FROM TEOREMA ORDER BY RANDOM() LIMIT $n");
		return self::buildMany($q);
	}

	public function esempi() {
		$q = app('db')->select("SELECT * FROM ESEMPIO WHERE Teorema = $this->codice ORDER BY Numero");
		return Esempio::buildMany($q);
	}

}