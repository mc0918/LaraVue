<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Ramsey\Collection\Collection;

class GeographyController extends Controller
{
    private const ALL_RESULTS = '/all';

    public function __construct()
    {
        // middleware goes here
    }

    public function index(): View
    {
        $data = Http::get(config('api.api_url') . self::ALL_RESULTS)->json();

        /** @var Collection $data */
        $data = collect($data)
            ->chunk(100) // We said no pagination, but we like to prepare for the future
            ->first()
            ->map(function ($country) {
                // Simplify the returned nested data for demo purposes
                foreach ($country as $key => $item) {
                    $country[$key] = is_iterable($item) ? Arr::first($item) : $item;
                }

                return $country;
            });

        // The API returns a lot of data, pick the more interesting bits to display
        $fields = collect([
            'name',
            'capital',
            'languages',
            'landlocked',
            'population',
            'region',
            'subregion',
            'flag',
        ]);

        return view('index')->with([
            'data' => $data,
            'fields' => $fields,
        ]);
    }
}
