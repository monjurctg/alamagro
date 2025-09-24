<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $AllCount       = Package::count();
        $PublishedCount = Package::where('status', 1)->count();
        $DraftCount     = Package::where('status', 0)->count();

        $datalist = Package::paginate(10);

        return view('backend.services', compact('datalist', 'AllCount', 'PublishedCount', 'DraftCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'subtitle'  => 'nullable|string|max:255',
            'price'     => 'required|numeric',
            'frequency' => 'nullable|string|max:50',
            'duration'  => 'nullable|integer',
            'type'      => 'nullable|string|max:50',
        ]);

        $package = $request->RecordId ? Package::findOrFail($request->RecordId) : new Package();

        $package->type       = $request->type;
        $package->title      = $request->title;
        $package->subtitle   = $request->subtitle;
        $package->price      = $request->price;
        $package->frequency  = $request->frequency;
        $package->duration   = $request->duration;
        $package->features   = $request->features ?? []; // array
        $package->is_popular = $request->is_popular ? 1 : 0;
        $package->status     = $request->status ?? 0;

        $package->save();

        return response()->json(['success' => true, 'message' => 'Package saved successfully.']);
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return response()->json($package);
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return response()->json(['success' => true, 'message' => 'Package deleted successfully.']);
    }

    public function bulkAction(Request $request)
    {
        $ids = $request->ids;

        if ($request->action == 'publish') {
            Package::whereIn('id', $ids)->update(['status' => 1]);
        } elseif ($request->action == 'draft') {
            Package::whereIn('id', $ids)->update(['status' => 0]);
        } elseif ($request->action == 'delete') {
            Package::whereIn('id', $ids)->delete();
        }

        return response()->json(['success' => true, 'message' => 'Bulk action applied successfully.']);
    }
}
