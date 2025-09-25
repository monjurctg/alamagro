<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    // Show list
    public function index(Request $request)
    {
        $query = Package::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $AllCount       = Package::count();
        $PublishedCount = Package::where('status', 1)->count();
        $DraftCount     = Package::where('status', 0)->count();

        $datalist = $query->latest()->paginate(10);

        return view('backend.packages', compact('datalist', 'AllCount', 'PublishedCount', 'DraftCount'));
    }

    // Store or Update
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'subtitle'  => 'nullable|string|max:255',
            'price'     => 'required|numeric',
            'frequency' => 'nullable|string|max:100',
            'duration'  => 'nullable|string|max:100',
            'type'      => 'nullable|string|max:50',
        ]);

        $package = $request->RecordId ? Package::findOrFail($request->RecordId) : new Package();

        $package->type       = $request->type ?? 'monthly';
        $package->title      = $request->title;
        $package->subtitle   = $request->subtitle;
        $package->price      = $request->price;
        $package->frequency  = $request->frequency;
        $package->duration   = $request->duration;
        $package->features   = $request->features ? explode(',', $request->features) : [];
        $package->is_popular = $request->is_popular ? 1 : 0;
        $package->status     = $request->status ?? 0;

        $package->save();

        return response()->json([
            'success' => true,
            'message' => $request->RecordId ? 'Package updated successfully.' : 'Package added successfully.'
        ]);
    }

    // Get data for edit
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return response()->json($package);
    }

    // Delete
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return response()->json(['success' => true, 'message' => 'Package deleted successfully.']);
    }

    // Bulk actions
    public function bulkAction(Request $request)
    {
        $ids = $request->ids ?? [];

        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No records selected.']);
        }

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
