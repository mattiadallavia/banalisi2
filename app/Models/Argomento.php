<?php

namespace App\Http\Models;

class Argomento extends Model
{
	public static function find($numeroSezione, $numeroArgomento) {
		$q = app('db')->select("SELECT * FROM ARGOMENTO WHERE Numero = $numeroArgomento AND Sezione = $numeroSezione")[0];

		return self::build($q);
	}
}