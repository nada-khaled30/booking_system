<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id'=>'required|exists:services,id',
            'booking_time'=>'required|date|after_or_equal:now'
        ]);

        $service = Service::find($data['service_id']);

        $conflict = Booking::where('service_id',$service->id)
            ->where('booking_time',$data['booking_time'])
            ->exists();

        if($conflict){
            return response()->json(['message'=>'Specialist not available at this time'],422);
        }

        $booking = Booking::create([
            'client_id'=>auth()->id(),
            'service_id'=>$service->id,
            'booking_time'=>$data['booking_time']
        ]);

        return response()->json($booking);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->client_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'booking_time'=>'required|date|after_or_equal:now'
        ]);

        $conflict = Booking::where('service_id',$booking->service_id)
            ->where('booking_time',$data['booking_time'])
            ->where('id','!=',$booking->id)
            ->exists();

        if($conflict){
            return response()->json(['message'=>'Specialist not available at this time'],422);
        }

        $booking->update($data);
        return response()->json($booking);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->client_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $booking->delete();
        return response()->json(['message'=>'Booking canceled']);
    }

    public function myBookings()
    {
        return auth()->user()->bookings()->with('service')->get();
    }

    public function specialistBookings()
    {
        $specialist = auth()->user()->specialist;

        if (!$specialist) {
            return response()->json(['message' => 'Not a specialist'], 403);
        }

        return $specialist->bookings()->with('service')->get();
    }
}
