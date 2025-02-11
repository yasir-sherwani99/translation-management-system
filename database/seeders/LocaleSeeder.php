<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Locale;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = array(
            array(
                'code' => 'en',
                'name' => 'English'
            ),
            array(
                'code' => 'fr',
                'name' => 'French'
            ),
            array(
                'code' => 'es',
                'name' => 'Spanish'
            ),
        );

        if(count($locales) > 0) {
            foreach($locales as $key => $value) {
                Locale::updateOrCreate([
                    'code' => $value['code']
                ],[
                    'name' => $value['name'] 
                ]);
            }
        }
    }
}
