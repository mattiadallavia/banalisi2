<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Definizione;
use App\Http\Models\Sezione;
use App\Http\Models\Argomento;

class DefinizioniController extends Controller
{

    public function index(Request $request)
    {
        $numeroSezione = $request->input('sezione');
        $numeroArgomento = $request->input('argomento');

        $d = Definizione::filter($numeroSezione, $numeroArgomento);
        $i = Sezione::aggregateAll();
        $s = $numeroSezione ? Sezione::find($numeroSezione) : null;
        $a = $numeroArgomento ? Argomento::find($numeroSezione, $numeroArgomento) : null;
        
        return view('definizioni.index', [
            'definizioni' => $d,
            'indice' => $i,
            'sezione' => $s,
            'argomento' => $a
        ]);
    }

    public function show($codice)
    {
        $d = Definizione::aggregate($codice);
        $f = $d->figlie();
        $t = $d->teoremi();
        $i = Sezione::aggregateAll();

        return view('definizioni.show', [
            'definizione' => $d,
            'indice' => $i,
            'sezione' => $d->sezione,
            'argomento' => $d->argomento,
            'madre' => $d->madre,
            'figlie' => $f,
            'teoremi' => $t
        ]);
    }
}