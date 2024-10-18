<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index() {

        $routes = Route::getRoutes();
        return view('welcome', compact('routes'));
    }

    public function home() {
        return view('home');
    }
    

    public function test_create() {
        return view('test');
    }
}
