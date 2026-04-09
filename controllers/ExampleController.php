<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once __DIR__ . '/../models/KategorieModel.php';
require_once __DIR__ . '/../models/GerichtModel.php';

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {


        return view('notimplemented', [
            'request'=>$rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }
    public function m4_7a_queryparameter(RequestData $request)
    {
        // Query-Parameter "name" aus der URL, z.B. ?name=Mehdi
        $name = $request->query['name'] ?? 'kein Name übergeben';

        // View "examples/m4_7a_queryparameter" aufrufen
        return view('examples.m4_7a_queryparameter', [
            'name' => $name
        ]);
    }
    public function m4_7b_kategorie(RequestData $request)
    {
        // Daten über das Modell holen
        $kategorien = getAllKategorienAlphabetisch();

        // An View übergeben
        return view('examples.m4_7b_kategorie', [
            'kategorien' => $kategorien,
        ]);
    }

    public function m4_7c_gerichte(RequestData $request)
    {
        // Daten über das Modell holen
        $gerichte = getGerichteMitPreisUeber2();

        // An die View übergeben
        return view('examples.m4_7c_gerichte', [
            'gerichte' => $gerichte,
        ]);
    }

    public function m4_7d_layout(RequestData $request)
    {
        // ?no=... aus der URL lesen, Standard = 1
        $no = isset($request->query['no']) ? (int)$request->query['no'] : 1;

        if ($no === 2) {
            $view  = 'examples.pages.m4_7d_page_2';
            $title = 'Seite 2';
        } else {
            // Standard: Seite 1
            $view  = 'examples.pages.m4_7d_page_1';
            $title = 'Seite 1';
        }

        return view($view, [
            'title' => $title,
        ]);
    }


}