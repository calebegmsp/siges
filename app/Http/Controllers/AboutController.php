<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Finance;

class AboutController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('about');
    }

}
