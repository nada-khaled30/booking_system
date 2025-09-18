<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::with('specialist.user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $service = auth()->user()->specialist->services()->create($data);

        return response()->json($service);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        if ($service->specialist_id !== auth()->user()->specialist->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $service->update($data);

        return response()->json($service);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->specialist_id !== auth()->user()->specialist->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully']);
    }
}
