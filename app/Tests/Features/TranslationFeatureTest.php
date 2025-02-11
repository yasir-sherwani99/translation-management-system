<?php

namespace App\Tests\Features;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Services\LocaleService;
use App\Services\TranslationService;

class TranslationFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected $locale;
    protected $translation;

    public function setUp(): void
    {
        parent::setUp();
        $this->locale = new LocaleService();
        $this->translation = new TranslationService();
    }

    /** @test */
    public function it_can_search_a_translation_via_api()
    {
        // Given there is translation for the 'goodbye_message' key in 'en' with context mobile
        // When we request a translation
        $response = $this->getJson("/api/translations/search?q=goodbye_message&locale=en&tag=mobile");

        // Then it should return the transactions
        $response->assertStatus(200);
        $response->assertJson([
            'translations' => $response
        ]);
    }

    /** @test */
    public function it_returns_default_message_when_translation_is_missing()
    {
        // Given there is no translation for the 'goodbye_message' key in 'en'
        // When we request a translation
        $response = $this->getJson('/api/translations/search?q=goodbye_message&locale=en');

        // Then it should return the default message
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Translation not found, please check your key.'
        ]);
    }

    /** @test */
    public function it_can_add_a_translation_via_api()
    {
        // Given we have translation data
        $data = [];

        $data['word'] = 'goodbye_message';
        $data['translation'] = 'Goodbye, and take care!';
        $data['locale'] = 'en';
        $data['tag'] = 'web';

        // When we add the translation via API
        $response = $this->postJson('/api/translations', $data);
 
        // Then it should return a success response
        $response->assertStatus(201); // 201 Created
        $this->assertDatabaseHas('translations', $data);
    }

    /** @test */
    public function it_can_update_a_translation_via_api()
    {
        // Given a translation exists
        $data = [];

        $data['word'] = 'goodbye_message';
        $data['translation'] = 'Goodbye, and take care!';
        $data['locale'] = 'en';
        $data['tag'] = 'web';

        $translationn = $this->translation->createOrUpdate($data);

        // When we update the translation via API
        $updatedData = [];
        
        $updatedData['word'] = 'Goodbye, see you soon!';

        $response = $this->putJson("/api/translations/{$translationn->id}", $updatedData);

        // Then the translation should be updated in the database
        $response->assertStatus(200);
        $this->assertDatabaseHas('translations', ['id' => $translationn->id, 'text' => 'Goodbye, see you soon!']);
    }
}