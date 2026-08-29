<?php

namespace App\Http\Controllers;

use App\Models\Pricing;

class PricingController extends Controller
{
    public function index()
    {
        $pricings = Pricing::orderBy('sort_order')->get();

        return view('pricing', compact('pricings'));
    }
}