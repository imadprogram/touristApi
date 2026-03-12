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
    public function index(Request $request)
    {
        // started just the query with their destinations already (not fetched the data yet)
        $query = Itinerary::with('destinations');

        if($request->has('category_id')){
            $query->where('category_id' , $request->category_id);
        }

        if($request->has('duration_days')){
            $query->where('duration_days' , $request->duration_days);
        }

        if($request->has('title')){
            $query->where('title' ,'like', '%'. $request->title . '%');
        }

        $itineraries = $query->get();

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
            'destinations' => 'required|array|min:2',
            'destinations.*.name' => 'required|string',
            'destinations.*.rental_location' => 'required|string',
            'destinations.*.places_to_visit' => 'required|string',
            'destinations.*.activities' => 'required|string',
            'destinations.*.dishes_to_try' => 'required|string',
        ]);

        $itinerary = Itinerary::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'duration_days' => $validated['duration_days'],
            'image_url' => $validated['image_url'],
        ]);

        $itinerary->destinations()->createMany($validated['destinations']);
        
        $itinerary->load('destinations');

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
            return response()->json(['message' => 'unauthorized'] , 403);
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
            return response()->json(['message' => 'unauthorized'] , 403);
        }

        $itinerary->delete();

        return response()->json(null , 204);
    }

    

    public function favorite($id){
        $itinerary = Itinerary::findOrFail($id);

        // add it to favorites if not there , but if it was there it will remove it 
        auth()->user()->favorites()->toggle($itinerary->id);

        return response()->json(['message' => 'status changed']);
    }
}
