<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();
  
        $countries = [
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'New Zealand', 'code' => 'NZ'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'United States', 'code' => 'US'],
        ];
          
        foreach ($countries as $key => $value) {
            Country::create($value);
        }
    }
}
