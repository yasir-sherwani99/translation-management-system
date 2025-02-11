<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable model events
        Translation::flushEventListeners();

        $batchSize = 1000;
        $totalRecords = 100000;

        for ($i = 0; $i < $totalRecords; $i += $batchSize) {
            Translation::factory()->count($batchSize)->create();
        }

        // Re-enable model events
        Translation::boot();
    }
}
