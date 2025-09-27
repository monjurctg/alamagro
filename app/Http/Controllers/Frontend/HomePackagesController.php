<?php

namespace App\Http\Controllers;

use App\Models\Package;


class HomePackagesController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('frontend.packages', compact('packages'));
    }


}
