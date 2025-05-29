<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class GeographyController extends Controller
{
    private const ALL_RESULTS = '/all';

    public function __construct()
    {
        // middleware goes here
    }

    public function index(): View
    {
        $data = Http::get(config('api.api_url') . self::ALL_RESULTS)->body();

        /** @var Collection $data */
        $data = collect(json_decode($data, true))
            ->chunk(100)
            ->first();

        return view('index')->with(['data' => $data]);
    }
}
