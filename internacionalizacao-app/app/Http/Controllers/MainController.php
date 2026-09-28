<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    public function index() {
        App::setLocale('pt_BR');
        return view('index');
    }
}
