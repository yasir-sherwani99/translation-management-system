<?php

namespace App\Tests\Units;

use App\Services\LocaleService;
use App\Services\TranslationService;
use Tests\TestCase;

class TranslationTest extends TestCase
{
    protected $locale;
    protected $translation;

    public function setUp(): void
    {
        parent::setUp();
        $this->locale = new LocaleService();
        $this->translation = new TranslationService();
    }

    /** @test */
    public function it_can_add_a_translation()
    {
        $data = [];

        $text = "Hello";
        $targetLanguage = "es";
        $expectedTranslation = "Hola";
        $tag = "mobile";

        $data['word'] = $text;
        $data['translation'] = $expectedTranslation;
        $data['locale'] = $targetLanguage;
        $data['tag'] = $tag;

        $translationn = $this->translation->createOrUpdate($data);

        $this->assertDatabaseHas('translations', $translationn);
    }

    /** @test */
    public function it_can_retrieve_a_translation_by_key_and_language()
    {
        $data = [];

        $data['word'] = 'Welcome message';
        $data['translation'] = 'Welcome to our application!';
        $data['locale'] = 'en';
        $data['tag'] = 'web';

        // Given we have a translation in the database
        $translationn = $this->translation->createOrUpdate($data);

        $localeId = $this->locale->getLocaleId('en');

        // When we retrieve the translation
        $retrievedTranslation = $this->translation->retrieveByText($data['word'], $localeId);
        
        // Then it should match the stored translation
        $this->assertEquals($translationn->word, $retrievedTranslation->word);
    }

    /** @test */
    public function it_throws_exception_for_invalid_language()
    {
        $data = [];
        $this->expectException(\InvalidArgumentException::class);

        $data['word'] = 'Hello';
        $data['translation'] = 'Hola';
        $data['locale'] = 'invalid_language';
        $data['tag'] = 'web';

        $this->translation->createOrUpdate($data);
    }
}