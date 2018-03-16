<?php

namespace App\Http\Controllers;

use App\Http\Models\Definizione;
use App\Http\Models\Teorema;

class HomeController extends Controller
{
	public function index()
	{
		$d = Definizione::random(4);
		$t = Teorema::random(5);

		$list = array_merge($d, $t);
		shuffle($list);

		return view('home', [
			'list' => $list
		]);
	}
}