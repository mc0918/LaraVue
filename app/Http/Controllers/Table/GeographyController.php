<?php

namespace App\Http\Controllers\Table;

use App\Domains\Country\Country;
use App\Domains\CountryList\CountryList;
use App\Domains\CountryList\CountryListRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class GeographyController extends Controller
{
    // The API returns a lot of data, pick the more interesting bits to display
    private const FIELDS = [
        'name',
        'capital',
        'languages',
        'landlocked',
        'population',
        'region',
        'subregion',
        'flag',
        'coatOfArms'
    ];

    public function __construct()
    {
        // middleware goes here
    }

    public function index(): View
    {
        $fieldsQuery = '/all?fields=' . implode(',', self::FIELDS);
        $data = Http::get(config('api.api_url') . $fieldsQuery)->json();

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

        return view('index')->with([
            'data' => $data,
            'fields' => self::FIELDS,
        ]);
    }

    public function save(Request $request, CountryListRepository $repo)
    {
        $data = $request->request->all();

        $countries = collect();
        foreach ($data as $country) {
            $countryObject = new Country([
                'name' => $country['name'],
                'capital' => $country['capital'],
                'languages' => $country['languages'],
                'landlocked' => $country['landlocked'],
                'population' => $country['population'],
                'region' => $country['region'],
                'subregion' => $country['subregion'],
                'flag' => $country['flag'],
                'coatOfArms' => $country['coatOfArms'],
            ]);

            $countries->add($countryObject);
        }

        $countryList = new CountryList([
            'name' => uniqid() //@TODO: take user input
        ]);

        $countryList = $repo->save($countryList, $countries);

        return response()->json([
            'success' => true,
            'countryList' => $countryList
        ]);
    }

    public function getCountryLists()
    {
        return CountryList::with('countries')->get();
    }

    public function deleteCountryList(int $id, CountryListRepository $repo): \Illuminate\Http\JsonResponse
    {

        //@TODO: this is a bad hack after realizing the two should have a many-to-many relationship through a pivot table
        //     it works because duplicate countries can be saved in the DB per list
        $repo->delete($id);

        return response()->json(['success' => true]);
    }

    public function deleteCountryFromList(int $listId, int $countryId, CountryListRepository $repo): \Illuminate\Http\JsonResponse
    {
        $repo->deleteCountry($listId, $countryId);

        return response()->json([
            'success' => true,
        ]);
    }
}
