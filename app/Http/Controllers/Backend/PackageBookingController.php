<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageBooking; // Using the PackageBooking model created earlier

class PackageBookingController extends Controller
{
    // Show list
    public function index(Request $request)
    {
        $query = PackageBooking::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('package_name', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
             $query->where('status', $request->status);
        }

        $AllCount       = PackageBooking::count();
        $PendingCount   = PackageBooking::where('status', 'pending')->count();
        $ConfirmedCount = PackageBooking::where('status', 'confirmed')->count();
        $CompletedCount = PackageBooking::where('status', 'completed')->count();

        $datalist = $query->latest()->paginate(15);

        return view('backend.package_bookings', compact('datalist', 'AllCount', 'PendingCount', 'ConfirmedCount', 'CompletedCount'));
    }

    // Update Status
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        $booking = PackageBooking::findOrFail($request->id);
        $booking->status = $request->status;
        $booking->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }

    // Delete
    public function destroy(Request $request)
    {
        $booking = PackageBooking::findOrFail($request->id);
        $booking->delete();

        return response()->json(['success' => true, 'message' => 'Booking request deleted successfully.']);
    }
}
