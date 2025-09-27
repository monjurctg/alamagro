<?php

namespace App\Http\Controllers;

use App\Models\Package;


class PackagesController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('frontend.packages', compact('packages'));
    }


}
