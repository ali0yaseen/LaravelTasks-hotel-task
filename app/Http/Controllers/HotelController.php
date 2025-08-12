<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $v = $request->validate([
            'location'   => ['nullable','string','max:255'],
            'min_price'  => ['nullable','numeric','min:0'],
            'max_price'  => ['nullable','numeric','min:0'],
            'min_rating' => ['nullable','numeric','between:0,5'],
        ]);

        $hotels = Hotel::query()
            ->withCount('rooms')
            ->location($v['location'] ?? null)
            ->withPriceBetween($v['min_price'] ?? null, $v['max_price'] ?? null)
            ->minRating($v['min_rating'] ?? null)
            ->latest('id')
            ->paginate(9)
            ->withQueryString();

        return view('hotels.index', ['hotels' => $hotels, 'filters' => $v]);
    }

    public function show(Hotel $hotel)
    {
        $hotel->load(['rooms' => fn($q) => $q->orderBy('price')]);
        return view('hotels.show', compact('hotel'));
    }
}
