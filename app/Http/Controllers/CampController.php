<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use Illuminate\Http\Request;
use App\Models\Distribution;
class CampController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camps = Camp::query()->get();
        return view('camp.index', compact('camps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('camp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1- validation 2- create 3- redirect with message
      $validatedData =  $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'capacity' => 'sometimes|Integer',
            'families_count' => 'sometimes|Integer',
            'resources_count' => 'sometimes|Integer',
            'distributions_count' => 'sometimes|Integer',
        ]);
        if($validatedData){
            Camp::query()->create($validatedData);
            return redirect()->route('camps.index')->with('success', 'Camp created successfully');
        }
        return redirect()->back()->with('error', 'Camp creation failed');

    }

    /**
     * Display the specified resource.
     */
    public function show(Camp $camp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Camp $camp)
    {
       return view('camp.edit', compact('camp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Camp $camp)
    {
       $validatedData =  $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'capacity' => 'sometimes|Integer',
            'families_count' => 'sometimes|Integer',
            'resources_count' => 'sometimes|Integer',
            'distributions_count' => 'sometimes|Integer',
        ]);
        if($validatedData){
            $camp->update($validatedData);
            return redirect()->route('camps.index')->with('success', 'Camp updated successfully');
        }
        return redirect()->back()->with('error', 'Camp update failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Camp $camp)
    {
       $camp->delete();
       return redirect()->route('camps.index')->with('success', 'Camp deleted successfully');
    }
}
