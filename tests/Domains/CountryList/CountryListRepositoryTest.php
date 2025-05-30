<?php

namespace Tests\Domains\CountryList;

use App\Domains\Country\Country;
use App\Domains\CountryList\CountryList;
use App\Domains\CountryList\CountryListRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CountryListRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_save(): void
    {
        $countryList = CountryList::create([
            'name' => 'test list'
        ]);

        $country = Country::create([
            'country_list_id' => $countryList->id,
            'name' => 'Test Country',
            'capital' => 'Test Capital',
            'languages' => 'Gibberish',
            'landlocked' => true,
            'population' => 1,
            'region' => 'North America',
            'subregion' => 'Right here',
            'flag' => null,
            'coatOfArms' => null
        ]);

        $repo = new CountryListRepository();
        $returnedList = $repo->save($countryList, collect([$country]));

        $this->assertModelExists($returnedList);
        $this->assertEquals($countryList->id, $returnedList->id);
        $this->assertEquals($country->id, $returnedList->countries()->first()->id);
    }

    public function test_delete(): void
    {
        $countryList = CountryList::create([
            'name' => 'test list'
        ]);

        $country = Country::create([
            'country_list_id' => $countryList->id,
            'name' => 'Test Country',
            'capital' => 'Test Capital',
            'languages' => 'Gibberish',
            'landlocked' => true,
            'population' => 1,
            'region' => 'North America',
            'subregion' => 'Right here',
            'flag' => null,
            'coatOfArms' => null
        ]);

        $repo = new CountryListRepository();
        $returnedList = $repo->save($countryList, collect([$country]));

        $this->assertModelExists($returnedList);

        $repo->delete($countryList->id);
        $this->assertModelMissing($returnedList);
    }
}
