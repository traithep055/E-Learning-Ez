<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function index(Request $request) 
    {
        return view('frontend.pages.learn');
    }
}
