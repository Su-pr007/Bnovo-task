<?php

namespace App\Http\Controllers;

use App\DTO\CreateGuestRequestDTO;
use App\DTO\Exceptions\GuestNotFoundException;
use App\Http\Requests\Guests\GuestRequest;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Guest::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuestRequest $request)
    {
        try {
            $guestDTO = CreateGuestRequestDTO::createFromRequest($request);
            $guestDTO->createModel();
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'result' => 'ok'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Guest::find($id)->toArray();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuestRequest $request, string $id)
    {
        try {
            $guestDTO = CreateGuestRequestDTO::createFromRequest($request);
            $guestDTO->updateModel($id);
        } catch (GuestNotFoundException $e) {
            return response()->json([
                'result' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'result' => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Guest::destroy($id);

        return response()->json([
            'result' => 'ok'
        ]);
    }
}
