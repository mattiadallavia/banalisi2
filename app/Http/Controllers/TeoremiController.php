<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Teorema;
use App\Http\Models\Sezione;
use App\Http\Models\Argomento;

class TeoremiController extends Controller
{

    public function index(Request $request)
    {
        $numeroSezione = $request->input('sezione');
        $numeroArgomento = $request->input('argomento');

        $d = Teorema::filter($numeroSezione, $numeroArgomento);
        $i = Sezione::aggregateAll();
        $s = $numeroSezione ? Sezione::find($numeroSezione) : null;
        $a = $numeroArgomento ? Argomento::find($numeroSezione, $numeroArgomento) : null;
        
        return view('teoremi.index', [
            'teoremi' => $d,
            'indice' => $i,
            'sezione' => $s,
            'argomento' => $a
        ]);
    }

    public function show($codice)
    {
        $t = Teorema::aggregate($codice);
        $i = Sezione::aggregateAll();
        $e = $t->esempi();
        $d = $t->dimostrazione;

        return view('teoremi.show', [
            'teorema' => $t,
            'indice' => $i,
            'sezione' => $t->sezione,
            'argomento' => $t->argomento,
            'esempi' => $e,
            'dimostrazione' => $d,
        ]);
    }
}