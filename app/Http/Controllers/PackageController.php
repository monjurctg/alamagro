<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string',
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'price' => 'required|integer',
            'frequency' => 'nullable|string',
            'duration' => 'nullable|string',
            'features' => 'required|array',
            'is_popular' => 'boolean',
        ]);

        Package::create($data);

        return redirect()->route('packages.index')->with('success', 'প্যাকেজ যোগ করা হয়েছে ✅');
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'type' => 'required|string',
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'price' => 'required|integer',
            'frequency' => 'nullable|string',
            'duration' => 'nullable|string',
            'features' => 'required|array',
            'is_popular' => 'boolean',
        ]);

        $package->update($data);

        return redirect()->route('packages.index')->with('success', 'প্যাকেজ আপডেট হয়েছে ✅');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'প্যাকেজ মুছে ফেলা হয়েছে ❌');
    }
}
