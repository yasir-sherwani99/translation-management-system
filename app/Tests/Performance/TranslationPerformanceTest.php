<?php

namespace App\Tests\Performance;

use App\Models\Translation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TranslationPerformanceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_retrieves_bulk_translations_performance()
    {
        // Given we have a large number of translations
        Translation::factory()->count(1000)->create();
 
         // When we retrieve all translations
        $startTime = microtime(true);
        $translations = Translation::all();
        $endTime = microtime(true);
 
        // Then it should retrieve them within a reasonable time (e.g., less than 500ms)
        $this->assertLessThan(0.5, $endTime - $startTime, "Fetching translations took too long!");
    }   

    /** @test */
    public function it_stores_multiple_requests_efficiently()
    {
        $requests = 100;
        $startTime = microtime(true);

        for ($i = 0; $i < $requests; $i++) {
            $this->postJson('/api/translations', [
                'word' => 'Hello',
                'translation' => 'Hola',
                'locale' => 'es',
                'tag' => 'mobile'
            ])->assertStatus(200);
        }

        $endTime = microtime(true);
        $totalTime = $endTime - $startTime;

        $this->assertLessThan(5, $totalTime, "The API should handle {$requests} requests in less than 5 seconds.");
    }
}