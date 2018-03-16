<?php

function require_with($path, $vars)
{
	extract($vars);
	require $path;
}

function refs($text)
{
	$references = [
		'def' => [
			'route' => 'definizioni.show',
			'parameter' => 'codice'
		],
		'th' => [
			'route' => 'teoremi.show',
			'parameter' => 'codice'
		]
	];
	
	foreach ($references as $key => $reference)
	{
		$text = preg_replace_callback("/$key\(\d+\)/", function($matches) use ($key, $reference)
		{
			$m = $matches[0];
			$lp = strlen($key);
			$lm = strlen($m);
			$n = intval(substr($m, $lp+1, $lm-$lp-2));

			return route($reference['route'], [$reference['parameter'] => $n]);
		}, $text);
	}

	return $text;
}

function cut($text, $length = 300, $tail = '...') {
	if (strlen($text) <= $length) return $text;

	$n = substr_count($text, '$', 0, $length);
	if ($n % 2 == 1) while($text[$length] != '$') $length--;

	return substr($text, 0, $length) . $tail;
}