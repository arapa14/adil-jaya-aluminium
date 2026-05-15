<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController
{
    public function index() {
        return view('admin.settings.index');
    }
}
