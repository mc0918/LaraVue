<?php

namespace App\Domains\CountryList;

use App\Domains\Country\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class CountryListRepository
{
    /**
     * @param CountryList $countryList
     * @param Collection<Country> $countries
     * @return CountryList
     */
    public function save(CountryList $countryList, Collection $countries): CountryList
    {
        return DB::transaction(function () use ($countryList, $countries) {
            $countryList->save();
            $countryList->countries()->saveMany($countries);

            return $countryList->fresh();
        });
    }

    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            $countryList = CountryList::find($id);
            $countryList->countries()->where('country_list_id', '=', $id)->get()->each->delete();

            $countryList->delete();
        });
    }
}
