<?php

namespace App\Http\Models;

class Model
{
	public function load($data)
	{
		foreach ($data as $key => $value) $this->$key = $value;
	}

	public static function build($data)
	{
		$m = new static();
		$m->load($data);
		return $m;
	}

	public static function buildMany($dataArray)
	{
		$a = [];
		foreach ($dataArray as $data) $a[] = self::build($data);
		return $a;
	}
}