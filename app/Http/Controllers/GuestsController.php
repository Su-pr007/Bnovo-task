<?php

namespace App\Http\Controllers;

use App\DTO\GuestRequestDTO;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    const CREATE_GUEST_RULES = [
        'name' => ['string', 'required'],
        'surname' => ['string', 'required'],
        'phone' => ['string', 'required', 'unique:guests'],
        'email' => ['string', 'unique:guests'],
        'country' => ['string', 'max:3'],
    ];
    const UPDATE_GUEST_RULES = [
        'name' => ['string'],
        'surname' => ['string'],
        'phone' => ['string', 'unique:guests'],
        'email' => ['string', 'unique:guests'],
        'country' => ['nullable', 'string', 'max:3'],
    ];

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
    public function store(Request $request)
    {
        try {
            $request->validate(self::CREATE_GUEST_RULES);
            $guestDTO = GuestRequestDTO::createFromRequest($request);
            $guestDTO->createModel();
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 'error',
                'message' => $e->getMessage(),
                'debug' => [
                    'location' => $e->getFile() . ':' . $e->getLine(),
                ],
            ]);
        }

        return response()->json([
            'result' => 'ok',
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
    public function update(Request $request, string $id)
    {
        try {
            $request->validate(self::UPDATE_GUEST_RULES);
            $guestDTO = GuestRequestDTO::createFromRequest($request);
            $guestDTO->updateModel($id);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'result' => 'ok',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Guest::destroy($id);

        return response()->json([
            'result' => 'ok',
        ]);
    }
}
