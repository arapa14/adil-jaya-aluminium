<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index() {
        return view('frontend.home');
    }
}
