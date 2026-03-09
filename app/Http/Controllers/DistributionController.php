<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distrbutions = Distribution::all();
        return view('distribution.index', compact('distrbutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $families = \App\Models\Family::all();
        $resources = \App\Models\Resource::all();
        return view('distribution.create', compact('families', 'resources'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'family_id' => 'required|exists:families,id',
            'resource_id' => 'required|exists:resources,id',
            'quantity' => 'required|integer',
            'received' => 'sometimes|boolean',
            'distributed_at' => 'sometimes|date',
        ]);

        if (!isset($validatedData['distributed_at'])) {
            $validatedData['distributed_at'] = now();
        }

        Distribution::create($validatedData);
        return redirect()->route('distributions.index')->with('success', 'Distribution logged successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Distribution $distrbution)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distribution $distribution)
    {
        $families = \App\Models\Family::all();
        $resources = \App\Models\Resource::all();
        return view('distribution.edit', compact('distribution', 'families', 'resources'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distribution $distribution)
    {
        $validatedData = $request->validate([
            'family_id' => 'required|exists:families,id',
            'resource_id' => 'required|exists:resources,id',
            'quantity' => 'required|integer',
            'received' => 'sometimes|boolean',
            'distributed_at' => 'nullable|date',
        ]);

        $distribution->update($validatedData);
        return redirect()->route('distributions.index')->with('success', 'Distribution updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distribution $distribution)
    {
        $distribution->delete();
        return redirect()->route('distributions.index')->with('success', 'Distribution entry deleted');
    }
}
