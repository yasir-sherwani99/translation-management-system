<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = array(
            array(
                'name' => 'mobile'
            ),
            array(
                'name' => 'desktop'
            ),
            array(
                'name' => 'web'
            )
        );

        if(count($tags) > 0) {
            foreach($tags as $key => $value) {
                Tag::updateOrCreate([
                    'name' => $value['name']
                ]);
            }
        }
    }
}
