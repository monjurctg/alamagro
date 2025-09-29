<?php

namespace App\Http\Controllers;

use App\Models\Package;


class HomePackagesController extends Controller
{
   public function index()
{
    $monthlyPackages = Package::where('type', 'monthly')->get();
    $fulldayPackages = Package::where('type', 'fullday')->get();

    return view('frontend.packages', compact('monthlyPackages', 'fulldayPackages'));
}



}
