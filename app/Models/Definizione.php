<?php

namespace App\Http\Models;

class Definizione extends Model
{

	public static function filter($sezione = null, $argomento = null)
	{
		$s = 'SELECT * FROM DEFINIZIONE';
		if (!is_null($sezione )) $s .= " WHERE Sezione = $sezione";
		if (!is_null($argomento)) $s .= " AND Argomento = $argomento";
		$s .= ' ORDER BY Sezione, Argomento, Codice';

		$q = app('db')->select($s);
		return self::buildMany($q);
	}

	public static function aggregate($codice)
	{
		$q = app('db')->select("
			SELECT D.Codice, D.Nome, D.Testo, D.Argomento, D.Sezione,
			A.Nome AS NomeArgomento, S.Nome AS NomeSezione,
			DM.Codice As CodiceMadre, DM.Nome AS NomeMadre
			FROM DEFINIZIONE D
			INNER JOIN ARGOMENTO A ON (D.Argomento = A.Numero AND D.Sezione = A.Sezione)
			INNER JOIN SEZIONE S ON D.Sezione = S.Numero
			LEFT JOIN DERIVA DE ON DE.Figlia = D.Codice
			LEFT JOIN DEFINIZIONE DM ON DM.Codice = DE.Madre
			WHERE D.Codice=$codice
		")[0];
		
		return self::build([
			'codice' => $q->codice,
			'nome' => $q->nome,
			'testo' => $q->testo,
			'argomento' => Argomento::build(['numero' => $q->argomento, 'nome' => $q->nomeargomento]),
			'sezione' => Sezione::build(['numero' => $q->sezione, 'nome' => $q->nomesezione]),
			'madre' => $q->codicemadre ? Definizione::build(['codice' => $q->codicemadre, 'nome' => $q->nomemadre]) : null
		]);
	}

	public static function random($n)
	{
		$q = app('db')->select("SELECT * FROM DEFINIZIONE ORDER BY RANDOM() LIMIT $n");
		return self::buildMany($q);
	}

	public function figlie()
	{
		$q = app('db')->select("
			SELECT * FROM DEFINIZIONE D
			INNER JOIN DERIVA DE ON DE.Figlia = D.Codice
			WHERE DE.Madre = $this->codice
			ORDER BY Codice
		");
		return self::buildMany($q);
	}

	public function teoremi()
	{
		$q = app('db')->select("
			SELECT * FROM TEOREMA T
			INNER JOIN IPOTESI I ON T.Codice = I.Teorema
			WHERE I.Definizione = $this->codice
			ORDER BY Codice
			");

		return Teorema::buildMany($q);
	}
}