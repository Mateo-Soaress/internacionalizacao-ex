<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    public function index() {          
        return view('index');
    }

    public function jsonView() {
        return view('json');
    }

    public function parametersView() {
        return view('parameters', ["name" => null]);
    }

    public function parameter(Request $request) {
        $name = $request->input('name-text');
        return view('parameters', compact('name'));
    }

    public function pluralization(Request $request) {
        return view('pluralization', ['number' => null]);
    }

    public function pluralizationPost(Request $request) {
        $number = $request->input('oranges-number');
        return view('pluralization', compact('number'));
    }

    public function locale($locale) {
        session(['locale' => $locale]);        
        return redirect()->back();
    }
}
