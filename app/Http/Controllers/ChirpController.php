<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chirps = Chirp::with('user')->latest()->take(50)->get();

        return view('home', ['chirps' => $chirps]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|min:5|max:255',
        ], [
            "message.required" => "Please write something to chirp.",
            "message.max" => "Chirps must be 255 characters or less.",
        ]);

        Chirp::create([
            'user_id' => null,
            'message' => $validated['message'],
        ]);

        return redirect('/')->with('success', 'Chirp created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        // if ($request->user()->cannot('update', $chirp)) {
        //     abort(403);
        // }

        $validated = $request->validate([
            'message' => 'required|string|min:5|max:255',
        ], [
            "message.required" => "Please write something to chirp.",
            "message.max" => "Chirps must be 255 characters or less.",
        ]);

        $chirp->update([
            'message' => $validated['message'],
        ]);

        return redirect('/')->with('success', 'Chirp updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        // if (request()->user()->cannot('delete', $chirp)) {
        //     abort(403);
        // }

        $chirp->delete();

        return redirect('/')->with('success', 'Chirp deleted successfully!');
    }
}
