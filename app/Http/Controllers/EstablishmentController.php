<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstablishmentRequest;
use App\Models\Establishment;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Establishment::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EstablishmentRequest $request)
    {
        $validator = $request->validated();
        $establishment = Establishment::create($validator);
        return response()->json([
            'action' => 'sucess',
            'data' => $establishment
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Establishment $establishment , string $uuid)
    {
        return Establishment::find($uuid);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Establishment $establishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EstablishmentRequest $request, Establishment $establishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Establishment $establishment)
    {
        //
    }
}
