<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');

class HomeController
{
    public function index(RequestData $request)
    {

        logger()->info("Homepage opened");

        // Load all dishes via MVC model
        $gerichte = db_gericht_select_all();

        // Show only first 6 dishes
        $gerichte = array_slice($gerichte, 0, 6);

        $userName = $_SESSION['user_name'] ?? null;

        return view('home', [
            'gerichte' => $gerichte,
            'rd' => $request,
            'userName' => $userName
        ]);
    }



    public function debug(RequestData $request)
    {
        return view('debug');
    }
}