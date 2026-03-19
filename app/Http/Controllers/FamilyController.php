<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Family::query();

        // 🔍 Search by name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // 🏕 Filter by camp
        if ($request->filled('camp_id')) {
            $query->where('camp_id', $request->camp_id);
        }

        // ⭐ Filter by priority (status)
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $families = $query->get();

        $camps = \App\Models\Camp::all();

        return view('family.index', compact('families', 'camps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $camps = \App\Models\Camp::all();
        return view('family.create', compact('camps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'members_count' => 'required|integer',
            'category' => 'required|string',
            'priority' => 'required|string|in:normal,high,low',
            'camp_id' => 'required|exists:camps,id',
        ]);

        Family::create($validatedData);
        return redirect()->route('families.index')->with('success', 'Family created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        return view('family.show', compact('family'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        $camps = \App\Models\Camp::all();
        return view('family.edit', compact('family', 'camps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'members_count' => 'required|integer',
            'category' => 'required|string',
            'priority' => 'required|string|in:normal,high,low',
            'camp_id' => 'required|exists:camps,id',
        ]);

        $family->update($validatedData);
        return redirect()->route('families.index')->with('success', 'Family updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        $family->delete();
        return redirect()->route('families.index')->with('success', 'Family deleted successfully');
    }
}
