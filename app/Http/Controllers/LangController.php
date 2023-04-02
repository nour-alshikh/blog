<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function changeLang($la)
    {
        App::setLocale($la);
        Session::put('lang' , $la);
        return back();
    }
}
