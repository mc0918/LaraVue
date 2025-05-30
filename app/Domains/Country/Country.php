<?php

namespace App\Domains\Country;

use App\Domains\CountryList\CountryList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'country_list_id',
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
    public function country_list(): BelongsTo
    {
        return $this->belongsTo(CountryList::class);
    }
}
