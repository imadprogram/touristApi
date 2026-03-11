<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Itinerary;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itineraries = Itinerary::all();

        return response()->json($itineraries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'duration_days' => 'required|integer',
            'image_url' => 'required|string',
        ]);

        $itinerary = Itinerary::create([
            'user_id' => auth()->id(),
            ...$validated,
        ]);

        return response()->json($itinerary, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->load('destinations' , 'category');

        return response()->json($itinerary);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $itinerary = Itinerary::findOrFail($id);

        if($itinerary->user_id !== auth()->id()){
            return response()->json(403);
        }

        $new = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'duration_days' => 'required|integer',
            'image_url' => 'required|string', 
        ]);

        $itinerary->update($new);

        return response()->json($itinerary);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $itinerary = Itinerary::findOrFail($id);

        if($itinerary->user_id !== auth()->id()){
            return response()->json(403);
        }

        $itinerary->delete();

        return response()->json(null , 204);
    }
}
