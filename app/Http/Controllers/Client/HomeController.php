<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $sliders = Slider::all();

        return view('client.index', compact('sliders'));
    }
}
