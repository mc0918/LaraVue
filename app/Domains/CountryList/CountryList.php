<?php

namespace App\Domains\CountryList;

use App\Domains\Country\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CountryList extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * @var \Illuminate\Support\Collection|mixed
     */
    public mixed $countries;

    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }
}
