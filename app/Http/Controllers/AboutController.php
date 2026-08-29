<?php

namespace App\Http\Controllers;

use App\Models\Certificate;

class AboutController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();

        return view('about', compact('certificates'));
    }
}