<?php

namespace App\Http\Controllers;

class StaticSitesController extends Controller
{
    public function showHome()
    {
        return view('sites.home');
    }

    public function showPrivacy()
    {
        return view('sites.privacy');
    }

    public function showImpressum()
    {
        return view('sites.impressum');
    }

}
